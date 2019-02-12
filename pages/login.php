<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
include_once '../lib/setting.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login <?php echo $title;?> </title>
       <!--  <meta charset="utf-8">
        <link href="login/css/style.css" rel='stylesheet' type='text/css' />
        <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <webfonts
        <link href="login/css/font.css" rel='stylesheet' type='text/css' />
        <script src="../bower_components/jquery/dist/jquery.min.js"></script> 
 <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <!--//webfonts-->
</head>
<body>
     <!-----start-main---->
    <!--  <div class="main">
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
            
        </div> -->

<!------ Include the above in your HEAD tag ---------->

    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading" style="color:#fff;background-color:#d64b3b">
                        <div class="panel-title" style="font-size: 20px; text-align: center;font-weight: bold;">Log In</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form  class="form-horizontal" enctype="multipart/form-data" novalidate id="fupForm">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="txt_username" type="text" class="form-control" name="txt_username" placeholder="username">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="txt_password" type="password" class="form-control" name="txt_password" placeholder="password">
                                    </div>

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>

                                    </div>
                          <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                       <input type="submit" onclick="myFunction()" value="LOGIN" style="background-color: lightblue;">

                                    </div>
                                </div>

          
                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:14px; font-style: italic;" >
                                        GEMILANG Body Repair - Semarang 
                                        
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
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