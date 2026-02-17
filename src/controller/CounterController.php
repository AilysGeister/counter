<?php

/**
 * Controller for the counter.
 */
class CounterController {

    public int $count = 0;

    /**
     * @return int The current count.
     */
    public function getCount(): int {
        $this->update();
        return $this->count;
    }

    /**
     * Update the counter from the form in the view.
     * @return void
     */
    public function store($amount): void {
        $date = time();
        $query = "INSERT INTO entries (amount, dateUnix) VALUES (".$amount.",".$date.")";
        $GLOBALS["database"]->query($query);
        header("location: /");
    }

    public function getDataPoints($begin, $end): array {
        //initialization:
        $result = $this->getStatistics($begin, $end);
        $data = $GLOBALS["database"]->resultToArray($result);
        $datapoints = [];

        //Check the result of the querry:
        if ($data != null) {

            //Fill the array with hashmaps:
            foreach ($data as $entry) {
                $datapoints[] = [
                    "x" => $entry["dateUnix"], //Put the date on X axis.
                    "y" => $this->count($data, $entry["dateUnix"]) //Put the value on Y axis.
                ];
            }
        }

        return $datapoints;
    }

    /**
     * Download the data in a CSV file.
     * @param int|null $begin
     * @param int|null $end
     * @return void
     */

    /**
     * Update the view from the database.
     * @return void
     */
    private function update(): void {
        $query = "SELECT amount FROM entries";
        $result = $GLOBALS['database']->query($query);
        $data = $GLOBALS["database"]->resultToArray($result);
        $this->count = $this->count($data, null);
    }

    /**
     * Count the number of element until the limit.
     * @param $array
     * @param $limit
     * @return int
     */
    private function count($array, $limit): int {
        //Initialization:
        $count = 0;

        //Verification of the parameters:
        if (sizeof($array) > 0) {
            foreach ($array as $row) {

                //Check if there is a limit:
                if (isset($limit)) {
                    //If there is a limit, we compute only if the date is under the limit:
                    if ($row["dateUnix"] <= $limit) {
                        $count += $row["amount"];
                    }

                //If there is no limit we compute in every case:
                } else {
                    $count += $row["amount"];
                }
            }
        }
        return $count;
    }

    /**
     * Get the statistics from the database.
     * @param $begin
     * @param $end
     * @return null
     */
    private function getStatistics($begin, $end) {
        //If there is no given date or it is invalid, we return all the datas:
        if ($this->isDateValid($begin, $end)) {
            $query = "SELECT * FROM entries WHERE dateUnix BETWEEN '".$begin."' AND '".$end."'";
        } else {
            $query = "SELECT * FROM entries";
        }

        //Get the datas from the database.
        $result = $GLOBALS["database"]->query($query);

        //Check the result:
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return NULL;
        }
    }

    /**
     * Check if the two given time under unix format are valid.
     * @param $begin
     * @param $end
     * @return bool
     */
    private function isDateValid($begin, $end): bool {
        //The two dates must exist:
        if ($begin == null & $end == null) {
            return false;

            //Check the chronology:
        } else if ($begin > $end) {
            return false;

        } else {
            return true;
        }
    }
}
?>