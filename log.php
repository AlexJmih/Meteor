<?php 
	require "db.php";

	$data = $_POST;

	if( isset($data['do_log']) )
	{
		$errors = array();
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if($user)
		{
			// Логин существует - проверка пароля
			if (password_verify($data['Pass'], $user->Pass))
			{
			//Лог пользователя
			$_SESSION['logged_user'] = $user;
			echo '<div style="color: green;">Вы авторизованны!
			<a href = "/public.php">Картинки!</div>';
			}
			else
			{
			$errors[] = 'Неверный пароль!';
			}
		}
		else
		{
			$errors[] = 'Неверный логин!';
		}

		if( ! empty($errors))
		{
			echo '<div >'.array_shift($errors).'</div><hr>';
		}
		
	}
?>

<form action="log.php" method="POST">

	<p>
 		<input type="text" name="login"
 		placeholder="Введите логин">
 	</p>

	<p>
 		<input type="text" name="Pass"
 		placeholder="Введите пароль">
 	</p>
 	<p>
 		<button type="submit" name="do_log">Войти</button>
 	</p>
</form>