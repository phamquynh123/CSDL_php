<?php include_once('views/layout/headerShop.php') ?>

<!-- <style src="public/shop/shopdetail/js-shopDetail-Img/abc-gallery-css.css"></style> -->
<link rel="stylesheet" type="text/css" href="public/shop/shopdetail/js-shopDetail-Img/abc-gallery-css.css">
<script src="public/shop/shopdetail/js-shopDetail-Img/abc-gallery-js.js"></script>
<link rel="stylesheet" type="text/css" href="public/shop/shopdetail/js-shopDetail-Img/yourcss-detail.css">
<!--content-->
<div class="content">
	<!--single-->
	<div class="single-wl3">
		<div class="container">
			<div class="single-grids">
				<div class="col-md-10 single-grid" style="margin-left:10%">
					<div clas="single-top">
						<div class="single-left col-md-4">
							<div class="abc-gallery-div">
								<ul class="abc-ul-gallery">
									<li><a href="<?php echo $data['img'][0]['link'] ?>"><img src="<?php echo $data['img'][0]['link'] ?>" alt=""/></a></li>
								</ul>
								<?php foreach ($data['img'] as $key => $value){ ?>
								<div class="col-md-5">
									<a href="<?php echo $value['link'] ?>"><img src="<?php echo $value['link'] ?>" alt=""/></a>
								</div>
								<?php } ?>
							</div>
							<div style="clear: both;"></div>
						</div>
						<div class="single-right simpleCart_shelfItem col-md-8">
							<h2><?php echo $data['product']['name']; ?></h2>
							<h4 class="idProduct" data-id="<?php echo $data['product']['id'] ?>">Mã sản phẩm: <?php echo $data['product']['id'] ?></h4>
							<p></p>
							<div class="block">
								<div class="starbox small ghosting"> </div>
							</div>
							<p class="price item_price"></p>
							<div class="description">
								<p><span> <h4>Chi Tiết Sản Phẩm : </h4>  </span> <?php echo $data['product']['description']; ?></p>
							</div>
							<div class="color-quality">
								<table class="table table-hover table-detail-Product">
									<thead>
										<tr>
											<th>Screen</th>
											<th>Color</th>
											<th>Ram</th>
											<th>Quantity</th>
											<th>price</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($data['product_detail'] as $key => $value) { ?>
										<tr class="div-screen">
											<td><?php echo $value['screen'] ?></td>
											<td><?php echo $value['color']['name'] ?></td>
											<td><?php echo $value['ram']['name'] ?></td>
											<td><?php echo $value['quantity'] ?></td>
											<td><?php echo $value['price'] ?></td>
											<td class="add2cart" style="cursor: pointer;" data-iddet="<?php echo $value['id']?>">Thêm giỏ hàng</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>

								<button type="button" class="btn btn-warning btn-xs viewcart" data-toggle="modal" data-target="#view">XEM GIỎ HÀNG</button>


							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>

		</div>
	</div>
</div>
<!--content-->



<!-- show cart -->

<div class="container">
	<div class="modal fade" id="view" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Giỏ Hàng của bạn</h4>
				</div>
				<div class="modal-body">
					<table class="table table-hover table-view-cart">
						<thead>
							<tr>
								<th>Tên sản phẩm</th>
								<th>Hãng sản xuất</th>
								<th>Ram</th>
								<th>Màu</th>
								<th>Số Lượng </th>
								<th> Giá </th>
								<th> Thành tiền </th>
								<th> Hành động</th>
							</tr>
						</thead>
						<tbody class="tbody-viewcart">
						</tbody>
						<tr class="Tong"></tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info Buy-product" data-toggle="modal" data-target="#MuaHang">Mua Hàng</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

</div>

<!-- Mua hang -->
<div id="MuaHang" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"> Thông tin khách hàng.</h4>
			</div>
			<form action="" method="POST" role="form">

				<div class="modal-body">
					<p>Email.</p>
					<input type="email" name="email" class="form-control" required id="user-email" value="">
				</div>
				<div class="modal-body">
					<p>Username.</p>
					<input type="text" name="username" class="form-control" id="user-name" required  value="">
				</div>

				<div class="modal-body">
					<p>Địa chỉ</p>
					<input type="text" name="address" class="form-control" required id="user-address" value="">
				</div>
				<div class="modal-body">
					<p>Số điện thoại</p>
					<input type="number" name="phone" class="form-control" required id="user-phone" value="">
				</div>
				<div class="modal-body" style="text-align: right; margin-right:5%">
					<button type="submit" class="btn btn-primary confirm-buy">Xác Nhận Mua Hàng</button>
				</div>
			</form>

			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-primary confirm-buy" data-dismiss="modal">Xác nhận mua hàng</button> -->
			</div>
		</div>

	</div>
</div>






<?php include_once('views/layout/footerShop.php') ?>


<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$(document).ready(function(){
		$('.add2cart').on('click',function(){
			var id= $('.idProduct').data('id');
			var idDet= $(this).data('iddet');
			// alert(idDet);
			$.ajax({
				type:'post',
				dataType:'JSON',
				url: '?mod=shop&act=add2cart&id='+id+'&iddet='+idDet+'',
				success: function (response){
				},
			});
			toastr.success('Đã Thêm Giỏ Hàng!!!');
		});

		// xem gio hang 
		$('.viewcart').on('click', function(){	
			$.ajax({
				type:'get',
				dataType:'JSON',
				url: '?mod=shop&act=viewcart',
				success: function (response){
					$('.tbody-viewcart').html('');
					$.each(response,function(key,value){
						$.each(value,function(key1,value1){
	 						// alert(key);
	 						var thanhtien= value1.quantity_buy*value1.pro_det.price;
	 						var html=`<tr>
	 						<td>`+value1.product.name+`</td>
	 						<td>`+value1.product.brand+`</td>
	 						<td>`+value1.pro_det.ram+`</td>
	 						<td>`+value1.pro_det.color+`</td>
	 						<td class="quantity-buy-`+key+`-`+ key1+`">`+value1.quantity_buy+`</td>
	 						<td>`+value1.pro_det.price+`</td>
	 						<td class="thanhtien-`+key+`-`+ key1+`">`+thanhtien+`</td>
	 						<td>
	 						<button type="button" class="btn btn-info add-quantity-cart" title="Thêm số lượng" data-id="<?php echo $value['id']; ?>" data-product="`+key+`" data-prodet="`+key1+`"><i class="fa fa-plus-square"></i></button>
	 						<button type="button" class="btn btn-success minus-quantity-cart" title="Trừ Số lượng" data-id="<?php echo $value['id']; ?>" data-product="`+key+`" data-prodet="`+key1+`"><i class="fa fa-minus-square"></i></button>
	 						<button type="button" class="btn btn-danger delete-product-cart" title="Loại bỏ" data-id="<?php echo $value['id']; ?>" data-product="`+key+`" data-prodet="`+key1+`"><i class="fa fa-times"></i></button>
	 						</td>

	 						</tr>`;
	 						$('.tbody-viewcart').append(html);

	 					})
					})


				},
			});
		})

		// Cong so luong trong gia hang
		$(document).on('click', '.add-quantity-cart' , function(){
			var idpro= $(this).data('product');
			var idproDet= $(this).data('prodet');
			$.ajax({
				type:'post',
				dataType:'JSON',
				url: '?mod=shop&act=add1&id='+idpro+'&iddet='+idproDet,
				success: function (response){
					// alert('jtsjuts');
					$.each(response,function(key,value){
						$.each(value,function(key1,value1){
							var thanhtien= value1.quantity_buy*value1.pro_det.price;
							$('.quantity-buy-'+key+'-'+key1).html(value1.quantity_buy);
							$('.thanhtien-'+key+'-'+key1).html(thanhtien);
						})
					})


				},
			});
		})

		$(document).on('click', '.minus-quantity-cart' , function(){
			var idpro= $(this).data('product');
			var idproDet= $(this).data('prodet');
			$.ajax({
				type:'post',
				dataType:'JSON',
				url: '?mod=shop&act=minus1&id='+idpro+'&iddet='+idproDet,
				success: function (response){
					$.each(response,function(key,value){
						$.each(value,function(key1,value1){
							var thanhtien= value1.quantity_buy*value1.pro_det.price;
							$('.quantity-buy-'+key+'-'+key1).html(value1.quantity_buy);
							$('.thanhtien-'+key+'-'+key1).html(thanhtien);
						})
					})
				},
			});
		})

		$(document).on('click', '.delete-product-cart' , function(){
			var idpro= $(this).data('product');
			var idproDet= $(this).data('prodet');
			var re= $(this);
			$.ajax({
				type:'post',
				dataType:'JSON',
				url: '?mod=shop&act=deleteitem&id='+idpro+'&iddet='+idproDet,
				success: function (response){
					re.parent().parent().remove();
				},
			});
		});



		$('.confirm-buy').on('click', function(e){
			e.preventDefault();
			// alert($('.user-name').val());
			$.ajax({
				type:'post',
				dataType:'JSON',
				data: {
					username: $('#user-name').val(),
					email: $('#user-email').val(),
					address: $('#user-address').val(),
					phone: $('#user-phone').val(),
				},
				url: '?mod=shop&act=confirm',
				success: function (response){
					
					
				},
			});
				toastr.success('Mua Hàng Thành Công ! ');
				setTimeout("location.reload(true)",1000);
		})



	})
</script>