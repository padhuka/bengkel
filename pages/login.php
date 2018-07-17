<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <title>Login BPN</title>
        <meta charset="utf-8">
        <link href="login/css/style.css" rel='stylesheet' type='text/css' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!--webfonts-->
        <link href="login/css/font.css" rel='stylesheet' type='text/css' />
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <!--//webfonts-->
</head>
<body>
     <!-----start-main---->
     <div class="main">
        <div class="login-form">
            <h1>Member Login</h1>
                    <div class="head">
                        <img src="login/images/user.png" alt=""/>
                    </div>
                <form class="form-horizontal" enctype="multipart/form-data" novalidate id="fupForm">
                        <input type="text" name="txt_username" id="txt_username">
                        <input type="password" name="txt_password" id="txt_password">
                        <div class="submit">
                            <input type="submit" onclick="myFunction()" value="LOGIN" >
                    </div>                      
                </form>
            </div>
            
        </div>
        <script type="text/javascript">
        $(document).ready(function (){
             $("#fupForm").on('submit', function(e){
                          e.preventDefault();
                         
                                                $.ajax({
                                                  type: 'POST',
                                                  url: 'login/ceklogin.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){                              
                                                        //alert('lolos');
                                                        var hsl=data.trim();
                                                        //alert(hsl);
                                                        if (hsl=='y'){
                                                            //alert('Data Sudah ada');  
                                                            return false;
                                                            exit();
                                                        }else{                                                            
                                                            //alert('Data Berhasil Disimpan');
                                                            //var w = window.open('index.php');
                                                            window.location.href = "../index.php"
                                                        }   
                                                      }
                                                });
                      });
        });
        </script>
                
</body>
</html>