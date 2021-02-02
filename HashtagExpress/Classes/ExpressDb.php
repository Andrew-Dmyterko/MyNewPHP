<?php

namespace Classes;

//use Api\DbApiInterface;
use SecretClasses\ExpressDbData;
use PDO;
use PDOException;

/**
 * This class create for database connect
 * Class Db
 * @package Classes
 *
 */
//class Db extends DbData implements DbApiInterface
class ExpressDb extends ExpressDbData
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

    public function getCities()
    {

        $sql = 'select * from cities order by city_name';

        $query = $this->connection->query($sql);
        $cities = $query->fetchAll(PDO::FETCH_ASSOC);

        return $cities;
    }

    public function getCityById($city_id)
    {

        $sql = 'select * from cities where city_id = '.$city_id;

        $query = $this->connection->query($sql);
        $city = $query->fetchAll(PDO::FETCH_ASSOC);

        return $city;
    }

    public function getPoints($city_id)
    {
        $sql = 'select * from point  where city_id = '.$city_id.' order by point_number';

        $query = $this->connection->query($sql);
        $points = $query->fetchAll(PDO::FETCH_ASSOC);

        return $points;
    }

    public function getPointById($point_id)
    {
        $sql = 'select * from point  where point_id = '.$point_id.' order by point_number';

        $query = $this->connection->query($sql);
        $point = $query->fetchAll(PDO::FETCH_ASSOC);

        return $point;
    }


}


