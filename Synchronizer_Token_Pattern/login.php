

<!DOCTYPE html>
<html lang="en">
<head>
	<!--Sachin Ramesh IT1613560-->
	<title>User Profile</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php	
		if(isset($_POST['submit']))
		{
    		ob_end_clean(); 
    
    
    		if($_POST['user_name'] =="admin" && $_POST['user_pswd'] =="123") //loggin user
    		{
				//Create session in  browser
				session_start();

				//Setting and storing session ID
				$sessionID = session_id(); 
			
				//Terminate cookie after 1 hour 
				setcookie("session_id",$sessionID,time()+3600,"/","localhost",false,true);

				echo'<script> 
					var csrf_token;
			
						function loadDOC(method,url,htmlTag)
						{
							var xhttp = new XMLHttpRequest(); 
							xhttp.onreadystatechange = function() 
						{
							if(this.readyState==4 && this.status==200)
						{
							console.log("CSRF token scuessfully fetched : "+this.responseText);
							document.getElementById(htmlTag).value = this.responseText;		   
						}
						};
							xhttp.open(method,url,true);
							xhttp.send();
						}
					</script>';

				echo '<form  method="POST" action="server.php">
					<span>
						Comment
					</span>

					<div>
						<input  type="text" name="user_name"  placeholder="your name">
					
					</div>

					<div>
						<button type="submit" name="submit">
							submit
						</button>
					</div>

					<div class="spacing"><input type="hidden" id="csToken" name="CSR"/></div>
				</form>';

				
					if(isset($_COOKIE['session_id']))
					{ 
						echo '<script> var token = loadDOC("POST","server.php","csToken");  </script>'; 
					}

				


    		}
    		else
    		{
				header( "Location:other/errorlogin.html" );
    		}

		}


?>

</body>
</html>
