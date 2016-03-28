<?php
require_once "../core/init.php";

//var_dump(Token::check(Input::get('token')));

if(Input::exists()) {
	if(Token::check(Input::get('token'))){
	//echo Input::get('username');
	$validate = new Validate();	

	$validation = $validate->check($_POST, array(
		'username'=>array(
			'required'=>true,
			'min'=>2,
			'max'=>20,
			'unique'=>'users'
			),
		'password'=> array(
			'required'=> true,
			'matches'=>'password_again'
			),
		'name'=>array(
			'required'=>true,
			'min'=>2,
			'max'=>50
			)
		));

	if( $validation->passed() ) {
		// register user
		//echo "passed";
		$user = new User();
		$salt = Hash::salt(32);
		

		//die();

		try {
			$user->create(array(
				'username' => Input::get('username'),
				'password' => Hash::make(Input::get('password'),$salt),
				'salt'     => $salt,
				'name'     => Input::get('name'),
				'joined'   => date('Y-m-d H:i:s'),
				'group'    => '1'
				));

			Session::flash('register','you registered sucessfully.');

			//Redirect::to(404);
			Redirect::to('index.php');
			//header('Location: index.php'); 
		
		} catch (Exception $e) {
			die($e->getMessage());
		}
	} else {
		// output errors
		//print_r($validation->errors()); 
		foreach($validation->errors() as $error) {
			echo "{$error} <br>";
		}
	}
}
}

?>

<form action ="" method ="post" >

	<div class = "field">
		<label for = "username"> username </label>
		<input type = "text" name = "username" id ="username" value ="<?php echo escape(Input::get('username'));  ?>" autocomplete ="off">
	</div>

	<div class = "field">
		<label for = "password"> password-1</label>
		<input type ="password" name = "password" id ="password">
	<div>
	
	<div class = "field">
		<label for = "password_again" >re-password </label>
		<input type ="password" name ="password_again" id = "password_again">
	</div>

	<div class = "field">
		<label for = "name" > name </label>
		<input type ="text" name ="name" id = "name" value= "<?php echo escape(Input::get('name'));?>" >
	</div>

	<input type ="hidden" name ="token" value ="<?php echo Token::generate();  ?>" >
	<input type="submit" value="Register">

</form>