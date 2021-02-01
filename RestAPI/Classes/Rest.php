<?php

namespace Classes;

use Api\RestApiInterface;
use PDO;
use PDOException;

class Rest implements RestApiInterface
{
    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function get($url)
    {
        $json = json_encode([],JSON_PRETTY_PRINT);

        $urlArray = $this->parsUrl($url);

        if (isset($urlArray[0]) && $urlArray[0] == 'posts') {

            $sql = 'select * from posts';

            if (isset($urlArray[1])) {

                $id = $urlArray[1];
                $sql .= " where id = $id";

            }
            $posts = $this->connection->query($sql);

            if ($posts->rowCount() > 1) {
                $postsList = $posts->fetchAll(PDO::FETCH_ASSOC);
            }
            elseif ($posts->rowCount() == 1) {
                $postsList = $posts->fetch(PDO::FETCH_ASSOC);
            } elseif ($posts->rowCount() == 0 ){

                http_response_code(404);

                $res = [
                    "status" => false,
                    "message" => "Post not found!!"
                ];

                $postsList = $res;

            }
            $json = json_encode($postsList,JSON_PRETTY_PRINT);

        }
        return $json;
    }

    public function post($url, $data)
    {
        $json = json_encode([],JSON_PRETTY_PRINT);

        $urlArray = $this->parsUrl($url);

        if (isset($urlArray[0]) && $urlArray[0] == 'posts' && !isset($urlArray[1])) {

            $title = $data['title'];
            $body = $data['body'];

            $sql = "INSERT INTO posts (title, body) VALUES ('$title', '$body')";

            $post = $this->connection->query($sql);

            if ($post->rowCount()>0) {
                $postsId = $this->connection->lastInsertId();

                http_response_code(201);

                $res = [
                    "status" => true,
                    "post_id" => $postsId
                ];

                $json = json_encode($res,JSON_PRETTY_PRINT);
            }
        } else {
            http_response_code(400);

            $res = [
                "status" => false,
                "message" => "POST Error!!! Post Not created!! Error input URL parameters!!!"
            ];

            $json = json_encode($res,JSON_PRETTY_PRINT);
        }
        return $json;
    }

    public function delete($url)
    {
        $json = json_encode([],JSON_PRETTY_PRINT);

        $urlArray = $this->parsUrl($url);

        if (isset($urlArray[0]) && ($urlArray[0] == 'posts') && isset($urlArray[1])){

            $id = $urlArray[1];

            $sql = "DELETE FROM `posts` WHERE `posts`.`id` = $id ";

            $del = $this->connection->query($sql);

//            var_dump($del->rowCount());

            if ($del->rowCount()>0) {

                http_response_code(201);

                $res = [
                    "status" => true,
                    "message" => "Post is deleted!!"
                ];

                $json = json_encode($res,JSON_PRETTY_PRINT);
            }else {
                http_response_code(404);

                $res = [
                    "status" => false,
                    "message" => "DELETE Error!!! Post Not deleted!! Post Not found!! Error input URL parameters!!!"
                ];

                $json = json_encode($res,JSON_PRETTY_PRINT);
            }
        }else {
            http_response_code(404);

            $res = [
                "status" => false,
                "message" => "DELETE Error!!! Post Not deleted!! Error input URL parameters!!!"
            ];

            $json = json_encode($res,JSON_PRETTY_PRINT);
        }
        return $json;
    }

    public function patch($url)
    {
        $json = json_encode([],JSON_PRETTY_PRINT);

        $urlArray = $this->parsUrl($url);

        if (isset($urlArray[0]) && ($urlArray[0] == 'posts') && isset($urlArray[1])){

            $data = json_decode(file_get_contents('php://input'),true);

            if (isset($data['title']) && isset($data['body'])) {
                $id = $urlArray[1];
                $title = $data['title'];
                $body = $data['body'];

                $sql = "UPDATE `posts` SET `title` = '$title', `body` = '$body' WHERE `posts`.`id` = $id";

                $update = $this->connection->query($sql);
                $exists = $this->connection->query("SELECT * FROM `posts` WHERE `posts`.`id` = $id");

//            var_dump($update);

                if ($update->rowCount()>0) {

                    http_response_code(201);

                    $res = [
                        "status" => true,
                        "message" => "PATCH Ok!!! Post $id is updated!!"
                    ];

                    $json = json_encode($res,JSON_PRETTY_PRINT);
                } else {
                    http_response_code(404);
                    if ($exists->rowCount()) $res = [
                                            "status" => false,
                                            "message" => "PATCH Error!!! Post NOT updated!! Post Not changed!!"
                                        ];
                    else $res = [
                        "status" => false,
                        "message" => "PATCH Error!!! Post NOT updated!! Post Not found!!"
                        ];
                    $json = json_encode($res,JSON_PRETTY_PRINT);
                }
            } else {
                http_response_code(404);

                $res = [
                    "status" => false,
                    "message" => "PATCH Error!!! Post NOT updated!! Error DATA parameter!!"
                ];

                $json = json_encode($res,JSON_PRETTY_PRINT);
            }

        } else {
            http_response_code(404);

            $res = [
                "status" => false,
                "message" => "PATCH Error!!! Post Not updated!! Error input URL parameters!!!"
            ];

            $json = json_encode($res,JSON_PRETTY_PRINT);
        }

        return $json;
    }

    public function parsUrl($url)
    {
        $urlArray = explode("/", trim($url, "/"));

        $urlArray = array_diff($urlArray, []);

        return $urlArray;
    }

}