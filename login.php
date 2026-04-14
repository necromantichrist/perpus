<?php
session_start();
include "koneksi/koneksi.php";

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if(isset($_POST['login'])){

$data = mysqli_query($conn,"SELECT * FROM admin WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($data);

if($cek>0){

$_SESSION['username']=$username;
header("location:dashboard.php");

}else{

echo "Login gagal";

}

}
?>

<form method="POST">

<h2>Login Admin</h2>

<input type="text" name="username" placeholder="username">
<br><br>

<input type="password" name="password" placeholder="password">
<br><br>

<button name="login">Login</button>

</form>