<div class="container-fluid">
<div class="btn-group">
<a href="?cmd=myaccount" class="btn btn-secondary">Quản lý chung</a>
<a href="?cmd=myaccount&act=add" class="btn btn-primary">Thêm mới</a>
</div>
<?php
switch($act)
{
case "add":add();break;
case "edit":edit();break;
case "del":del();break;
default : manage();break;
}
function manage()
{
	global $db;
$data='
<div class="table-responsive">
<table class="table table-bordered w-100" id="dataTable"  cellspacing="0">
<thead>
<tr>
<th>STT</th>
<th>Ảnh</th>
<th>Name</th>
<th>Email</th>
<th>Date</th>
<th>Sửa</th>
<th>Xoá</th>
<th>Trạng thái</th>
</tr>
</thead>
<tbody>';

$result=$db->query("Select * from account");
while($row=$db->fetch($result))
{
$data.='<tr>
<td></td>
<td><img src="public/'.$row['img'].'" width="50"></td>
<td>'.$row['name'].'</td>
<td>'.$row['email'].'</td>
<td>'.$row['date'].'</td>
<td>
	<a href="index.php?cmd=myaccount&act=edit&id='.$row['id'].'">
		<i class="fa fa-edit"></i>
	</a>
</td>
<td>
	<a href="index.php?cmd=myaccount&act=del&id='.$row['id'].'">
		<i class="fa fa-trash"></i>
	</a>
</td>
<td><i class="fa fa-lock"></i></td>
</tr>';
}
$data.='</tbody>
</table>
</div>
';
echo $data;
}
function del()
{
	global $db;
$id=helper::get("id",0);

$query="DELETE FROM `account` where id=$id";
	if($db->query($query))
		helper::message("Xoá thành công");
	else
		helper::message("Xoá thất bại");
}
function add()
{
		global $db;
if(isset($_POST['submit']))
{
	$name=helper::post('name');
	$email=helper::post('email');
	$password=helper::post('password');
	$description=helper::post('description');
	$img=helper::upload('img');//upload ảnh, khi thành công sẽ trả về tên ảnh vừa upload
	
	$query="insert into account (`name`,`email`,`password`,`img`,`description`) 
	Values ('$name','$email','$password','$img','$description')";
	if($db->query($query))
		helper::message("Thêm thành công");
	else
		helper::message("Thêm thất bại");
}
echo '
<form action="" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Name</label>
			<input type="" class="form-control" name="name" value="">
		</div>
		<div class="form-group">
			<label>Ảnh</label>
			<input type="file" class="form-control" name="img" value="">
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" class="form-control" name="email">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" name="password">
		</div>
		<div class="form-group">
			<label>Description</label>
			<textarea class="form-control" name="description"></textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="form-control" name="submit">
			Thực hiện
			</button>
		</div>
	</form>		   
';
}
function edit()
{
		global $db;
$id=helper::get("id",0);

if(isset($_POST['submit']))
{
	$name=helper::post('name');
	$img=helper::upload('img');//upload ảnh, khi thành công sẽ trả về tên ảnh vừa upload
	$email=helper::post('email');
	$password=helper::post('password');
	$description=helper::post('description');
	$query="update account set
	`name`='$name',`img`='$img',`email`='$email',`password`='$password',`description`='$description'
	where id=$id";
	if($db->query($query))
		helper::message("Thêm thành công");
	else
		helper::message("Thêm thất bại");
}
$result=$db->query("Select * from account where id=$id");
$row=$db->fetch($result);
echo '
<form action="" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Name</label>
			<input type="" class="form-control" name="name" value="'.$row['name'].'">
		</div>
		<div class="form-group">
			<label>Ảnh</label>
			<input type="file" class="form-control" name="img" value="">
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" class="form-control" name="email" value="'.$row['email'].'">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" name="password" value="'.$row['password'].'">
		</div>
		<div class="form-group">
			<label>Description</label>
			<textarea class="form-control" name="description" values= "'.$row['description'].'"></textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="form-control" name="submit">
			Thực hiện
			</button>
		</div>
	</form>		   
';
}
?>
