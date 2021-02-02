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
    public $user_phone_sender;
    public $point_num;
    public $point_address;
    public $pack_descr;
    public $pack_weight;
    public $pack_length;
    public $pack_width;
    public $pack_height;
    public $phone_phone_recive;
    public $city_id;
    public $point_id;
    public $pay_beznal;
    public $pay;
    public $pay_reciver;
    public $order_num;
    public $status;

    public function __construct($user_phone_sender, $point_num, $point_address,
                                $pack_descr, $pack_weight, $pack_length, $pack_width,
                                $pack_height, $phone_phone_recive, $city_id, $point_id,
                                $pay_beznal, $pay, $pay_reciver)
    {
        $this->user_phone_sender = $user_phone_sender;
        $this->point_num = $point_num;
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
    }

    public static function countDelivery()
    {
        return 100;
    }

    public function save($db)
    {
        $sql = "INSERT INTO `package`  (`user_phone_sender`, `point_num`, `point_address`, 
                                        `pack_descr`, `pack_weight`,`pack_length`,`pack_width`, 
                                        `pack_height`, `phone_phone_recive`, `city_id`, `point_id;`, 
                                        `pay_beznal`, `pay`, `pay_reciver`, `order_num`) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $options = [$this->user_phone_sender, $this->point_num , $this->point_address, $this->pack_descr,
                                  $this->pack_weight, $this->pack_length, $this->pack_width, $this->pack_height,
                                  $this->phone_phone_recive, $this->city_id, $this->point_id, $this->pay_beznal,
                                  $this->pay, $this->pay_reciver, $this->order_num, $this->status];

        $select = $db->prepare($sql);
        $select->execute($options);

        if ($select->rowCount()>0) {
            return true;
        } else return false;
    }
}


