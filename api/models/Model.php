<?php

namespace api\models;

use mysqli;

class Model
{

    function __construct()
    {
    }

    function connect()
    {
        $servername = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];
        $dbname = $_ENV['DB_NAME'];

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: $conn->connect_error");
        }

        if (!$conn->set_charset("utf8")) {
            die("Error loading character set utf8: %s\n $conn->error");
        }

        return $conn;
    }

    function execute($query)
    {
        $conn = $this->connect();
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    function makeArray($queryResult)
    {
        $my_array = [];
        foreach ($queryResult as $result) {
            $my_array[] = $result;
        }
        return $my_array;
    }
}
