<?php
require_once __DIR__ . '/header.php';

function statsView(): void {
    headHTML("Counter");
    echo "<body>".headerHTML()."<div id='main'></div><div></div></body>";
}
?>