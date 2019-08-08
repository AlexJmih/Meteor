<?php 
	require "db.php";

	$data = $_POST;
	if( isset($data['do_SU']) )
	{
		// Проверки

		$errors = array();
		if( $data['login'] == '')
		{
			$errors[] = 'Вы не ввели логин!';
		}

		if( $data['Email'] == '' )
		{
			$errors[] = 'Вы не ввели почту!';
		}

		if( $data['Pass'] == '' )
		{
			$errors[] = 'Вы не ввели пароль!';
		}

		if( $data['Pass_2'] != $data['Pass'] )
		{
			$errors[] = 'Вы не правильно ввели повторный пароль!';
		}

		if( R::count('users', "login = ?", array($data['login'])) > 0 )
		{
			$errors[] = 'Логин занят!';
		}

		if( R::count('users', "Email = ?", array($data['Email'])) > 0 )
		{
			$errors[] = 'Почта уже зарегестрирована!';
		}

		if( empty($errors))
		{
			// Запись в бд
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->Email = $data['Email'];
			$user->Pass = password_hash($data[Pass], PASSWORD_DEFAULT);
			R::store($user);
			echo '<div ><a href = "/log.php">Вы можете авторизоваться!</a></div><hr>';
		}
		else
		{
			echo '<div >'.array_shift($errors).'</div><hr>';
		}
	}
?>
 <form action="/SU.php" method="POST">
 	<p>
 		<input type="text" name="login"
 		placeholder="Введите логин">
 	</p>
 	<p>
 		<input type="text" name="Email"
 		placeholder="Введите почту">
 	</p>
 	<p>
 		<input type="text" name="Pass"
 		placeholder="Введите пароль">
 	</p>
 	<p>
 		<input type="text" name="Pass_2"
 		placeholder="Введите пароль ещё раз">
 	</p>
 	<p>
 		<button type="submit" name="do_SU">Пройти регистрацию</button>
 	</p>
 </form>