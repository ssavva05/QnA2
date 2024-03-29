<?php require('includes/config.php');
	//if logged in redirect to members page
	if( $user->is_logged_in() ){ header('Location: memberpage.php'); exit(); }

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		if (!isset($_POST['username'])) $error[] = "Please fill out all fields";
		if (!isset($_POST['email'])) $error[] = "Please fill out all fields";
		if (!isset($_POST['password'])) $error[] = "Please fill out all fields";

		$username = $_POST['username'];

		//very basic validation
		if(!$user->isValidUsername($username)){
			$error[] = 'Usernames must be at least 3 Alphanumeric characters';
		} else {
			$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
			$stmt->execute(array(':username' => $username));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!empty($row['username'])){
				$error[] = 'Username provided is already in use.';
			}

		}

		if(strlen($_POST['password']) < 4){
			$error[] = 'Password is too short.';
		}

		if(strlen($_POST['passwordConfirm']) < 4){
			$error[] = 'Confirm password is too short.';
		}

		if($_POST['password'] != $_POST['passwordConfirm']){
			$error[] = 'Passwords do not match.';
		}

		//email validation
		$email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error[] = 'Please enter a valid email address';
		} else {
			$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
			$stmt->execute(array(':email' => $email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!empty($row['email'])){
				$error[] = 'Email provided is already in use.';
			}

		}


		//if no errors have been created carry on
		if(!isset($error)){

			//hash the password
			$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

			//create the activasion code
			$activasion = md5(uniqid(rand(),true));

			try {

				//insert into database with a prepared statement
				$stmt = $db->prepare('INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)');
				$stmt->execute(array(
					':username' => $username,
					':password' => $hashedpassword,
					':email' => $email,
					':active' => 'Yes'
				));
				$id = $db->lastInsertId('memberID');

				//redirect to index page
				header('Location: register.php?action=joined');
				exit;

			//else catch the exception and show the error.
			} catch(PDOException $e) {
				$error[] = $e->getMessage();
			}

		}

	}
//define page title
$title = 'Q&A';

$back = 'index.php';
$textofback = 'Login';
$textonnavbar = 'Already a member?';
//include header template
require('layout1/header.php');
?>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
		<div class="container">

			<div class="row">

				<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
					<form role="form" method="post" action="" autocomplete="off">
						<h2>Please Sign Up</h2>
						<hr>

						<?php
						//check for any errors
						if(isset($error)){
							foreach($error as $error){
								echo '<p class="alert-danger">'.$error.'</p>';
							}
						}

						//if action is joined show sucess
						if(isset($_GET['action']) && $_GET['action'] == 'joined'){
							echo "<h2 class='alert-success'>Registration successful! </h2>";
						}
						?>

						<div class="form-group">
							<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1">
						</div>
						<div class="form-group">
							<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" tabindex="2">
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="4">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg active v1" tabindex="5"></div>
						</div>
					</form>
				</div>
			</div>
		</div>   
<?php 
//include header template
require('layout1/footer.php'); 
?>
