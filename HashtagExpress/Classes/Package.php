<?php

namespace Classes;

//// check the session status
//// if sessions are enabled, but none exists
//// start the session
//if (session_status() == PHP_SESSION_NONE) {
//    session_start();
//}
//
//require_once "db/db.php";

use PDO;

class Package
{
    public $package_id; // id package
    public $user_phone_sender; // sender phone
    public $point_id_s; // sender point id
    public $point_num; // sender point num
    public $point_address; // sender point address
    public $pack_descr; // package description
    public $pack_weight; // package weight
    public $pack_length; // package length
    public $pack_width; // package width
    public $pack_height; // // package height
    public $phone_phone_recive; // receiver phone
    public $city_id;
    public $point_id;
    public $pay_beznal; // pay cashless/cash
    public $pay;        // is payment
    public $pay_reciver; // is receiver pay?
    public $order_num; // track code
    public $status_msg; //status massage
    public $status_id; //status massage
    public $timePkgCreate; // time when package created

    public function __construct($user_phone_sender, $point_num, $point_id_s, $point_address,
                                $pack_descr, $pack_weight, $pack_length, $pack_width,
                                $pack_height, $phone_phone_recive, $city_id, $point_id,
                                $pay_beznal, $pay, $pay_reciver)
    {
        $this->user_phone_sender = $user_phone_sender;
        $this->point_num = $point_num;
        $this->point_id_s = $point_id_s;
        $this->point_address = $point_address;
        $this->pack_descr = $pack_descr;
        $this->pack_weight = $pack_weight;
        $this->pack_length = $pack_length;
        $this->pack_width = $pack_width;
        $this->pack_height = $pack_height;
        $this->phone_phone_recive = $phone_phone_recive;
        $this->city_id = $city_id;
        $this->point_id = $point_id;
        $this->pay_beznal = $pay_beznal;
        $this->pay = $pay;
        $this->pay_reciver = $pay_reciver;
        $this->order_num = time();
        $this->timePkgCreate = time();
    }

    public static function countDelivery()
    {
        return 110;
    }

    public function create($db)
    {
        $sql = "INSERT INTO `package`  (`user_phone_sender`, `point_num`, `point_address`, `pack_descr`, 
                        `pack_weight`,`pack_length`,`pack_width`, `pack_height`, `phone_phone_recive`, 
                        `city_id`, `point_id;`, `pay_beznal`, `pay`, `pay_reciver`, `order_num`, `status_msg`,
                                        `status_id`,`timePkgCreate`) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->timePkgCreate = time();

        $options = [$this->user_phone_sender, $this->point_num , $this->point_address, $this->pack_descr,
                                  $this->pack_weight, $this->pack_length, $this->pack_width, $this->pack_height,
                                  $this->phone_phone_recive, $this->city_id, $this->point_id, $this->pay_beznal,
                                  $this->pay, $this->pay_reciver, $this->order_num, $this->status_msg, $this->status_id,
                                  $this->timePkgCreate
        ];

        $select = $db->prepare($sql);
        $select->execute($options);

        if ($select->rowCount()>0) {
            $this->package_id = $db->lastInsertId();

            $status_massage = "Находится в отделении $this->point_num, По адрессу $this->point_address. Ожидает отправку складом";
            $status_id = 1; //
            $this->changeStatus($db, $this->package_id, $status_id, $status_massage );

            return true;
        } else return false;
    }

//1 -создан находится в отделении ожидает отправки
//2 -

    public function changeStatus($db, $package_id, $status_Id, $status_msg)
    {

        try {
            $db->beginTransaction();

            $update_status = $db->prepare("UPDATE `package` SET `status_id` = ? , `status_msg` = ? where `package_id` = ?");
            $params_status = [$status_Id, $status_msg, $package_id ];
            $update_status->execute($params_status);

            // if needed LastInserId
            //            $this->id = $db->lastInsertId();

            $insert_status = $db->prepare("insert into package_track 
                                    (track_id, package_id, package_status_message, package_status_id,	package_status_data) 
                                    values (?,?,?,?,?)");
            $paramsStatus = [null,$package_id, $status_msg, $status_Id, time() ];
            $insert_status->execute($paramsStatus);
            // if or commit
            $db->commit();

            $this->status_id= $status_Id;
            $this->status_msg= $status_Id;

        } catch (Exception $e) {
            $db->rollBack();
            echo "Ошибка: " . $e->getMessage();
        }


    }
}


