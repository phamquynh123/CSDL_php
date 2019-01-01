<?php 
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	include_once('models/Product.php');
	include_once('models/Brand.php');
	include_once('models/Image.php');
	include_once('models/Color.php');
	include_once('models/Ram.php');
	include_once('models/Product_detail.php');
	include_once('models/User.php');
	include_once('models/Order.php');
	include_once('models/Order_detail.php');
	class ShopController
	{
		
		function __construct()
		{
			$this->pro=new Product();
			$this->pro_det=new Product_detail();
			$this->color= new Color();
			$this->ram= new Ram();
			$this->brand= new Brand();


			$this->user= new User();
			$this->order = new Order();
			$this->orders_detail = new Orders_detail();
		}
	
		function list(){
			$pro= new Product(); 
			$pro_det= new Product_detail();
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
				$data[$key]['product_detail']= $pro_det->findproduct($value['id']);
				foreach ($data[$key]['product_detail'] as $key1 => $value) {
					$data[$key]['product_detail'][$key1]['color']=$color->find($value['color_id']);
					$data[$key]['product_detail'][$key1]['ram']=$ram->find($value['ram_id']);
				}
			}
			
			include_once('views/Shop/shop.php');
		}

		function detail(){

			$pro= new Product(); 
			$pro_det= new Product_detail();
			$brand= new Brand();
			$color= new Color();
			$img= new Image(); 
			$ram = new Ram();
			$id= $_GET['id'];
			$data= array();

			$data['product']= $pro->find($id);
			$data['product_detail']= $pro_det->findproduct($id);
			foreach ($data['product_detail'] as $key => $value) {
				$data['product_detail'][$key]['color']=$color->find($value['color_id']);
				$data['product_detail'][$key]['ram']=$ram->find($value['ram_id']);
			}
			$data['img']= $img->findproduct($id);
			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";
			// die;


			include_once('views/Shop/detail.php');
		}
		function add2cart(){
			$id=$_GET['id'];
			$iddet=$_GET['iddet'];
			
			$data=array();
			$data['product']= $this->pro->find($id);
			$data['pro_det']= $this->pro_det->find($_GET['iddet']);

			$brand= $this->brand->find($data['product']['brand_id']);
			$data['product']['brand']= $brand['name'];
			$color= $this->color->find($data['pro_det']['color_id']);
			$data['pro_det']['color']= $color['name'];
			$ram= $this->ram->find($data['pro_det']['ram_id']);
			$data['pro_det']['ram']= $ram['name'];

			if(isset($_GET['id'])){
				if(isset($_SESSION['cart'][$_GET['id']][$_GET['iddet']])){
					$_SESSION['cart'][$_GET['id']][$_GET['iddet']]['quantity_buy'] ++;
				}else{
					$_SESSION['cart'][$_GET['id']][$_GET['iddet']]=$data;
					$_SESSION['cart'][$_GET['id']][$_GET['iddet']]['quantity_buy']=1;
				}
			}

			echo "<pre>";
			print_r($_SESSION['cart']);
			echo "</pre>";
			die;
		}

		function viewcart(){
			$response = json_encode($_SESSION['cart']);
			echo $response;
			die;
		}

		function add1(){
			$id=$_GET['id'];
			$iddet= $_GET['iddet'];
			if(isset($_SESSION['cart'][$id])){
				$_SESSION['cart'][$id][$iddet]['quantity_buy']++;
			}
			$response = json_encode($_SESSION['cart']);
			echo $response;
			die;

		}
		function minus1(){
			$id=$_GET['id'];
			$iddet= $_GET['iddet'];
			// if (isset($_GET['id'])) {
				
				if (isset($_SESSION['cart'][$id])) {
					if ($_SESSION['cart'][$id][$iddet]['quantity_buy'] >  1) {
						$_SESSION['cart'][$id][$iddet]['quantity_buy']--;
					}else{
						unset($_SESSION['cart'][$id][$iddet]);
					}
				}
			// }
			// 	echo "<pre>";
			// print_r($_SESSION['cart']);
			// echo "</pre>";
			// die;
			$response = json_encode($_SESSION['cart']);
			echo $response;
			die;
		}


		function deleteitem(){
			$id=$_GET['id'];
			$iddet= $_GET['iddet'];
			if (isset($_SESSION['cart'][$id][$iddet])) {
				unset($_SESSION['cart'][$_GET['id']][$iddet]);
			}
			
			$response = json_encode($_SESSION['cart']);
			echo $response;
			die;
		}

		function confirm(){
			if(isset($_SESSION['cart'])){
				$data= array();
				$data['username']= $_POST['username'];
				$data['email']= $_POST['email'];
				$data['address']= $_POST['address'];
				$data['phone']= $_POST['phone'];
				$data['created_at'] =date('Y-m-d H:i:s');

				$data= $this->user->insert($data);
				$id = $this->user->getNewId();

				$order= array();
				$order['user_id']= $id;
				$tong=0;
				foreach ($_SESSION['cart'] as $key => $value) {
					foreach ($value as $key1 => $value1) {
						$tong = $tong+ $value1['quantity_buy']*$value1['pro_det']['price'];
					}
				}
				$order['total']= number_format($tong);
				$order=$this->order->insert($order);
				$id_order= $this->order->getNewId();

				$order_detail=array();
				foreach ($_SESSION['cart'] as $key => $value) {
					foreach ($value as $key1 => $value1) {
						$order_detail['quantity_buy']=$value1['quantity_buy'];
						$order_detail['order_id']=$id_order;
						$order_detail['product_id']= $key;
						$order_detail['product_detail_id']= $key1;
						$order_detail['created_at']=date('Y-m-d H:i:s');
						// echo "<pre>";print_r($order_detail);echo "</pre>";
						
						$res= $this->orders_detail->insert($order_detail);
					}
				}
				unset($_SESSION['cart']);
				die;
			}
		}
	}

 ?>