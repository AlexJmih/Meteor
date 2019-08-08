<?php 
	require "db.php";
	$server = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'testquest_1';
	$charset = 'utf8';
	$connection = new mysqli($server, $username, $password, $dbname);
	
if($connection->connect_error){
	die("Ошибка соединения".$connection->connect_error);
}

if(!$connection->set_charset($charset)){
	echo "Ошибка установки кодировки UTF8";
}
 ?>

 <?php 
 if (isset($_SESSION['logged_user'])) : ?>
 	Вы авторизованны под ником <?php echo $_SESSION['logged_user']->login; ?>
 	<hr>
 	<a href="/logout.php"> Выйти из аккуунта</a>
  <?php else : ?>
<a href="/su.php">Регистрация</a><br>
<a href="/log.php">Авторизация</a>
<?php endif; ?>

<form action="public.php" method="post" enctype="multipart/form-data">
<input type="file" name="img_upload"><input type="submit" name="upload" value="Загрузить">
</form>

<?php 
if(isset($_POST['upload'])){
	$img_type = substr($_FILES['img_upload']['type'], 0, 5);
	$img_size = 1024*1024;
	if(!empty($_FILES['img_upload']['tmp_name']) and $img_type === 'image' and $_FILES['img_upload']['size'] <= $img_size){ 
	$img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
	$connection->query("INSERT INTO images (img) VALUES ('$img')");
	}else{
		echo "Данный формат файлов не поддерживается!";
	}
}
 ?>
 </form>
<?php
	$query = $connection->query("SELECT * FROM images ORDER BY id DESC");
	while($row = $query->fetch_assoc()){
		$show_img = base64_encode($row['img']);?>
		<img src="data:image/jpeg;base64, <?=$show_img ?>" alt="">
	<?php } ?>