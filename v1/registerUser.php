<?php
    require_once '../includes/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      if( isset($_POST['username']) and isset($_POST['password']) and isset($_POST['email']) ){

          $db = new DbOperation();
          $res = $db->createUser($_POST['username'],$_POST['password'],$_POST['email']);
          if($res == 1) {
                    $response['error'] = false;
                    $response['message'] = "User Registered Successfully";
              }else if($res == 2){
                    $response['error'] = true;
                    $response['message'] = "Some error occured";
                  }else if($res == 0){
                    $response['error'] = true;
                    $response['message'] = "User already registered";
                  }
        }else{
              $response['error'] = true;
              $response['message'] = "Required fields are missing";
            }
}else{
      $response['error'] = true;
      $response['message'] = "Invalid Request";
    }

    echo json_encode($response);
 ?>
//Service call : http://localhost:3000/android1/v1/registerUser.php
