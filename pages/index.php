<?php

require __DIR__ . '/../includes/functions.inc.php';
require __DIR__ . '/../includes/db-connect.inc.php';

date_default_timezone_set('Europe/Berlin');

$cardPerPage = 2;
$page = (int)($_GET['page'] ?? 1);
$offset = ($page - 1) * $cardPerPage;
$stmtCount = $pdo->prepare('SELECT COUNT(*) as `numOfNotes` FROM `notes`');
$stmtCount->execute();
$count = $stmtCount->fetch(PDO::FETCH_ASSOC)['numOfNotes'];
$stmt = $pdo->prepare('SELECT * FROM `notes` ORDER BY `date` DESC, `id` DESC LIMIT :cardPerPage OFFSET :offset');
$stmt->bindValue('cardPerPage', (int)$cardPerPage, PDO::PARAM_INT);
$stmt->bindValue('offset', (int) $offset, PDO::PARAM_INT);
$stmt->execute();
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$offset = ($page - 1) * $cardPerPage;
$pagesQuantity = ceil($count / $cardPerPage);
?>
<?php require __DIR__ . '/../includes/header.inc.php' ?>
<main class="main">
    <div class="container">
        <h1 id="main-title">Welcome to DailyNotes</h1>

        <p id="main-subtitle">Here you can view and manage your daily entries.</p>

        <?php foreach ($notes as $note): ?>
            <div class="card">
                <?php if(!empty($note['image'])) :?>
                <div class="image-container">
                    <img class="image-card" src="../uploads/<?php echo $note['image']?>" alt="">
                </div>
                <?php endif;?>
                <?php
                $dateExploded = explode('-', $note['date']);
                $timestamp = mktime(12, 0, 0, $dateExploded[1], $dateExploded[2], $dateExploded[0]);
                ?>
                <div class="description-card">
                    <div class="time"> <?php echo e(date('d.m.Y', $timestamp)); ?></div>
                    <h2><?php echo e($note['title']); ?></h2>
                    <p><?php echo e($note['message']); ?> </p>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if ($pagesQuantity > 1): ?>
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link page-link-arrow" href="index.php?<?php echo http_build_query(['page' => ($page - 1)]); ?>">◄</a></li>
                <?php endif ?>
                <?php for ($i = 1; $i <= $pagesQuantity; $i++): ?>
                    <li class="page-item "><a class="page-link <?php if ($page === $i): ?> page-link-active <?php endif; ?>" href="index.php?<?php echo http_build_query(['page' => $i]); ?>"><?php echo e($i); ?></a></li>
                <?php endfor; ?>
                <?php if ($page < $pagesQuantity): ?>
                    <li class="page-item"><a class="page-link page-link-arrow" href="index.php?<?php echo http_build_query(['page' => ($page + 1)]); ?>">►</a></li>
                <?php endif; ?>
            <?php endif; ?>
            </ul>
    </div>


    <?php require __DIR__ . '/../includes/footer.inc.php'; ?>