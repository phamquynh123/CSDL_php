<?php 
	include_once('Model.php');
	class Brand extends Model{
		public $table="brands";
		public $primary_key= "id";
		function detail1($id){
			$query= 'SELECT * FROM products WHERE brand_id =' .$id;
			$result= $this->conn-> query($query);
			$data=array();

			while ($row= $result->fetch_assoc() ){
				$data[]=$row;
			}
				// echo "<pre>";
				// print_r($data);
				// echo "</pre>";
				// die;
			return $data;
		}

		function getNewId()
		{
			$sql = "SELECT MAX(id) as max FROM brands";
			$this->setQuery($sql);
			$this->addTabel();
			$array=$this->getArrayTable();
			// echo "<pre>";print_r($array[0]);echo "</pre>";
			// echo $array[0]['max'];
			// die;
			return $array[0]['max'];
			
		}
		
	}

?>