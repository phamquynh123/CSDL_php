<?php include_once('views/layout/header.php'); ?>

<h2 class="page-header">Quản Lí Bán Hàng</h2>

<table class="table table-hover" style="background-color: white; text-align: center">
	<thead>
		<tr style="text-align: center;">
			<th style="text-align: center;">Mã đơn hàng</th>
			<th style="text-align: center;">Người mua hàng</th>
			<th style="text-align: center;">Sản phẩm</th>
			<th style="text-align: center;">Hãng sản xuất</th>
			<th style="text-align: center;">Tổng tiền</th>
			<th style="text-align: center;">Hành động</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $key => $value) { ?>
		<tr>
			<td><?php echo $value['id'] ?></td>
			<td><?php echo $value['user']['username'] ?></td>
			<td><?php echo $value['product']['name'] ?></td>
			<td><?php echo $value['product']['brand']['name'] ?></td>
			<td><?php echo $value['total'] ?></td>
			<td>
				<button type="button" class="btn btn-warning showDetail" data-toggle="modal" data-target="#showDetail" title="Xem chi tiết" data-id="<?php echo $value['id'] ?>"><i class="fas fa-eye"></i></button>
			</td>
		</tr>
		<?php } ?> 
		
	</tbody>
</table>


<?php include_once('views/layout/footer.php'); ?>


<!-- xem chi tiết -->
<div id="showDetail" class="modal fade" role="dialog">
     	<div class="modal-dialog" style="width: 70%">
     		<div class="modal-content">
     			<div class="modal-header">
     				<button type="button" class="close" data-dismiss="modal">&times;</button>
     				<h2 class="modal-title">Chi tiết đơn Hàng</h2>
     			</div>
     			<div class="modal-header">
     				<h3 class="modal-title">Thông tin Khách Hàng</h3>
     			</div>

     			<div class="modal-body">
     				<p class="col-md-4">Tên khách Hàng:</p>
     				<p class="username col-md-8"></p>
     			</div>
     			<div class="modal-body">
     				<p class="col-md-4">Số điện thoại</p>
     				<p class="phone col-md-8"></p>
     			</div>
     			<div class="modal-body">
     				<p class="col-md-4">Địa chỉ</p>
     				<p class="address col-md-8"></p>
     			</div>
     			<div class="modal-body">
     				<p class="col-md-4">Email</p>
     				<p class="email col-md-8"></p>
     			</div>

     			<div class="modal-header">
     				<h3 class="modal-title">Thông tin Sản Phẩm</h3>
     			</div>
				<div class="modal-body">
     				<table class="table table-hover" style="text-align: center;">
     					<thead>
     						<tr>
     							<th style="text-align: center;">Tên sản Phẩm</th>
     							<th style="text-align: center;">Hãng</th>
     							<th style="text-align: center;">Màu</th>
     							<th style="text-align: center;">Ram</th>
     							<th style="text-align: center;">Màn Hình</th>
     							<th style="text-align: center;">Số Lượng</th>
     							<th style="text-align: center;">Giá tiền</th>
     						</tr>
     					</thead>
     					<tbody class="det-pro">
     					</tbody>
     					<tr>
     						<td colspan="6">Tổng tiền</td>
     						<th class="total"></th>
     					</tr>
     				</table>
     			</div>

     			<div class="modal-footer">
     				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
     			</div>
     		</div>
		</div>
     </div>
	
	<!-- detailSale -->


	<script type="text/javascript">
		$.ajaxSetup({
     		headers: {
     			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     		}
     	});


		$('.showDetail').on('click', function(){
			var id= $(this).data('id');
			$('.det-pro').html('');
			$.ajax({
     			type:'post',
     			dataType:'JSON',
     			url: '?mod=products&act=detailSale&id='+id,
     			success: function (response){
     				$('.username').html(response.user.username);
     				$('.phone').html(response.user.phone);
     				$('.address').html(response.user.address);
     				$('.email').html(response.user.email);
     				$.each(response.order_det,function(key,value){
     					// console.log(value);
     					console.log(value.det.color.name);
     					$('.det-pro').append(`<tr>
								<td>`+value.product.name+`</td>
								<td>`+value.product.brand.name+`</td>
								<td>`+value.det.color.name+`</td>
								<td>`+value.det.ram.name+`</td>
								<td>`+value.det.screen+`</td>
								<td>`+value.quantity_buy+`</td>
								<td>`+value.det.price+`</td>
     						</tr>`);
     				})
     				$('.total').html(response.total);
		      	},
		      	error:function(error){

		      	}
	  		})
		});
	</script>