<?php

require __DIR__ . '\..\includes\functions.inc.php';
require __DIR__ . '\..\includes\db-connect.inc.php';


?>
<?php require __DIR__ . '\..\includes\header.inc.php' ?>
<main class="main">
    <div class="container">
        <h1 id="main-title">New note</h1>
        <form method="POST" action="form.php">
            <div class="form-field">

                <label for="title">Title:</label>
                <input class="form-field-input" type="text" id="title" name="title">
            </div>
            <div class="form-field">
                <label for="title">Date:</label>
                <input class="form-field-input" type="date" id="date" name="date">
            </div>
            <div class="form-field">
                <label for="message">Message:</label>
                <textarea class="form-field-input" id="message" name="message" rows="6"></textarea>
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