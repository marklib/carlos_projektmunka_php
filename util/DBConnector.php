<?php


class DBConnector {
    private $tablesRoot = "resources/tables/";

    public function setTableRoot($tableRootParam) {
        self.$tableRoot = $tableRootParam;
    }

    public function insert($table, $params) {
        $myfile = fopen($table . ".txt", "a");
        $dataTxt = "";
        foreach($params as $paramKey => $paramValue) {
            $dataTxt .= $paramKey . "::" . $paramValue . ";";
        }
        $dataTxt .= "\n";
        fwrite($myfile, $dataTxt);
        fclose($myfile);
    }

    public function getLastId($table) {
        $records = $this->getRecordsTable($table);
        $lastRecord = $records[count($records) - 1];
        $lastIndex = $lastRecord[0];
        return $lastIndex;
    }

    public function getRecordsTable($table) {
        $records = array();
        $handle = fopen($table . ".txt", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $fields = explode(";", $line);
                $records[] = $fields;
            }
        }
        return $records;
    }
}