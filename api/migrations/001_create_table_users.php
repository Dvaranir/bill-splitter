<?php
require_once(__DIR__ . "../../../kernel.php");
require_once(ROOT_DIR . "/api/models/Model.php");

use api\models\Model;

class CreateTableUsers
{
    static function up()
    {
        $model = new Model();
        $query = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            to_pay DECIMAL(10, 2) NOT NULL DEFAULT 0.00
        );";
        $model->execute($query);
    }

    static function down()
    {
        $model = new Model();
        $query = "DROP TABLE users;";
        $model->execute($query);
    }
}

CreateTableUsers::up();
