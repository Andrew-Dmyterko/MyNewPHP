<?php

require_once 'db.php';


class City
{
    public static function getList () {

        global $db;

        $sql = 'select * from city ';


        $select = $db->query($sql);

        if(!empty($filters)) {


        }

        $data =[];
//
//        $data = $select->fetch_all(MYSQLI_ASSOC);
//
//        var_dump($data);
//        die;

        while ($row = $select->fetch_assoc()) {
            $data[$row['id']] = $row['city'];
        }


        return $data;

    }


}




//City::getList();






