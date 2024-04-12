<?php

require_once(ROOT_DIR . '/api/controllers/Controller.php');
require_once(ROOT_DIR . '/api/models/Users.model.php');

class UsersController extends Controller
{
    public $usersModel;

    function __construct($Kernel)
    {
        parent::__construct($Kernel, __CLASS__);
    }

    public function getBillUsers()
    {
        $model = new UsersModel();
        echo $model->getAll();
    }

    public function postBillUser()
    {
        $model = new UsersModel();

        $data = $this->processBody(['name', 'email']);

        $name = $data['name'];
        $email = $data['email'];

        $validation = $this->validatePostBillUserRequest($name, $email);

        $result = false;

        if (!empty($validation['errors'])) {
            echo json_encode($validation);
            die();
        } else {
            $result = $model->add($name, $email);
        }

        if ($result) {
            $model->divideBillBetweenUsers();
        }

        echo $model->getAll();
    }

    public function validatePostBillUserRequest($name, $email)
    {
        $input = [
            'name' => $name,
            'email' => $email,
        ];

        $rules = [
            'name' => 'required|min:2',
            'email' => 'required|email',
        ];

        return ValidatorService::validate($input, $rules);
    }

    public function deleteBillUsers()
    {
        $model = new UsersModel();
        echo $model->deleteAll();
    }
}

new UsersController($Kernel);
