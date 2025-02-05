<?php
session_start();
if(isset($_SESSION['user_id'])){ header("Location: index.php"); exit(); }

$db = new SQLite3("../database.db");

if(!empty($_GET['u']) && !empty($_GET['p'])){
$u = $_GET['u'];
$p = hash('sha256', $_GET['p']);

$result = $db->query("SELECT * FROM user WHERE username = '$u' AND password = '$p' LIMIT 1");
while($row = $result->fetchArray()){
$_SESSION['user_id'] = $row['id'];

header("Location: index.php");
exit();
}
}

?>
<html>
<head>
<title>Login Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../theme/style.css">
</head>
<body>
<h1>Login</h1>
<form action="" method="get">
user<br /><input type="text" name="u" /><br />
password<br /><input type="text" name="p" /><br />
<button>Login</button>
</form>
-----> <a href="../index.php">Laporan</a>