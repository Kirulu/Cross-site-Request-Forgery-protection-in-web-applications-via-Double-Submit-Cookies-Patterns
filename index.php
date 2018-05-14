<?php 
    //start a session - users browser
    session_start();

    //setting a cookie
    $sessionID = session_id(); //storing session id

    //generate CSRF token
    if(empty($_SESSION['key']))
    {
        $_SESSION['key']=bin2hex(random_bytes(32));
    }

    $token = hash_hmac('sha256',$sessionID,$_SESSION['key']);
    

    setcookie("session_id_ass2",$sessionID,time()+3600,"/","localhost",false,true); //cookie terminates after 1 hour - HTTP only flag
    setcookie("csrf_token",$token,time()+3600,"/","localhost",false,true); //csrf token cookie


?>


<!DOCTYPE html>
<html>
<head>
<title> SSS Assignment02</title>
<meta charset="utf-8"/>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="config.js"> </script>

<script>
    function checkforblank(){

        if (document.getElementById('EMAIL').value=="") {
            alert('Please Enter Your Email..!!!');
           
        }

        else if (document.getElementById('PASS').value=="") {
            alert('Please Enter Your Password..!!!');
          
        }
    }
</script>

<style>

h2{
        color:#0BC6E4;
        margin-left: 20px;
   }

body{
        background:#646161;
    }

</style>

</head>
<body>

<div class="middlePage">
<div class="page-header">
    <h2>Assignment 02-CSRF Protection(Double submit cookies) </small> </h1>
</div> 

<div class="=container" style="margin-top:100px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3" align="center">
                <img src="csrfn.jpg">
                <br><br>
                <form method="POST" action="server.php" onsubmit="checkforblank()">
                    
                    <input name="email" id="EMAIL" type="email" placeholder="Email" class="form-control">
                    <br>
                    <input name="password" id="PASS" type="password" placeholder="Password" class="form-control">
                    <br>
                     <div class="spacing"><input type="hidden" id="csToken" name="CSR"/></div>
                    <input type="submit" name="submit" value="Log In" class="btn btn-primary">

                </form> 
               </div>
            </div>
          </div>

</div>
<!-- Assign CSRF token to hidden variable -->
<script> document.getElementById("csToken").value = '<?php echo $token; ?>' </script>

</body>
</html>
