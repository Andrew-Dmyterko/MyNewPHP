<?php

require_once '/../db.php';


class Country
{
    public static function getList ()
    {
        global $db;

        $sql = 'select distinct country from adress ';
        $select = $db->query($sql);

        if(!empty($filters)) {

        }

        $data = $select->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}







