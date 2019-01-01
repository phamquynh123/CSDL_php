<?php 
	// include ('Connection.php');
	include_once('Model.php');
	class Admin extends Model
	{
		public $table='admins';
		public $primary_key='id';
		function login($email,$password){
			
			$password = md5($password);
			$query = "SELECT * FROM  admins WHERE email='".$email."' and password= '".$password."' ";
			// echo $query; die;
			$result = $this->conn->query($query);
			$row = $result->fetch_assoc();
			
			return ($row != null);
		}
	}
	
 ?>