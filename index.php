<?php 
	session_start();
			// session_destroy();

	if (isset($_GET['mod'])) {
		$mod = $_GET['mod'];
	}else{
		$mod = 'products';
	}

	if (isset($_GET['act'])) {
		$act = $_GET['act'];
	}else{
		$act = 'list';
	}
	switch ($mod) {
		case "login":{
			include_once("controllers/LoginController.php");

			$login=new LoginController();
			switch ($act) {
				case 'login':
					$login->login();
					break;
				case 'logout':
					$login->logout();
					break;
				
				default:
					echo "404 error";
					break;
			}
			break;
		}
		// if(isset($_SESSION['login'])){}
		case 'products':
			include_once('controllers/ProductsController.php');
			$product= new ProductsController();
			switch ($act) {
				case 'list':
					$product->list();
					break;
				case 'add':
					$product->add();
					break;
				case 'uploadimg':
					$product->uploadimg();
					break;
				case 'adddetail':
					$product->adddetail();
					break;
				// case 'detail':
				// 	$product->detail();
				// 	break;
				case 'edit':
					$product->edit();
					break;
				case 'update_product':
					$product->update_product();
					break;
				case 'delete':
					$product->delete();
					break;
				case 'deletedetail':
					$product->deletedetail();
					break;
				case 'editDetail':
					$product->editDetail();
					break;
				case 'update_detail':
					$product->update_detail();
					break;
				case 'managementList':
					$product->managementList();
					break;
				case 'detailSale':
					$product->detailSale();
					break;
				default:
					# code...
					break;
			}
			break;
		case 'Brands':
			include_once('controllers/BrandsController.php');
			$brand= new BrandsController();
			switch ($act) {
				case 'list':
					$brand->list();
					break;
				case 'add':
					$brand->add();
					break;
				case 'detail':
					$brand->detail();
					break;
				case 'edit':
					$brand->edit();
					break;
				case 'update':
					$brand->update();
					break;
				case 'delete':
					$brand->delete();
					break;
				default:
					echo("Chức năng không tồn tại !!");
					break;
			}

			break;
		// }
		case 'shop':
			include_once('controllers/ShopController.php');
			$shop= new ShopController();
			switch ($act) {
				case 'list':
					$shop->list();
					break;
				case 'detail':
					$shop->detail();
					break;
				case 'add2cart':
					$shop->add2cart();
					break;
				case 'viewcart':
					$shop->viewcart();
					break;
				case 'add1':
					$shop->add1();
					break;
				case 'minus1':
					$shop->minus1();
					break;
				case 'deleteitem':
					$shop->deleteitem();
					break;
				case 'confirm':
					$shop->confirm();
					break;
				default:
					echo("Chức năng không tồn tại !!");
					break;
			}
			break;
		default:
			# code...
			break;
	}

 ?>


