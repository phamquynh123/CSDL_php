<?php 
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	include_once('models/Brand.php');
	// include_once('models/Product.php');
	/**
	* 
	*/
	class BrandsController 
	{
		function list(){
			$brand= new Brand();
			$data= $brand->getAll();
			include_once('views/admin/brands.php');
		}

		function add(){
			// echo $_POST['name'];
			$insert=array();
			// $data=array();
			$insert['name'] = $_POST['name'];
			$insert['created_at'] =date('Y-m-d H:i:s');

			$brand= new Brand();
			$brand->insert($insert);
			$id = $brand->getNewId();
			$data=$brand->find($id);
			// print_r($data); die;
			$response = json_encode($data);
			echo $response;
		}
		function detail(){
			$brands= new Brand();
			$data= $brands->detail1($_GET['id']);
			$response = json_encode($data);
			echo $response;
		}
		function edit(){
			$brands= new Brand();
			$data=$brands->find($_GET['id']);
			$response = json_encode($data);
			echo $response;
		}
		function update(){
			$brands= new Brand();
			$data=array();
			$data['id']= $_GET['id'];
			$data['name']= $_GET['brandname'];
			$data['updated_at']= date('Y-m-d H:i:s');
			// print_r($data);		die;
			$res= $brands->update($data);
			// die;
			// $response= $brands->find($_GET['id']);
			// print_r($response);
			// die;
			$response = json_encode($response);
			echo $response;
		}


		
		function delete(){
			$br= new Brand();
			$data=$br->destroy($_GET['id']);
		}
	}
?>