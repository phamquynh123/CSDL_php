<?php include_once('views/layout/header.php'); ?>

<h2 class="page-header">BRANDS</h2>

<table class="table table-hover"  id="tablee"  onload="Refresh()">
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="margin-bottom: 10px">Add New</button>
  <style type="text/css"> th{text-align: center;} table{background-color: white;text-align: center}</style>
  <thead>
    <tr>
      <th>id</th>
      <th>name</th>
      <th>created_at</th>
      <th>action</th>
    </tr>
    <tbody class="tr-list">
    <?php foreach ($data as $key => $value) { ?>
    <tr>
      <td><?php echo $value['id']; ?></td>
      <td><?php echo $value['name']; ?></td>
      <td><?php echo $value['created_at']; ?></td> 
      <td>
        <!--  <button type="button" class="btn btn-info show" data-toggle="modal" data-target="#show" title="Show"><i class="far fa-edit"></i></button> -->
        <button type="button" class="btn btn-info edittttt" data-toggle="modal" data-target="#edit" title="Edit" data-id= <?php echo $value['id']; ?> > <i class="far fa-edit"></i></button>
        <button type="button" class="btn btn-success show1" data-toggle="modal" data-target="#show1" title="Show" data-id= <?php echo $value['id']; ?>><i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-danger delete" title="Delete" data-id= <?php echo $value['id']; ?>><i class="fas fa-trash-alt"></i></button>

      </td>   
      </tr>
      <?php } ?>
    </tbody>
  </thead>

</table>

<!-- addnew -->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Brand</h4>
      </div>
      <div class="modal-body">
        <input type="text" name="name" placeholder="Nhập tên hãng" id="addname" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default addsubmit" data-dismiss="modal">Submit</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Show -->
<div id="show1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Product Detail</h4>
      </div>
      <div class="modal-body">
       <table  class="table table-hover" >
        <thead>
          <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>CREATED_AT</th>
          </tr>
          </thead>
          <tbody id="show-detail">
          </tbody>
        </table>
     </div>
     <div class="modal-footer">

      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>


<!-- Edit -->
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT BRAND</h4>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="id" id="idedit">
         <p>BRANDS NAME</p>
          <input type="text" name="brandname" id="brandname" class="form-control">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info submit-edit" data-dismiss="modal">Submit</button>

        
      </div>
    </div>

  </div>
</div>
<?php include_once('views/layout/footer.php'); ?>
<script type="text/javascript">

 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


  $('.addsubmit').on('click',function(e){
    e.preventDefault();
    $('#addname').text('');
    $.ajax({
      type:'post',
      dataType:'JSON',
      url: '?mod=Brands&act=add',
      data:{
        name:$('#addname').val(),
      },
      success: function (response){
        console.log(response);
        toastr.info('ADD SUCCESSFULLY !!!');
          // setTimeout("location.reload(true)",1000);
          var html=' <tr><td>'+response.id+'</td><td>'+response.name+'</td><td>'+response.created_at+'</td><td><button type="button" class="btn btn-info edit" data-toggle="modal" data-target="#edit" title="Edit" data-id= '+response.id+'><i class="far fa-edit"></i></button> <button type="button" class="btn btn-success show1" data-toggle="modal" data-target="#show1" title="Show" data-id='+response.id+'><i class="fas fa-eye"></i></button> <button type="button" class="btn btn-danger delete" title="Delete" data-id='+response.id+'><i class="fas fa-trash-alt"></i></button></td></tr>';
          // alert(html);
          $('.tr-list').prepend(html);
      },
      error:function(error){

      }
    })
  });

  $('.show1').on('click', function(e){  
   e.preventDefault();
   var id= $(this).data('id');
   $('#show-detail').text('');

   $.ajax({
     type:'get',
     // DataType:'JSON',
     url: '?mod=Brands&act=detail&id='+ id,
     success: function(response){
       $.each(JSON.parse(response),function(key,value){
        var html='<tr><td>'+value.id+'</td><td>'+value.name+'</td><td>'+value.created_at+'</td></tr>';
        $('#show-detail').prepend(html);
       })
      } 
    });
 });



  $('.edittttt').on('click', function(){
    var id=$(this).data('id');
    $.ajax({
       method: 'get',
       DataType:'JSON',
       url: '?mod=Brands&act=edit&id='+ id,
       success: function(response){
        var response= JSON.parse(response);
        console.log(response);
        console.log(response.name);
        $('#brandname').attr('value',response.name);
        $('#idedit').attr('value',response.id);
      }
    });
  });
  $('.submit-edit').on('click', function(e){
      e.preventDefault();
      var id = $('#idedit').val(); 
      var name= $('#brandname').val();
      alert($('#brandname').val());
      alert(id);
      $.ajax({
        type:'post',
        dataType: 'JSON',
        url:'?mod=Brands&act=update&id='+id+'&brandname='+name,
        data:{
          id:id,
          name:$('#brandname').val(), 
        },
        success: function(response){setTimeout("location.reload(true)",1000);
          console.log(response);
          
          $('#editpr').modal('hide'); 
          // toastr.info('EDIT BRAND SUCCESSFULLY !!!');
          
        },
      })
  });



  // delete
    $(".btn-danger").click(function(e){

        var id=$(this).data('id');
        var parent = $(this).parent();

        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url: '?mod=Brands&act=delete&id='+ id,
              type: 'delete',
              success: function (response) {
                toastr.info('DELETE SUCCESSFULLY !!!');
              }
            }); 
            parent.slideUp(300, function () {
              parent.closest("tr").remove();
            });
            swal("Poof! Your imaginary file has been deleted!", {
              icon: "success",
            });
          } else {
            swal("Cancel brand deletion!!");
          }
        });
      });
</script>