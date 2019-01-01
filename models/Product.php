<?php 
	include_once('Model.php');

	class Product extends Model
	{
		public $table='products';
		public $primary_key='id';
	}
?>