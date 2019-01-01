<?php 
	include_once('Model.php');

	class User extends Model
	{
		public $table='users';
		public $primary_key='id';
	}
?>