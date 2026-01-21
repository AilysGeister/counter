<?php
function headerHTML(string $title): void {
    echo "
<header>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='/styles.css'>
    <link rel='icon' href='/resources/images/logo.png'>
    <title>" .$title."</title>
</header>";
}
?>