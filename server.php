<?php

//start session - server
session_start();

$errors=array();

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];


        if(empty($email)) {
            array_push($errors, "Password is required");
             header("Location:index.php"); 

        }

        else if(empty($password)) {
            array_push($errors, "Password is required");
             header("Location:index.php");
            
        }
    ob_end_clean(); //clean previous displayed echoed  --End of Outer Buffer--
    
    if(count($errors) == 0) {
    //validate the logins
    validate_login($_POST['CSR'],$_COOKIE['session_id_ass2'],$_POST['email'],$_POST['password']);
    }
}


//function to validate Login
function validate_login($user_CSRF,$user_sessionID, $email, $password)
{
    if($email=="user@gmail.com" && $password=="user" && $user_CSRF==$_COOKIE['csrf_token'] && $user_sessionID==session_id())
    {
        
        header("Location:sucess.html");
    }
    else
    {
         header("Location:failed.html");
    }
}


?>