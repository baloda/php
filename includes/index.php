 <?php
 require_once("../core/init.php");

if(Session::exists('register')) {
	echo Session::flash('register');
}


$user = new User();
if($user->isLoggedIn()) {
	echo "Logged In";

?>
	<p> Hello <a href=""> <?php echo escape($user->data()->username); ?>  </a> ! </p>

	<ul>
		<li>
			<a href="logout.php"> Log out</a>
		</li>	
	</ul>

<?php

} else {
	echo 'you need to <a href="register.php" > register </a> or <a href="login.php" > login </a>.';
}

//echo Session::get(Config::get('session/session_name'));


 
/*
$user = DB::getInstance()->get('users',array('username', '=', 'baloda'));


if(! $user->count() ) {
	echo " No user";
} else {
	echo $user->first()->username;
}
*/


/*
$user1 = DB::getInstance()->insert('users',array(

	'username' => 'Dasdsdle',
	'password' => 'password',
	'salt' => 'salt',
	'name' => 'xxxxx'
	));

echo $user1;

*/

DB::getInstance()->update('users', 2 , array(

	'username' => 'dknight',
	'group'=> 45,
	'name' => 'baloda'
	));

	

