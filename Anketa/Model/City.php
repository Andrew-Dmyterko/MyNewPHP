<?php

namespace Model;

use PDO;
use PDOException;

require_once 'db.php';

class City
{
    public static function getList ()
    {
        global $db;

        $sql = 'select * from city ';
        $select = $db->query($sql);

        if(!empty($filters)) {

        }

        $data = $select->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}







