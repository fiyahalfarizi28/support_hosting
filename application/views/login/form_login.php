<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN - <?php echo NAMA_APLIKASI ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="create-by" content="Reynaldi">
        <meta name="create-date" content="15/05/2019">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/loginstyle.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/font/css/all.min.css') ?>">
        <link href="<?php echo base_url('favicon.ico') ?>" rel="shortcut icon">
    </head>
    <div class="preloader">
        <div class="loading" style="text-align:center">
            <img src="<?php echo base_url('assets/img/loading.gif') ?>" width="80" style="background-color: transparent">
            <p>Please wait</p>
        </div>
    </div>
    <body>

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
    
                    <img src="logo.png" alt="logo" style="width:200px;height:200px;" class="center">

                        <h2 style="text-align: center; margin-top: 15px; color: #c40202"class=""><b>SUPPORT</b></h2>
                        
                        <form  name="form_login" id="form_login" method="POST">
                            <div class="form-group">
                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input  id="username" name="username" type="text" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required="required" autofocus="autofocus">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    
                                    <div class="field-wrapper">
                                    <a href="javascript:void(0)" onclick="proses_login()" style="background-color: #c40202; margin-top: 8px" class="btn btn-primary" id="btn_login" value="">Log in</a>
                                    </div>
                                </div>
                            </div>
                        </form>       
                            
                        <p class="terms-conditions" style="margin-top:50px !important;"><h6 style="text-align: center"><a target="_blank" href="upload/manual_books.pdf" >Buku Panduan</a></h6></p>             
                        <p class="terms-conditions" >© 2020 PT. BPR Kredit Mandiri Indonesia </p>
                        

                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script>
    $(document).ready(function () {
        $(".preloader").fadeOut(1000);
    });

    function proses_login() {
        var data = $('#form_login').serialize();
        $.ajax({
            url : 'auth_controller/login',
            type : 'post',
            cahce : false,
            data : data,
            dataType : 'json',
            beforeSend : function(){
                $('#btn_login').html("<img src='assets/img/loading.gif' width='80' style='background-color: transparent>");
            },
            success : function(result){
                localStorage.clear();
                var isValid = result.isValid;
                var isPesan = result.isPesan;
                if(isValid == 1){
                    $('#btn_login').html('Masuk');
                    $('#btn_login').show();
                    $('#pesan').html(isPesan);
                }else{
                    window.location.href = './';
                }
            }
        });
    }
    </script>

    </body>
</html>
