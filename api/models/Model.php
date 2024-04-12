<?php

namespace api\models;

use mysqli;

class Model
{

    public function connect()
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

    public function execute($query)
    {
        $conn = $this->connect();
        $result = $conn->query($query);

        if (empty($result) || is_bool($result)) return $result;

        $data = $this->makeJsonArray($result);

        $conn->close();

        return $data;
    }

    public function makeJsonArray($result)
    {
        $data = [];

        while ($row = $result->fetch_assoc()) $data[] = $row;

        return json_encode($data);
    }
}
