<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<!-- Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="public/assets/Login/popuo-box.css" rel="stylesheet" type="text/css" media="all" />

 <link rel="stylesheet" href="public/assets/Login/style.css" type="text/css" media="all">

<link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">


</head>
<body style="background-image: url(public/assets/Login/b2.jpg);">

   <!-- <h1>Đăng Nhập</h1> -->

   <div class="w3layoutscontaineragileits">
   <h2>Login here</h2>
      <form action="" method="post">
         <input type="email" Name="email" placeholder="EMAIL" required>
         <input type="password" Name="password" placeholder="MẬT KHẨU" required>
         <ul class="agileinfotickwthree">
            <li>
               <input type="checkbox" id="brand1" value="">
               <label for="brand1"><span></span>Ghi nhớ đăng nhập</label>
               <a href="#">Quên mật khẩu</a>
            </li>
         </ul>
         <div class="aitssendbuttonw3ls">

            <input type="submit" value="LOGIN" class="submitLogin" name="login">
            <p> Trở Lại Cửa Hàng <span>→</span> <a  href="http://localhost/csdl/?mod=shop&act=list"> Click Here</a></p>
            <div class="clear"></div>
         </div>
      </form>
   </div>
   
   <div class="w3footeragile">
      <p>Design by <a href=m" target="_blank">Quynh</a></p>
   </div>

   
   <script type="text/javascript" src="public/assets/Login/jquery-2.1.4.min.js"></script>

   <!-- pop-up-box-js-file -->  
      <script src="public/assets/Login/jquery.magnific-popup.js" type="text/javascript"></script>
   <!--//pop-up-box-js-file -->
   <script>
      $(document).ready(function() {
      $('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
         type: 'inline',
         fixedContentPos: false,
         fixedBgPos: true,
         overflowY: 'auto',
         closeBtnInside: true,
         preloader: false,
         midClick: true,
         removalDelay: 300,
         mainClass: 'my-mfp-zoom-in'
      });
                                                      
      });
   </script>
   <script>
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $('.submitLogin').on('click', function(){
         // alert('vào');
         $.ajax({
            type:'post',
            dataType:'JSON',
            url: '?mod=login&act=login',
            
            success: function (response){
              
            },
            error:function(error){

            }
         });
      })
   </script>

</body>
<!-- //Body -->

</html>