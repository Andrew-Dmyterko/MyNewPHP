<?php

namespace Classes;

use Api\DbApiInterface;
use SecretClasses\DbData;
use PDO;
use PDOException;

/**
 * This class create for database connect
 * Class Db
 * @package Classes
 *
 */
class Db extends DbData implements DbApiInterface
{
    public $connection;

    public function connect()
    {
        try {
            $this->connection = new PDO("$this->driver:host=$this->host;dbname=$this->db_name;charset=$this->charset",
                                $this->db_user,$this->db_pass,$this->options);

        }catch (PDOException $e) {
            die ("Не могу подключиться к базе данных");
        }
    }
}

/**
 *
 * databases "restapi" table "posts"
 * CREATE TABLE `posts` (
 * `id` int(11) NOT NULL AUTO_INCREMENT,
 * `title` varchar(50) NOT NULL,
 *  `body` varchar(200) NOT NULL,
 *  PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4
 *
 */
