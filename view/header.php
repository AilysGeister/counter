<?php
function headHTML(string $title): void {
    echo "
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='/styles.css'>
    <link rel='icon' href='/resources/images/favicon.png'>
    <title>" .$title."</title>
</head>";
}

function headerHTML(): string {
    return "<nav class='navbar'><ul><li><a href='/'>Counter</a></li><li><a href='/stats'>Statistics</a></li></ul></nav>";
}
?>