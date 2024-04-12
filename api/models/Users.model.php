<?php

require_once ROOT_DIR . '/api/models/Model.php';
require_once ROOT_DIR . '/api/services/Validator.service.php';

use api\models\Model;

class UsersModel extends Model
{

  public function getAll()
  {
    $query = "SELECT * FROM users";
    return $this->execute($query);
  }

  public function add($name, $email)
  {
    $query = "INSERT INTO users (name, email) VALUES (?, ?)";
    $conn = $this->connect();
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $name, $email);
    return $stmt->execute();
  }

  public function deleteAll()
  {
    $query = "DELETE FROM users";
    return $this->execute($query);
  }

  public function divideBillBetweenUsers($total = 100)
  {
    $value = $this->calcDividedPayment($total);
    if (empty($value)) return $value;
    return $this->setToPay($value);
  }

  public function setToPay($value)
  {
    $query = "UPDATE users SET to_pay = ?";
    $conn = $this->connect();
    $stmt = $conn->prepare($query);
    $stmt->bind_param("d", $value);
    return $stmt->execute();
  }

  public function calcDividedPayment($total)
  {
    $query = "SELECT COUNT(*) as total FROM users";
    $totalUsers = $this->execute($query);
    $totalUsers = json_decode($totalUsers);
    $totalUsers = $totalUsers[0]->total;

    return $total / $totalUsers;
  }
}
