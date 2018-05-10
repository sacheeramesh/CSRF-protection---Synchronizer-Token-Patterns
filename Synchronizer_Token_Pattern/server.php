<?php
//Sachin Ramesh IT16135680

session_start();//session start


if(empty($_SESSION['key']))//Create CSRF Token key
{
    $_SESSION['key']=bin2hex(random_bytes(32));
    
}


$token = hash_hmac('sha256',"This is token:index.php",$_SESSION['key']);//Genarate CSRF Token


$_SESSION['CSRF'] = $token; //store CSRF token in session variable

ob_start(); 

echo $token;


if(isset($_POST['submit'])) //check comment was submited
{
    ob_end_clean(); 
    
    $name = $_POST['user_name'];
    sessionvalidate($_POST['CSR'],$_COOKIE['session_id']); //validates the csrf and session 

}


function sessionvalidate($user_CSRF,$user_sessionID)
{
    if($user_CSRF==$_SESSION['CSRF'] && $user_sessionID==session_id())
    {
        header( "Location:other/success.html" );
        echo'<script>alert($name)';
        apc_delete('CSRF_token');
    }
    else
    {
	    header( "Location:other/error.html" ); 
    }
}

?>
