
<?php

require_once 'db.php';


class Anketa

{
public static function getList($filters = []) {

    global $db;

    $sql1 ='';

    if(!empty($filters)) {

//        echo "'".implode($filters,'\',\'')."'";
        $sql1 = " where c.city in('".implode($filters,'\',\'')."')";

    }

    $sql = 'select a.name, a.surname, a.age, b.country, b.address, c.city from fio a  left join adress b on a.id = b.id left join city c on b.city_id=c.id'.$sql1;

    $select = $db->query($sql);

    $data = $select->fetch_all(MYSQLI_ASSOC);


//    $select->execute();

//    var_dump($select->fetch_all(MYSQLI_ASSOC));
//die;
//    $data =[];
//
//
//
//    while ($row = $select->fetch_assoc()) {
//        $data[] = $row;
//    }


    return $data;

    }


}


//   Anketa::getList();