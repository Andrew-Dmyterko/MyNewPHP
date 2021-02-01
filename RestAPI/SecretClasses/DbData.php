<?php

namespace SecretClasses;

use PDO;
use PDOException;

class DbData
{
    protected $driver = 'mysql';
    protected $host = 'localhost';
    protected $db_name = 'restapi';
    protected $db_user = 'root';
    protected $db_pass = '650351';
    protected $charset = 'utf8';
    protected $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES=>false];
}

?>