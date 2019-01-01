<?php include_once('views/layout/header.php'); ?>
<h2 class="page-header" style="background-color: white;  padding: 10px 10px">Sản phẩm</h2>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal1" style="margin-bottom: 10px">Thêm mới</button>

<table class="table table-hover" style="background-color: white;text-align: center" id="example1">
	<style type="text/css"> th{text-align: center;}
		.table-edit input{
			width: 100px;
		}


	</style>
	
	<tr>
		<th>Mã số</th>
		<th>Tên</th>
		<th >Hình ảnh</th>
		<th>Hãng sản xuất</th>
		<th>Ngày thêm mới</th>
		<th>Hành động</th>
	</tr>
	<tbody>
		<?php foreach ($data as $key => $value) { ?>
		<tr>
			<td><?php echo $value['id']; ?></td>
			<td><?php echo $value['name']; ?></td>
			<td style="width:80px; height: 80px">
				<img src="<?php if($value['img'] != null)
				echo $value['img'][0]['link']; 
				else echo "public/image/product/defaul.png";
				?>" style="width: 80px; height:80px">
				
			</td>
			<td><?php echo $value['brand']['name']; ?></td>
			<td><?php echo $value['created_at']; ?></td> 
			<td>
				<button type="button" class="btn btn-info add-detail" data-toggle="modal" data-target="#AddDetail" title="Thêm Chi Tiết" data-id="<?php echo $value['id']; ?>"><i class="fas fa-plus-square"></i></button>
				<button type="button" class="btn btn-success uploadimg" data-toggle="modal" data-target="#uploadimage" title="Thêm ảnh" data-id="<?php echo $value['id']; ?>"><i class="far fa-images"></i></button>
				<button type="button" class="btn btn-primary editproduct" data-toggle="modal" data-target="#editproduct" title="Sửa thông tin" data-id="<?php echo $value['id']; ?>"><i class="far fa-edit"></i></button>
				<button type="button" class="btn btn-warning showDetail" data-toggle="modal" data-target="#showDetail" title="Sửa thông tin" data-id="<?php echo $value['id']; ?>"><i class="fas fa-eye"></i></button>
				 <button type="button" class="btn btn-danger delete-product" title="Xóa Sản phẩm" data-id= "<?php echo $value['id']; ?>"><i class="fas fa-trash-alt"></i></button>
				

                 </td>
             </tr>
             <?php } ?>
        </tbody>
    </table>
     <!-- add detail product -->
     <div id="AddDetail" class="modal fade" role="dialog">
     	<div class="modal-dialog"  style="width: 80%;">
     		<div class="modal-content">
     			<div  style="width: 70%; display: inline-block;float: left;">
     				<div class="modal-body">
		 				<h4>Thông tin chi tiết.</h4>
		 				<table class="table table-hover" id="aaaa" style="text-align: center;">
		 					<thead>
		 						<tr>
		 							<th>Mã số</th>
		 							<th>Màu</th>
		 							<th>Giá</th>
		 							<th>Số Lượng</th>
		 							<th>Màn Hình</th>
		 							<th>Ram</th>
		 							<th>Ngày nhập hàng.</th>
		 							<th>Hành động</th>
		 						</tr>
		 					</thead>
		 					<tbody class="table-edit" >
		 						<tr>
		 						</tr>
		 					</tbody>
		 				</table>
		 			</div>
     			</div>
     			<div  style="width: 28%; display: inline-block;" >
     				
     			
     			<div class="modal-header">
     				<button type="button" class="close" data-dismiss="modal">&times;</button>
     				<h4 class="modal-title">Thêm Mới Chi Tiết Sản Phẩm</h4>
     			</div>
     			<form action="" method="POST" role="form" enctype="multipart/form-data">
     				<div class="modal-body">
	     				<p>Chọn màu.</p>
	     				<select class="form-control" name="color" class="color" id="colorad">
	     					<?php foreach ($colors as $key => $value): ?>
	     						<option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?>
	     						</option>
	     					<?php endforeach ?>
	     				</select>
	     			</div>
	     			<div class="modal-body">
	     				<p>Màn Hình</p>
	     				<input type="text" name="screen" placeholder="Màn hình sản phẩm." id="screenadd" class="form-control">
	     			</div>
	     			<div class="modal-body">
	     				<p>Ram</p>
	     				<select class="form-control" name="ram" class="ram" id="ramad">
	     					<?php foreach ($rams as $key => $value): ?>
	     						<option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
	     					<?php endforeach ?>
	     				</select>
	     			</div>
	     			<div class="modal-body">
	     				<p>Số lượng</p>
	     				<input type="text" name="quantity" placeholder="Tên sản phẩm." id="quantityadd" class="form-control">
	     			</div>
	     			<div class="modal-body">
	     				<p>Giá</p>
	     				<input type="text" name="price" placeholder="giá sản phẩm." id="priceadd" class="form-control">
	     			</div>
					<div class="modal-footer">
	     				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	     				<button type="button" class="btn btn-info sub-add-detail">Submit</button>
	     			</div>
	     			</div>
	     		</form>
     			

     			
     		</div>

     	</div>
     </div>

      <!-- edit detail product -->
     <div id="editDetail" class="modal fade" role="dialog">
          <div class="modal-dialog" >
               <div class="modal-content">                         
                    
                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4 class="modal-title"> Sửa Chi Tiết Sản Phẩm</h4>
                    </div>
                    <form action="" method="POST" role="form" enctype="multipart/form-data">
                         <div class="modal-body">
                              <p id="edittid"></p>
                         </div>
                          <div class="modal-body">
                              <p id="edit_product_id"></p>
                         </div>
                         <div class="modal-body">
                              <p>Chọn màu.</p>
                              <select class="form-control" name="color" class="color" id="coloredit">
                                   <?php foreach ($colors as $key => $value): ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?>
                                        </option>
                                   <?php endforeach ?>
                              </select>
                         </div>
                         <div class="modal-body">
                              <p>Màn Hình</p>
                              <input type="text" name="screen" placeholder="Màn hình sản phẩm." id="screenedit" class="form-control" required>
                         </div>
                         <div class="modal-body">
                              <p>Ram</p>
                              <select class="form-control" name="ram" class="ram" id="ramedit">
                                   <?php foreach ($rams as $key => $value): ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                   <?php endforeach ?>
                              </select>
                         </div>
                         <div class="modal-body">
                              <p>Số lượng</p>
                              <input type="text" name="quantity" placeholder="Tên sản phẩm." id="quantityedit" class="form-control" required>
                         </div>
                         <div class="modal-body">
                              <p>Giá</p>
                              <input type="text" name="price" placeholder="giá sản phẩm." id="priceedit" class="form-control" required>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-info sub-edit-detail">Submit</button>
                         </div>
                    </form>
               </div>

          </div>
     </div>



     <!-- add new product -->

     <div id="myModal1" class="modal fade" role="dialog">
     	<div class="modal-dialog">
     		<div class="modal-content">
     			<div class="modal-header">
     				<button type="button" class="close" data-dismiss="modal">&times;</button>
     				<h4 class="modal-title">Thêm mới sản phẩm</h4>
     			</div>
     			<div class="modal-body">
     				<p>Tên sản phẩm</p>
     				<input type="text" name="name" placeholder="Tên sản phẩm." id="addname" class="form-control">
     			</div>
     			<div class="modal-body">
     				<p>Hãng sản xuất.</p>
     				<select class="form-control" name="brandd" class="brand" id="brandad">
     					<?php foreach ($brands as $key => $value): ?>
     						<option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
     					<?php endforeach ?>
     				</select>
     			</div>
     			<div class="modal-footer">
     				<button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
     				<button type="submit" class="btn btn-info add" data-dismiss="modal">Thêm mới</button>
     			</div>
     		</div>
		</div>
     </div>
	
	<!-- update product -->
    <div id="editproduct" class="modal fade" role="dialog">
     	<div class="modal-dialog">
     		<div class="modal-content">
     			<div class="modal-header">
     				<button type="button" class="close" data-dismiss="modal">&times;</button>
     				<h2 class="modal-title">Sửa thông tin sản phẩm</h2>
     			</div>
     			<div class="modal-body">
     			<form action="" method="POST" role="form">
     				<div class="modal-body">
     					<input type="hidden" name="" id="edit-product">
		 				<p>Tên sản phẩm</p>
		 				<input type="text" name="name" placeholder="Tên sản phẩm." id="edit-name" class="form-control" >
		 			</div>
		 			<div class="modal-body">
		 				<p>Hãng sản xuất : </p> <p id="edit-brand"></p>
		 				<select class="form-control" name="brandd" class="brand" id="edit-brandd">
	     					<?php foreach ($brands as $key => $value): ?>
	     						<option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
	     					<?php endforeach ?>
	     				</select>
		 			</div>
		 			
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
						<button type="button" class="btn btn-info update-product" data-dismiss="modal">SỬA THÔNG TIN</button>
					</div>
     			</form>
	     		</div>
			</div>
	    </div>
	</div>


    <!-- upload image -->
    <div id="uploadimage" class="modal fade" role="dialog">
     	<div class="modal-dialog">
     		<div class="modal-content">
     			<div class=" main-section" style="margin-top: 10px">
     				<h1 class="text-center text-danger">Chọn ảnh cho sản phẩm của bạn</h1><br>
     				<div class="form-group">
     					<div class="file-loading">
     						<form action="?mod=products&act=uploadimg" method="POST" role="form">
     							<div class="form-group">
     								<input id="file-1" type="file" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2" >

     							</div>
     						</form>
						<div>
     				</div>
     			</div>
			</div>
     	</div>
    </div></div></div></button></button></div></div></div></div></div>

	<!-- show detail -->
	<div id="showDetail" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width: 70%">

			<div class="modal-content">
                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h2 class="modal-title">thông tin sản phẩm</h2>
                    </div>
                    <div class="modal-body">
                    <form action="" method="POST" role="form">
                         <div class="modal-body">
                              <p>Mã sản phẩm</p>
                              <p id="show-product" class="form-control"></p>
                         </div>
                         <div class="modal-body">
                             
                              <p>Tên sản phẩm</p>
                              <p class="form-control" id= show-name></p>
                         </div>
                         <div class="modal-body">
                              <p>Hãng sản xuất : </p> <p id="show-brand" class="form-control"></p>
                              
                         </div>
                         <div class="modal-body">
                              <h4>Thông tin chi tiết.</h4>
                              <table class="table table-hover" style="text-align: center;">
                                   <thead>
                                        <tr>
                                             <th>Mã số</th>
                                             <th>Màu</th>
                                             <th>Giá</th>
                                             <th>Số Lượng</th>
                                             <th>Màn Hình</th>
                                             <th>Ram</th>
                                             <th>Ngày nhập hàng.</th>
                                        </tr>
                                   </thead>
                                   <tbody class="table-edit" >
                                        <tr>
                                        </tr>
                                   </tbody>
                              </table>
                         </div>
                         
                         <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                         </div>
                    </form>
                    </div>
               </div>

		</div>
	</div>
 <?php  include_once('views/layout/footer.php'); ?> 
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>


    <script type="text/javascript">
     	$('.uploadimg').on('click', function(){
     		var id= $(this).data('id');
     		$('#file-1').attr('data-id', id);
     		var file=$('#file-1').data('id');
     		// $('#add-id-img').attr('value', id);
     		// alert(id);
     	});
     	$("#file-1").fileinput({
     		theme: 'fa',
     		uploadUrl: "?mod=products&act=uploadimg",
     		
     		uploadExtraData: function() {
     			var id=$('#file-1').data('id');
     			return {
     				_token: $("input[name='_token']").val(),
     				product_id: id,
     			};
     		},

     		allowedFileExtensions: ['jpg', 'png', 'gif'],
     		overwriteInitial: false,
     		maxFileSize:2000,
     		maxFilesNum: 10,
     		slugCallback: function (filename) {
     			return filename.replace('(', '_').replace(']', '_');
     		}
     	});
    </script>

     <script type="text/javascript">

     	$.ajaxSetup({
     		headers: {
     			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     		}
     	});
     	$('.add').on('click', function(){
     		$('#addname').text('');
     		var brand= $('#brandad').val();
     		$.ajax({
     			type:'post',
     			dataType:'JSON',
     			url: '?mod=products&act=add',
     			data:{
     				name:$('#addname').val(),
     				brandd:brand,
     			},
     			success: function (response){
     				console.log(response);
     				toastr.info('ADD SUCCESSFULLY !!!');
	          // setTimeout("location.reload(true)",1000);
	          var html=' <tr><td>'+response.id+'</td><td>'+response.name+'</td><td>'+response.created_at+'</td><td><button type="button" class="btn btn-info edit" data-toggle="modal" data-target="#edit" title="Edit" data-id= '+response.id+'><i class="far fa-edit"></i></button> <button type="button" class="btn btn-success show1" data-toggle="modal" data-target="#show1" title="Show" data-id='+response.id+'><i class="fas fa-eye"></i></button> <button type="button" class="btn btn-danger delete" title="Delete" data-id='+response.id+'><i class="fas fa-trash-alt"></i></button></td></tr>';
	          alert(html);
	          $('.tr-list').prepend(html);
	      },
	      error:function(error){

	      }
	  		})
     	});

     	$('.add-detail').on('click', function(){
     		var id= $(this).data('id');
			$('.sub-add-detail').attr('data-id', id);
     		$('#quantityadd').text("");
     		$('#priceadd').text("");
     		$('#screenadd').text("");
     		$('.table-edit').text('');
     		$.ajax({
     			type:'post',
     			dataType:'JSON',
     			url: '?mod=products&act=edit&id='+id,
     			
     			success: function (response){
     				$.each(response.product_detail,function(key,value){
     					var html= '<tr><td>'+value.id+'</td><td>'+value.color.name+'</td><td>'+value.price+'<td>'+value.quantity+'</td><td>'+value.screen+'</td><td>'+value.ram.name+'</td><td>'+value.created_at+'</td><td><button type="button" class="btn btn-warning editdetail" title="Sửa" data-id='+value.id+'  data-toggle="modal" data-target="#editDetail" ><i class="far fa-edit"></i></button> <button type="button" class="btn btn-danger deletedetail" title="Delete" data-id='+value.id+'><i class="fas fa-trash-alt"></i></button> </td></tr>';
				        $('.table-edit').append(html);
				    })
     			},
               });
     	});


          $(document).on('click','.deletedetail', function(){
     		var id = $(this).data('id');
     		alert(id);
               var parent = $(this).parent();

               swal({
                    title: "Xóa Sản Phẩm ?",
                    text: "Khi xóa, Bạn sẽ không thể khôi phục lại sản phẩm này!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
               })
               .then((willDelete) => {
                    if (willDelete) {
                         $.ajax({
                              url: '?mod=products&act=deletedetail&id='+ id,
                              success: function (response) {
                                   // toastr.info('DELETE SUCCESSFULLY !!!');
                              }
                         }); 
                         parent.slideUp(300, function () {
                              parent.closest("tr").remove();
                         });
                         swal("Xóa Thành Công!", {
                              icon: "success",
                         });
                    } else {
                         swal("Hủy Xóa Thành Công!!");
                    }
               });
     	});
          $(document).on('click','.editdetail', function(){
               var id = $(this).data('id');
               // alert(id);
               $.ajax({
                    type: 'post',
                    dataType: 'JSON',
                    url: '?mod=products&act=editDetail&id='+id,
                    success: function(response){
                         console.log(response);
                         $("#edittid").val(response.id);
                         $("#coloredit").val(response.color.id);
                         $("#edit_product_id").val(response.product_id);
                         $("#screenedit").val(response.screen);
                         $("#quantityedit").val(response.quantity);
                         $("#ramedit").val(response.ram.id);
                         $("#priceedit").val(response.price);

                    }
               })
          });
          $(document).on('click','.sub-edit-detail', function(){
               $.ajax({
                    type:'post',
                    dataType: 'JSON',
                    url:'?mod=products&act=update_detail',
                    data:{
                         id:$("#edittid").val(),
                         product_id: $("#edit_product_id").val(),
                         color:$("#coloredit").val(), 
                         screen:  $("#screenedit").val(),
                         quantity:$("#quantityedit").val(),
                         ram: $("#ramedit").val(),
                         price:$("#priceedit").val(), 
                    },
                    success: function(response){
                         toastr.success('SỬA THÔNG TIN SẢN PHẨM THÀNH CÔNG !!!');
                         setTimeout("location.reload(true)",1000);
                         // console.log(response);
                    },
               })
          });

     	$('.sub-add-detail').on('click', function(){
     		var id= $(this).data('id');
     		$.ajax({
     			type:'post',
     			dataType:'JSON',
     			url: '?mod=products&act=adddetail&id='+id,
     			data: {
     				color:$('#colorad').val(),
     				ram:$('#ramad').val(),
     				quantity:$('#quantityadd').val(),
     				price:$('#priceadd').val(),
     				screen:$('#screenadd').val(),
     			},
     			success: function (response){
     				console.log(response);
     				toastr.info('THÊM MỚI THÀNH CÔNG !!');
     				var html= '<tr><td>'+response.id+'</td><td>'+response.color.name+'</td><td>'+response.price+'<td>'+response.quantity+'</td><td>'+response.screen+'</td><td>'+response.ram.name+'</td><td>'+response.created_at+'</td><td> <button type="button" class="btn btn-danger deletedetail" title="Delete" data-id='+response.id+'><i class="fas fa-trash-alt"></i></button> </td></tr>';
				        $('.table-edit').append(html);
		    	},
	  		})
     	});

     	$('.editproduct').on('click', function(){
     		var id = $(this).data('id');
     		 $('.table-edit').text('');
     		$.ajax({
     			type:'post',
     			dataType:'JSON',
     			url: '?mod=products&act=edit&id='+id,
     			
     			success: function (response){
     				console.log(response);
     				$('#edit-product').attr('value',response.product.id);
					$('#edit-name').attr('value',response.product.name);
					$('#edit-brand').text(response.brand.name);
					// $.each(response.product_detail,function(key,value){
                         // 					var html= '<tr><td>'+value.id+'</td><td>'+value.color.name+'</td><td>'+value.price+'<td>'+value.quantity+'</td><td>'+value.screen+'</td><td>'+value.ram.name+'</td><td>'+value.created_at+'</td><td> <button type="button" class="btn btn-danger deletedetail" title="Delete" data-id='+value.id+'><i class="fas fa-trash-alt"></i></button> </td></tr>';
				 //        $('.table-edit').append(html);
				    // })
		    	     },
	  		})
     	});
     	$('.update-product').on('click',function(){
     		var id=$('#edit-product').val();
     		// var name =$('#edit-name').val();
     		// var brand = $('#edit-brandd').val();
     		// alert(id);
     		$.ajax({
     			type:'post',
     			dataType: 'JSON',
     			url:'?mod=products&act=update_product&id='+id,
     			data:{
     				id:id,
     				name:$('#edit-name').val(), 
     				brand: $('#edit-brandd').val(),
     			},
     			success: function(response){
     				toastr.success('SỬA THÔNG TIN SẢN PHẨM THÀNH CÔNG !!!');
     				setTimeout("location.reload(true)",1000);
     				// console.log(response);

     				// $('#editpr').modal('hide'); 
		          
		          
		      	},
		  	})

     	})

     	$('.delete-product').on('click', function(){
     		var id1 = $(this).data('id');
     		var parent = $(this).parent();

     		swal({
     			title: "Xóa Sản Phẩm ?",
     			text: "Khi xóa, Bạn sẽ không thể khôi phục lại sản phẩm này!",
     			icon: "warning",
     			buttons: true,
     			dangerMode: true,
     		})
     		.then((willDelete) => {
     			if (willDelete) {
     				$.ajax({
     					url: '?mod=products&act=delete&id='+ id1,
     					success: function (response) {
     						// toastr.info('DELETE SUCCESSFULLY !!!');
     					}
     				}); 
     				parent.slideUp(300, function () {
     					parent.closest("tr").remove();
     				});
     				swal("Xóa Sản Phẩm Thành Công!", {
     					icon: "success",
     				});
     			} else {
     				swal("Hủy Xóa Thành Công!!");
     			}
     		});
     	});

     	$('.showDetail').on('click', function(){
     		var id = $(this).data('id');
               $('.table-edit').text('');
     		$.ajax({
     			type:'post',
     			dataType:'JSON',
     			url: '?mod=products&act=edit&id='+id,
     			
     			success: function (response){
     				$('#show-product').text(response.product.id);
                         $('#show-name').text(response.product.name);
                         $('#show-brand').text(response.brand.name);
                         $.each(response.product_detail,function(key,value){
                              var html= '<tr><td>'+value.id+'</td><td>'+value.color.name+'</td><td>'+value.price+'<td>'+value.quantity+'</td><td>'+value.screen+'</td><td>'+value.ram.name+'</td><td>'+value.created_at+'</td></tr>';
                            $('.table-edit').append(html);
                        })
		    	     },
	  		})
     	});

</script>


