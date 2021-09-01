<?php
	
	include("connection.php");

	if(isset($_POST["email"]) && $_POST["email"] != ""){
		$email = $_POST["email"];
	}else{
		die("Enter your email please.");
	}

	if(isset($_POST["password"]) && $_POST["password"] != ""){
		$password = hash('sha256', $_POST['password']);
	}else{
		die("Enter a password please.");
	}

	if(isset($_POST["username"]) && $_POST["username"] != ""){
		$username = $_POST['username'];
	}else{
		die("Enter a username please.");
	}
	
	$query = "Select * from users where email = ?";
	$stmt = $connection-> prepare($query);
	$stmt-> bind_param("s", $email);
	$stmt -> execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

	if($row > 0){
		echo "Email Already Exists"; 
		echo ' <a href="signup.html"> Back to signup </a>';
		exit();
	}

	$stmt1 = $connection->prepare("INSERT INTO users (email, password, username) VALUES (?, ?, ?)");
	$stmt1->bind_param("sss", $email, $password, $username);

	
	$stmt1 -> execute();
	$stmt1->close();
	$connection->close();
	header("Location:index.html");

?>