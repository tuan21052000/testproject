<?php
session_start();
$theme="theme/";
require('config/common.php');
$u=helper::post('username');
$p=helper::post('password');
if($ctrl->login($u,$p)) helper::redirect('index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo $theme?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo $theme?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $theme?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<link href="<?php echo $theme?>css/sb-admin-2.min.css" rel="stylesheet">
<body>
<div class="container">
<h2>Đăng nhập vào hệ thống</h2>
<form action="" method="POST">
<div class="form-group">
<label>Username:</label>
<input type="text" class="form-control" name="username" value="">
</div>
<div class="form-group">
<label>Password:</label>
<input type="password" class="form-control" name="password">
</div>
<button type="submit" name="sbm" class="btn btn-primary">Thực hiện</button>
</form>
</div>
</body>
</html>