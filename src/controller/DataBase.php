<?php

abstract class DataBase {

    abstract public function query($query);

    /**
     * Convert the sql result into an php array.
     * @param $result
     * @return array
     */
    public function resultToArray($result): array | false {
        //PDOstatement:
        if ($result instanceof PDOStatement) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        //MySQL:
        if ($result instanceof mysqli_result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        //If it's already an array:
        if (is_array($result)) {
            return $result;
        }

        //Other iterable object type:
        if (is_iterable($result)) {
            return iterator_to_array($result);
        }

        return [];
    }
}