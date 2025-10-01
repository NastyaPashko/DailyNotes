<?php

require __DIR__ . '/../includes/functions.inc.php';
require __DIR__ . '/../includes/db-connect.inc.php';


$stmt = $pdo->prepare('SELECT * FROM `notes`');
$stmt->execute();
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php require __DIR__ .'/../includes/header.inc.php' ?>
    <main class="main">
        <div class="container">
            <h1 id="main-title">Welcome to DailyNotes</h1>

            <p id="main-subtitle">Here you can view and manage your daily entries.</p>

            <?php foreach ($notes as $note): ?>
                <div class="card">
                    <div class="image-container">
                        <img class="image-card" src="../images/tanya-barrow-4JD-d578iek-unsplash.jpg" alt="">

                    </div>
                    <div class="description-card">
                        <div class="time"> <?php echo e($note['date'])?></div>
                        <h2><?php echo e($note['title']); ?></h2>
                        <p><?php echo e($note['message']); ?> </p>
                    </div>
                </div>
            <?php endforeach; ?>
      
            <ul class="pagination">
                <li class="page-item"><a class="page-link page-link-arrow" href="#">◄</a></li>
                <li class="page-item"><a class="page-link page-link-active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link page-link-arrow" href="#">►</a></li>

            </ul>
        </div>


<?php require __DIR__ .'/../includes/footer.inc.php'; ?>