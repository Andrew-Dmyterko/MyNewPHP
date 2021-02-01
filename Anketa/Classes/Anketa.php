<?php

namespace Classes;

use PDO;
use PDOException;

require_once 'db.php';

class Anketa
{

    public $id;
    public $name;
    public $surname;
    public $age;
    public $country;
    public $address;
    public $city;

    // количество записей на странице
    public static $numb = 2;


    function __construct($id = NULL)
    {
        if (isset($id)) {
            $user = self::getUserById($id);

            if ($user) {
                $this->id = $user['id'];
                $this->name = $user['name'];
                $this->surname = $user['surname'];
                $this->age = $user['age'];
                $this->country = $user['country'];
                $this->address = $user['address'];
                $this->city = $user['city'];
            } else {
                $this->id = "##########";
                $this->name = "не найдено";
                $this->surname = "не найдено";
                $this->age = 0;
                $this->country = "не найдено";
                $this->address = "не найдено";
                $this->city = "не найдено";
            }

        }
    }

    public static function getList($filters = [], $page)
    {
        global $db;

        // количество записей на странице
        $numb = self::$numb;

        //первый елемент
        $first_item = ($page - 1)*$numb;

        $sql = 'select * from (
                select a.id, a.name, a.surname, a.age, b.country, b.address, c.city 
                from fio a  left join adress b on a.id = b.id left join city c on b.city_id=c.id) a ';

        $params=[];

        if(!empty($filters)) {

            // имена разрешенных фильтров
            $allowFilters = ['city', 'country', 'age'];

            $filters = array_intersect_key($filters, array_flip($allowFilters));

            $sql .= " where ";
            $last = array_key_last($filters);

            // собираем условие sql запроса
            foreach ($filters as $key => $val) {

                $sql .= $key ." in (".trim(str_repeat('?,',count($val)),',').")";
                if ($key !== $last) $sql .= " and ";
                $params = array_merge($params,$val);

            }

        }

        $sql .= " LIMIT $first_item, $numb";

        $select = $db->prepare($sql);
        $select->execute($params);

        $data = $select->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }


    public static function getUserById($userId)
    {
        global $db;

        $sql = 'select a.id, a.name, a.surname, a.age, b.country, b.address, c.city 
                from fio a  left join adress b on a.id = b.id left join city c on b.city_id=c.id where a.id = ?';

        $select = $db->prepare($sql);
        $params = [$userId];
        $select->execute($params);

        $data = $select->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function delete()
    {
        global $db;

        $sql = 'delete a, b  from fio a inner join adress b on a.id = b.id where a.id = ?';

        $select = $db->prepare($sql);
        $params = [$this->id];
        $select->execute($params);

        return $select;
    }

    public function edit()
    {
        global $db;

        $sql = 'UPDATE fio a, adress b 
                SET a.name = ?, 
                a.surname = ?, 
                a.age = ?, 
                b.country = ?, 
                b.city_id = ?, 
                b.address = ? 
                WHERE a.id = b.id AND a.id = ?';

        $select = $db->prepare($sql);
        $params = [$this->name,$this->surname,$this->age,$this->country,$this->city,$this->address,$this->id];
        $select->execute($params);

        return $select;
    }


    public function add()
    {
        global $db;

        try {
            $db->beginTransaction();

            $insert_fio = $db->prepare("insert into fio ( name, surname, age) values (?, ?, ?)");
            $params_fio = [$this->name,$this->surname,$this->age];
            $insert_fio->execute($params_fio);

            $this->id = $db->lastInsertId();

            $insert_addr = $db->prepare("insert into adress ( id, country, city_id, address) values (?, ?, ?, ?)");
            $params_addr = [$this->id,$this->country,$this->city,$this->address];
            $insert_addr->execute($params_addr);

            $db->commit();

        } catch (Exception $e) {
            $db->rollBack();
            echo "Ошибка: " . $e->getMessage();
        }
    }

    public static function getTotalUsers($filters = [])
    {
        global $db;

        $sql1 ='';
        $params=[];

        if(!empty($filters)) {

            unset($filters['submit']);
            unset($filters['page']);

            $sql1 = " where ";
            $last = array_key_last($filters);

            // собираем условие sql запроса
            foreach ($filters as $key => $val) {

                $sql1 = $sql1.$key ." in (".trim(str_repeat('?,',count($val)),',').")";
                if ($key !== $last) $sql1 = $sql1." and ";
                $params = array_merge($params,$val);

            }

        }

        $sql = 'select count(*) from (
                select a.id, a.name, a.surname, a.age, b.country, b.address, c.city 
                from fio a  left join adress b on a.id = b.id left join city c on b.city_id=c.id) a '.$sql1;

        $select = $db->prepare($sql);
        $select->execute($params);

        $data = $select->fetchColumn();

        return $data;

    }

//    public static function getList($filters = [])
//    {
//
//        global $db;
//
//        $sql1 ='';
//
//        if(!empty($filters)) {
////            echo "'".implode($filters,'\',\'')."'";
//            $sql1 = " where c.city in('".implode($filters,'\',\'')."')";
//        }
//
//        $sql = 'select a.id, a.name, a.surname, a.age, b.country, b.address, c.city
//                from fio a  left join adress b on a.id = b.id left join city c on b.city_id=c.id'.$sql1;
//        $select = $db->query($sql);
//        $data = $select->fetchAll(PDO::FETCH_ASSOC);
//
//        return $data;
//    }

}

