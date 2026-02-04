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
        //$query = "INSERT INTO entries (amount) VALUES (".$amount.")";
        //$GLOBALS["database"]->query($query);
        echo $amount;
    }

    private function update(): void {
        $query = "SELECT amount FROM entries";
        $result = $GLOBALS['database']->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc($result)) {
                $this->count += $row["amount"];
            }
        }
    }
}