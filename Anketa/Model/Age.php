<?php

namespace Model;

use PDO;
use PDOException;

require_once 'db.php';

class Age
{
    public static function getList ()
    {
        global $db;

        $sql = 'select distinct age from fio order by age';
        $select = $db->query($sql);

        if(!empty($filters)) {

        }

        $data = $select->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}







