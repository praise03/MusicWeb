<?php include "nav.php" ?>



<?php
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$username = mysqli_real_escape_string($connection, $username);
		$password = mysqli_real_escape_string($connection, $password);

		
		if ($username == 'admin' && $password == 'admin') {
			$_SESSION['username'] = $username;

			header("Location: upload.php?login=success");
		}

		else{
				echo "<div class='alert alert-danger'>Login Failed</div>";
			}

	}
?>



<form class='form-group' style="max-width: 80% ;margin-top: 60px; margin-left: 1rem" action='' method='post' enctype='multipart/form-data'>
   
   <h2><b>Login</b></h2>

   <br />
   <label>Username</label>
   <input class="form-control" type=text size='60' name='username' />
   <br />
   <label>Password</label>
   <input class="form-control" name='password' type="password" id="file"  />
   <br /> 
   <input type='submit' class="btn btn-outline b-black text-black" name='login' value='Login' />
</form>


<?php include "footer.php" ?>