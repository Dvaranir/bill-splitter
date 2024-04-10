<?php

namespace api\models;

class UsersModel extends Model {
    public $current_site;

    // function __construct()
    // {
    //     parent::__construct();
    // }
    
    // function get_all_users() {
    //     $query = "SELECT Id, Name, SurName, Phone, EMail, oragnization, ArrivalTime FROM SystemUsers WHERE host = '" . $this->current_site . "' AND id != '1' AND email != 'kostya_mas%40mail.ru';";
    //     return $this->select($query);
    // }
        
    // function get_users($params) {
    //     $query = "SELECT Id, Name, SurName, ArrivalTime FROM SystemUsers WHERE (Name LIKE '%" . $params . "%' OR SurName LIKE '%" . $params . "%') AND host = '" . $this->current_site . "';";
    //     return $this->select($query);
    // }
        
    // function get_user($user_id){
    //     $query = "SELECT Id, Name, SurName, Phone, EMail, organization, ArrivalTime FROM SystemUsers WHERE id = '" . $user_id . "' AND host = '" . $this->current_site . "';";
    //     return $this->select($query);
    // }
        
    // function set_arival($user_id){
    //     $query = "UPDATE SystemUsers SET ArrivalTime = '" . $this->kernel->DateTime . "' WHERE id = '" . $user_id . "' AND host = '" . $this->current_site . "';";
    //     $this->update($query);
    // }


  }

?>