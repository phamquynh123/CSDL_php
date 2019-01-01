<?php 
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	include_once('models/Product.php');
	include_once('models/Brand.php');
	include_once('models/Image.php');
	include_once('models/Color.php');
	include_once('models/Ram.php');
	include_once('models/Product_detail.php');
	include_once('models/Order.php');
	include_once('models/Order_detail.php');
	include_once('models/User.php');
	
	class ProductsController{
		
		function list(){
			// echo md5('123456');
			// die;
			$pro= new Product(); 
			$brand= new Brand();
			$color= new Color();
			$img= new Image(); 
			$ram = new Ram();

			$data =$pro->getAll();
			$brands= $brand->getAll();
			$colors= $color->getAll();
			$rams= $ram->getAll();

			foreach ($data as $key => $value) {
			 	$brandd= $brand->find($value['brand_id']);
				$imgg= $img->findproduct($value['id']);
				
				$data[$key]['brand']= $brandd;
				$data[$key]['img']= $imgg;
			}

			// echo "<pre>";
			// print_r($data);
				// print_r($brands);
			// print_r($brandd);
			// print_r($imgg);
			// echo "</pre>";
			// die;
			include_once('views/admin/product.php');
		}
		function add(){
			$pro= new Product(); 
			$insert= array();
			$insert['name']=$_POST['name'];
			$insert['brand_id']=$_POST['brandd'];
			$insert['created_at'] =date('Y-m-d H:i:s');
			$data= $pro->insert($insert);

			$id = $pro->getNewId();
			$data=$pro->find($id);
			// print_r($data); die;
			$response = json_encode($data);
			echo $response;
		}
		function uploadimg(){
			$id= $_POST['product_id'];

			if($_FILES["file"]["error"] > 0){
				echo "lỗi upload images";
				die;			}
			else {
				move_uploaded_file($_FILES["file"]["tmp_name"], "public/image/product/" .$_FILES["file"]["name"]);
				$link= "public/image/product/" .$_FILES["file"]["name"];
			}			
			$data['link']=$link;
			$data['product_id']= $id;
			$data['created_at'] =date('Y-m-d H:i:s');
			// print_r($data); die;
			$img= new Image(); 
			$upload= $img->insert($data);
			$response = json_encode($upload);
			echo $response;
			
		}
		function adddetail(){
			$pro_det= new Product_detail();
			$color= new Color(); 
			$ram = new Ram();
			$data=array();
				$data['product_id']=$_GET['id'];
				$data['color_id']=$_POST['color'];
				$data['screen']=$_POST['screen'];
				$data['ram_id']=$_POST['ram'];
				$data['quantity']=$_POST['quantity'];
				$data['price']=$_POST['price'];
				$data['created_at'] =date('Y-m-d H:i:s');
			$insert = $pro_det->insert($data);
			$id = $pro_det->getNewId();
			$insert=$pro_det->find($id);
			$insert['color']=$color->find($insert['color_id']);
			$insert['ram']=$ram->find($insert['ram_id']);

			// print_r($insert); die;
			$response = json_encode($insert);
			echo $response;
			
		}
		function edit(){
			$pro= new Product(); 
			$prodet= new Product_detail(); 
			$brand= new Brand();
			$color= new Color();
			$img= new Image(); 
			$ram = new Ram();

			$id=$_GET['id'];
			$data= array();
			$data['product']= $pro->find($id);
			$data['image']=$img->findproduct($id);
			$data['brand']=$brand->find($data['product']['brand_id']);
			$data['product_detail']=$prodet->findproduct($id);
			foreach ($data['product_detail'] as $key => $value) {
				$data['product_detail'][$key]['color']=$color->find($value['color_id']);
				$data['product_detail'][$key]['ram']=$ram->find($value['ram_id']);
			}
			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";
			// die;
			$response = json_encode($data);
			echo $response;
		}

		function update_product(){
			$pro =new Product();
			$data= array();
			$data['id']=$_POST['id'];
			$data['name']=$_POST['name'];
			$data['brand_id']=$_POST['brand'];
			$data['updated_at']=$_POST['updated_at'];
			// print_r($data); die;
			// 
			$res= $pro->update($data);
			// die;
			// $response= $brands->find($_GET['id']);
			// print_r($response);
			// die;
			$response = json_encode($res);
			echo $response;
		}

		function delete(){
			$pro = new Product();
			$pro_del = new Product_detail();
			$img= new Image();
			$id= $_GET['id'];
			// echo $id;
			$data= $pro->destroy($id);
			$data= $pro_del->delproduct('product_id', $id);
			$data= $img->delproduct('product_id', $id);
		}

		function deletedetail(){
			$pro_del = new Product_detail();
			$id= $_GET['id'];
			// echo $id;
			$data= $pro_del->destroy($id);
		}
		function editDetail(){
			$id=$_GET['id'];
			$pro_del = new Product_detail();
			$color= new Color(); 
			$ram = new Ram();

			$data= $pro_del->find($id);
			$data['ram']= $ram->find($data['product_id']);
			$data['color']= $color->find($data['color_id']);
			$response = json_encode($data);
			echo $response;
		}
		function update_detail(){
			$pro_del = new Product_detail();
			$data['id']=$_POST['id'];
			$data['product_id']=$_POST['product_id'];
			$data['color_id']=$_POST['color'];
			$data['screen']=$_POST['screen'];
			$data['quantity']=$_POST['quantity'];
			$data['ram_id']=$_POST['ram'];
			$data['price']=$_POST['price'];
			$data['updated_at']=date('Y-m-d H:i:s');
			// print_r($data);
			$data= $pro_del->update($data);
			$response = json_encode($data);
			echo $response;
		}

		function managementList(){
			$pro= new Product(); 
			$pro_det= new Product_detail(); 
			$brand= new Brand();
			$color= new Color();
			$img= new Image(); 
			$ram = new Ram();
			$order = new Order();
			$order_det = new Orders_detail();
			$user= new User();
			$data= $order->getAll();
			
			foreach ($data as $key => $value) {
				$data[$key]['user']= $user->find($value['user_id']);
				$data[$key]['produc_det']= $order_det->finddetail('order_id',$value['id']);
				foreach ($data[$key]['produc_det'] as $key1 => $value1) {
					
					
					$value1[$key1]['product']= $pro->find($value1['product_id']);
					$value1[$key1]['product']['brand']= $brand->find($value1[$key1]['product']['brand_id']);
					$value1[$key1]['det'] = $pro_det->find($value1['product_detail_id']);

					$data[$key]['product']=$value1[$key1]['product'];
					$data[$key]['product']['brand']=$value1[$key1]['product']['brand'];

					// $data[$key]['produc_det'][$key1]['det']=$value1[$key1]['det'];



					// $ram1=$value1[$key1]['det']['ram_id'];
					// $color1=$value1[$key1]['det']['color_id'];

					// $data[$key]['produc_det'][$key1]['det']['color']= $color->find($color1);
					// $data[$key]['produc_det'][$key1]['det']['ram']= $ram->find($ram1);
					
				}
			
			}
			include_once('views/admin/management.php');
			// echo "<pre>";
			// 	print_r($data);
			// echo "</pre>";
		
		}
		function detailSale(){
			$pro= new Product(); 
			$pro_det= new Product_detail(); 
			$brand= new Brand();
			$color= new Color();
			$img= new Image(); 
			$ram = new Ram();
			$order = new Order();
			$order_det = new Orders_detail();
			$user= new User();
			$data= $order->getAll();

			$id= $_GET['id'];
			$data= $order->find($id);
			$data['user']=$user->find($data['user_id']);
			$data['order_det']=$order_det->finddetail('order_id',$id);
			foreach ($data['order_det'] as $key => $value) {
				$data['order_det'][$key]['product']= $pro->find($value['product_id']);
				$data['order_det'][$key]['product']['brand']= $pro->find($data['order_det'][$key]['product']['brand_id']);
				// $data['order_det'][$key]['product']['img']= $img->find($data['order_det'][$key]['product']['brand_id']);
				$data['order_det'][$key]['det']=$pro_det->find($value['product_detail_id']);
				$data['order_det'][$key]['det']['color']=$color->find($data['order_det'][$key]['det']['color_id']);
				$data['order_det'][$key]['det']['ram']=$ram->find($data['order_det'][$key]['det']['ram_id']);
			}
			$response = json_encode($data);
			echo $response;
			die;
			echo "<pre>";
				print_r($data);
			echo "</pre>";

		}
	}
?>