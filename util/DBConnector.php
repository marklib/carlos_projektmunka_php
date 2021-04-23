<?php


class DBConnector {
    private $tablesRoot = "resources/tables/";

    public function setTableRoot($tableRootParam) {
        self.$tableRoot = $tableRootParam;
    }

    public function insert($table, $params) {
        $myfile = fopen($table . ".txt", "a");
        $dataTxt = serialize($params);
        $dataTxt .= "\n";
        fwrite($myfile, $dataTxt);
        fclose($myfile);
    }

    public function updateById($table, $id, $params) {
        $originalRecords = $this->getRecordsTable($table);
        $newRecords = array();
        foreach ($originalRecords as $originalRecord) {
            if ($id === $originalRecord[0]) {
                $newRecords[] = $params;
            } else {
                $newRecords[] = $originalRecord;
            }
        }

        foreach ($newRecords as $newRecord) {
            $this->insert($table . 'temp', $newRecord);
        }
        if (file_exists($table . 'temp.txt')) {
            unlink($table . '.txt');
            rename($table . 'temp.txt', $table . '.txt');
        }

    }

    public function getLastId($table) {
        $records = $this->getRecordsTable($table);
        if (isset($records) && count($records) != 0) {
            $lastRecord = $records[count($records) - 1];
            $lastIndex = $lastRecord[0];
            return $lastIndex;
        } else {
            return 0;
        }
    }

    public function getRecordsTable($table) {
        $records = array();
        $handle = fopen($table . ".txt", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $fields = unserialize($line);
                $records[] = $fields;
            }
        }
        return $records;
    }

    public function deleteRecordById($table, $id){
        $originalRecords = $this->getRecordsTable($table);
        $newRecords = array();
        foreach ($originalRecords as $originalRecord) {
            if (!($id == $originalRecord[0])) {
                $newRecords[] = $originalRecord;
            }
        }

        foreach ($newRecords as $newRecord) {
            $this->insert($table . 'temp', $newRecord);
        }
        if (file_exists($table . 'temp.txt')) {
            unlink($table . '.txt');
            rename($table . 'temp.txt', $table . '.txt');
        }
    }
}