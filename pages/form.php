<?php

require __DIR__ . '\..\includes\functions.inc.php';
require __DIR__ . '\..\includes\db-connect.inc.php';

if (!empty($_POST)) {
    $title = (string) ($_POST['title'] ?? '');
    $date = (string) ($_POST['date'] ?? '');
    $message = (string)($_POST['message'] ?? '');
    $imageName=null;
    if (!empty($_FILES) && !empty($_FILES['image'])) {
        $nameWithoutExtension = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
        $name = preg_replace('/[^a-zA-Z0-9]/', '', $nameWithoutExtension);
        $originalImage = $_FILES['image']['tmp_name'];
        $imageName=$name.'-'.time().'.jpg';
        $destImage = __DIR__ . '/../uploads/' . $imageName;
        [$width, $height] = getimagesize($originalImage);
        $maxDim = 400;
        $scaleFactor = $maxDim / max($width, $height);
        $newWidth = $width * $scaleFactor;
        $newHeight = $height * $scaleFactor;
        $im=imagecreatefromjpeg($originalImage);
        $newImg=imagecreatetruecolor($newWidth,$newHeight);
        imagecopyresampled($newImg,$im,0,0,0,0,$newWidth,$newHeight,$width,$height);
        imagejpeg($newImg, $destImage);
    }
    $stmt = $pdo->prepare('INSERT INTO  `notes` (`title`, `date`, `message`, `image`) VALUES (:title, :date, :message,:image)');
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':message', $message);
    $stmt->bindValue(':image', $imageName);
    
    $stmt->execute();
}
?>
<?php require __DIR__ . '\..\includes\header.inc.php' ?>
<main class="main">
    <div class="container">
        <h1 id="main-title">New note</h1>
        <form method="POST" action="form.php" enctype="multipart/form-data">
            <div class="form-field">

                <label for="title">Title:</label>
                <input class="form-field-input" type="text" id="title" name="title" required>
            </div>

            <div class="form-field">
                <label for="title">Date:</label>
                <input class="form-field-input" type="date" id="date" name="date" required>
            </div>

            <div class="form-field">
                <label for="message">Message:</label>
                <textarea class="form-field-input" id="message" name="message" rows="6"></textarea>
            </div>
            <div class="form-field">
                <label for="title">Image:</label>
                <input class="form-field-input" type="file" id="image" name="image">
            </div>
            <div class="form-submit">
                <input type="submit" value="Submit!" class="btn-submit" />

            </div>
        </form>

    </div>
</main>


<footer class="footer">
    <div class="container">
        <h2>DailyNotes</h2>
        <p>Your personal space to capture thoughts, ideas, and daily reflections.</p>
    </div>
</footer>

</body>


</html>