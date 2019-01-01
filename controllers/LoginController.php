<?php 
	include_once('models/Admin.php');
	class LoginController{
		// public $user_model;
		
		public function login(){
			if (isset($_POST['login'])) {
				$email = $_POST['email'];
				$password = $_POST['password'];
				$login = new Admin();
				$row = $login->login($email,$password);
				if ($row==1) {
					$_SESSION['login'] = true;
					header('location: ?mod=products&act=list');
				}else{
					$_SESSION['login'] = false;
				}
			}
			include_once("views/admin/login.php");
		}
		public function formLogin(){
			include_once("views/admin/login.php");
		}
		function logout(){
			if(isset($_SESSION['login'])){
				unset($_SESSION['login']);
				header('location:?mod=shop&act=list');
			}
		}
	}
		// include_once('views/layout/login.php');	
 ?>