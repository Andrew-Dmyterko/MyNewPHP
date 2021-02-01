<?php

/**
 * Interface for Rest class
 */

namespace Api;

interface RestApiInterface
{
    /**
     * @get function
     * return: rows of table `posts`
     * return format: rows in json
     *
     * input: HTTP REQUEST METHOD "GET" `url` in format "/posts/id"
     *
     * where `posts` is a table name (only one table is exist in `restapi` database see Classes\Db)
     * `id` - (integer) number of table row
     * if `id` is missing, function return all rows of table posts
     * if `id` is entered, function return just this row of table posts
     *
     * for example HTTP REQUEST METHOD "GET" url - "http://localhost/MyNewPHP/RestAPI/index.php/posts/9"
     * return row with `id` - 9 from table `posts`
     *
     * @param $url
     * @return mixed
     */
    public function get($url);

    /**
     * @post function
     * return: insert row in table `posts`
     * return format: message in json
     *
     * input: HTTP REQUEST METHOD "POST" `url` in format "/posts/"
     * input "data" in "form-data" format where key "title" - is a row `title` in `post` table
     *                                          key "body"  - is a row `body`  in `post` table
     *
     * where `posts` is a table name (only one table is exist in `restapi` database see Classes\Db)
     *
     * for example HTTP REQUEST METHOD "POST" url - "http://localhost/MyNewPHP/RestAPI/index.php/posts/"
     * and "data" in "form-data"
     * insert rows("title" "body") in "form-data" it table `posts`
     *
     * @param $url
     * @param $data
     * @return mixed
     */
    public function post($url, $data);

    /**
     * @delete function
     * return: delete row from table `posts`
     * return format: message in json
     *
     * input: HTTP REQUEST METHOD "DELETE" `url` in format "/posts/id"
     *
     * where `posts` is a table name (only one table is exist in `restapi` database see Classes\Db)
     * `id` - (integer) number of table row
     * if `id` is entered, function delete this row from table `posts`
     *
     * for example: HTTP REQUEST METHOD "DELETE"  url - "http://localhost/MyNewPHP/RestAPI/index.php/posts/9"
     * delete row with `id` 9 from posts table
     *
     * @param $url
     * @return mixed
     */
    public function delete($url);

    /**
     * @patch function
     * return: update row in table `posts`
     * return format: message in json
     *
     * input: HTTP REQUEST METHOD "PATCH" `url` in format "/posts/id"
     *
     * where `posts` is a table name (only one table is exist in `restapi` database see Classes\Db)
     * `id` - (integer) number of table row
     * if `id` is entered, function update this row in table `posts` with "data"
     * input "data" in "raw json stream" format where key "title" - is a row `title` in `post` table
     *                                                key "body"  - is a row `body`  in `post` table
     * {
     *  "title": "space2",
     * "body": "space2"
     * }
     *
     * for example HTTP REQUEST METHOD "PATCH" url - "http://localhost/MyNewPHP/RestAPI/index.php/posts/9"
     * and "data" in "raw json"
     * update row("title" "body") in "raw json" it table `posts`
     *
     * @param $url
     * @return mixed
     */
    public function patch($url);
}
