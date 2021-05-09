<?php
class database 
{
	public $connection;
	function __construct()
	{
		$this->connection=mysqli_connect('localhost','root','','cdth19d',3307);
	}
	public function query($query)
	{
		return mysqli_query($this->connection,$query);
	}
	public function fetch($result)
	{
		return mysqli_fetch_assoc($result);
	}
}
class control
{
public function login($email,$password)
{	$connection=mysqli_connect('localhost','root','','cdth19d',3307);
	$reqsult=mysqli_query($connection,"Select * from account where email='$email'and password='$password'");
	if(mysqli_num_rows($reqsult)==1)
	{	$row=mysqli_fetch_assoc($reqsult);
		$_SESSION['loginstatus']=true;
		$_SESSION['name']=$row['name'];
		$_SESSION['avatar']=$row['img'];
		return true;
	}
	else
	{	$_SESSION['loginstatus']=false;
		$_SESSION['name']=null;
		$_SESSION['avatar']=null;
		return false;
	}
}
public function logout($act)
{
	if($act=='logout')
	{
		$_SESSION['loginstatus']=false;
		unset($_SESSION['loginstatus']);
		return true;
	}
	return false;
}
}
class helper
{
public static function post($data,$default='')
{
	return isset($_POST[$data])?$_POST[$data]:$default;
}
public static function get($data,$default='')
{
	return isset($_GET[$data])?$_GET[$data]:$default;
}
public static function redirect($url)
{
	header("location:".$url);
}
public static function message($text,$url='')
{	global $cmd;
	$_SESSION['flash']="<div class='alert alert-success'>$text</div>";
	header("location:index.php?cmd=$cmd");
}
public function upload($filename='img')
{
	$FolderUpload="public/";
	$FileUpload=basename($_FILES[$filename]['name']);
	$target=$FolderUpload.$FileUpload;
	if(move_uploaded_file($_FILES[$filename]['tmp_name'],$target))
		return $FileUpload;
	else
		return '';
}

}

$ctrl=new control;
$db = new database;
?>