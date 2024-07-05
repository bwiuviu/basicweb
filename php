Create.php
<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['name'];
	$password = $_POST['password'];


	if ($password == 'vitap') {
    	$_SESSION['login'] = 'successful';
    	$_SESSION['name'] = $name;
    	header('Location: display.php');
   	 
	} else {
    	echo "Invalid password!";
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Create Session</title>
</head>
<body>
	<form method="POST" action="create.php">
    	<label for="name">Name:</label>
    	<input type="text" id="name" name="name" required><br><br>
    	<label for="password">Password:</label>
    	<input type="password" id="password" name="password" required><br><br>
    	<input type="submit" value="Submit">
	</form>
</body>
</html>


Display.php


<?php
session_start();


if (isset($_SESSION['login']) && $_SESSION['login'] == 'successful') {
	$name = $_SESSION['name'];
	echo "Welcome, $name";
} else {
	echo "You are not logged in!";
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Display Session</title>
</head>
<body>
	<br><br>
	<a href="destroy.php">Logout</a>
</body>
</html>






Destroy.php


<?php
session_start();
session_unset();
session_destroy();
header('Location: create.php');


?>


<!DOCTYPE html>
<html>
<head>
	<title>Destroy Session</title>
</head>
<body>
	<p>Session terminated. <a href="create.php">Go back to login</a>.</p>
</body>
</html>
