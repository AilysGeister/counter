<?php
require_once __DIR__ . '/header.php';

function statsView($begin, $end, $counter): void {
    //Get the data:
    $dataPoints = $counter->getDataPoints($begin, $end);

    headHTML("Counter");
    echo "
    <script>
    window.onload = function() {
        var chart = new CanvasJS.Chart(\"chartContainer\", {
            animationEnabled: true,
            zoomEnabled: true,
            title: {text: \"Edit title to the counter use\"},
            axisX: {
                title: \"Date\",
                valueFormatString: \"DD MMM YYYY HH:mm\"
            },
            axisY: {
                title: \"Value\",
                valueFormatString: \"#\"
            },
            exportEnabled: true,
            data: [{
                xValueType: \"dateTime\",
                xValueFormatString: \"DD MMM YYYY HH:mm\",
                type: \"spline\",
                dataPoints: ".json_encode($dataPoints, JSON_NUMERIC_CHECK)."
            }]
        });
        chart.render();
    }
    </script>
    <body>".headerHTML()."
        <div class='main'>
            <div id='dateSelector'>
                <h2>Select dates:</h2>
                <form method='post' action='/stats'>
                    <label for='begin'>Begin: </label>
                    <input type='datetime-local' name='begin' id='begin' required>
                    <label for='end'>End: </label>
                    <input type='datetime-local' name='end' id='end' required>
                    <input type='submit' value='Fetch'>
                </form>
            </div>
            
            <div id='download'>
            <h2>Download into CSV:</h2>
                <form method='post' action='/stats/download'>
                    <input type='hidden' name='begin' id='begin' value=".$begin.">
                    <input type='hidden' name='end' id='end' value=".$end.">
                    <input type='submit' value='Download'>
                </form>
            </div>
            
            <div id='chartContainer'></div>
            
        </div>
    <script src=\"https://cdn.canvasjs.com/canvasjs.min.js\"></script>
    </body>";
}
?>