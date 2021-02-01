<?php

/**
 * Interface for Db class
 */

namespace Api;

interface DbApiInterface
{
    /**
     * @connect function
     * return: set public property connection in db connection to database
     *
     * data for database connect locate in SecretClasses\DbData
     *
     * connect to database
     *
     * @return mixed
     */
    public function connect();

}
