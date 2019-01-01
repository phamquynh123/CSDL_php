<?php 
	include_once('Model.php');

	class Order extends Model
	{
		public $table='orders';
		public $primary_key='id';
	}
?>