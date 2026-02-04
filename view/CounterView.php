<?php
require_once __DIR__ . '/header.php';

/**
 * View of the counter
 */
class CounterView {
    function render($counter): void {
        headHTML("Counter");
        echo "<body>".headerHTML()."
    <div class='main'>
        <div class='container'>
            <div>
                <table><tr><td>Currently:</td><td>".$counter->getCount()."</td></tr></table>
            </div>
            <form method='post' action='/store'>
            <h1>Counter</h1>
                <label>Update counter: <input type='number' name='amount'></label>
                <input type='submit' name='submit' value='Submit'>
            </form>
        </div>
    </div></body>";
    }
}
?>