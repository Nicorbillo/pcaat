<?php
// Database connection variables
$db_host = 'localhost';
$db_name = 'phpnewsfeed';
$db_user = 'root';
$db_pass = '';
$db_charset = 'utf8';
// Connect to database using the PDO interface
try {
    $pdo = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=' . $db_charset, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to database!');
}
// Form submit
if (isset($_POST['title'], $_POST['description'], $_POST['link'], $_POST['date'])) {
    // Validation
    if (empty($_POST['title']) || empty($_POST['description']) || empty($_POST['link']) || empty($_POST['date'])) {
        $msg = '<p class="msg error">Please fill out all fields!</p>';
    } else {
        // Image path
        $img = '';
        // Upload image if exists
        if (isset($_FILES['img']) && !empty($_FILES['img']['tmp_name'])) {
            $img = 'images/' . $_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], $img);
        }
        // Insert news into database
        $stmt = $pdo->prepare('INSERT INTO news (title, description, url_link, img, published_date) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([ $_POST['title'], $_POST['description'], $_POST['link'], $img, $_POST['date'] ]);
        // Output response
        $msg = '<p class="msg success">News created successfully!</p>';
    }
}
?>