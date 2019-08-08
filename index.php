<?php 
	require "db.php";
 ?>
 <?php if (isset($_SESSION['logged_user'])) : ?>
 	Вы авторизованны под ником <?php echo $_SESSION['logged_user']->login; ?>
 	<hr>
 	<a href="/logout.php"> Выйти из аккаунта</a> <br>
 	<a href="/public.php"> Картинки!</a>
  <?php else : ?>
<a href="/su.php">Регистрация</a><br>
<a href="/log.php">Авторизация</a>
<?php endif; ?>