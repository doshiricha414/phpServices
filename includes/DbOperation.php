<?php

  class DbOperation{
    private $con;
    function __construct(){
      require_once dirname(__FILE__).'/DbConnect.php';
      $db = new DbConnect();
      $this->con = $db->connect();
    }

    public function createUser($username,$pass,$email){

      if($this->isExist($username,$email)){
        return 0;
      }else{
            $password = md5($pass);
            $stmt = $this->con->prepare("INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES (NULL, ?, ?, ?);");
            $stmt->bind_param("sss",$username,$password,$email);
            if($stmt->execute()){
              return 1;
            }else{
              return 2;
            }
      }
    }

    private function isExist($username,$email){
      $stmt = $this->con->prepare("select id from users where username=? or email=?");
      $stmt->bind_param("ss",$username,$email);
      $stmt->execute();
      $stmt->store_result();
      return $stmt->num_rows() > 0;
    }


  }

 ?>
