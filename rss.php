<?php
// Database connection variables
$db_host = 'localhost';
$db_name = 'phpnewsfeed';
$db_user = 'root';
$db_pass = '';
$db_charset = 'utf8';
// Connect to the database using the PDO interface
try {
    $pdo = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=' . $db_charset, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to database!');
}

$stmt = $pdo->prepare('SELECT * FROM news ORDER BY published_date DESC LIMIT 10');
$stmt->execute();
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>' . PHP_EOL;
?>
<rss version="2.0">
    <channel>
        <title>Your Website Name</title>
        <link>https://example.com/</link>
        <description>Short description of your website or feed</description>
        <language>en-us</language>
        <?php foreach ($news as $item): ?>
        <item>
            <title><?=htmlspecialchars($item['title'], ENT_QUOTES)?></title>
            <link><?=htmlspecialchars($item['url_link'], ENT_QUOTES)?></link>
            <description><?=htmlspecialchars($item['description'], ENT_QUOTES)?></description>
            <pubDate><?=date('r', strtotime($item['published_date']))?></pubDate>
            <?php if (!empty($item['img']) && file_exists($item['img'])): ?>
            <enclosure url="https://example.com/<?=htmlspecialchars($item['img'], ENT_QUOTES)?>" type="<?=mime_content_type($item['img'])?>" length="<?=filesize($item['img'])?>" />
            <?php endif; ?>
        </item>
        <?php endforeach; ?>
    </channel>
</rss>