<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>

<head>
    <title>Easy Admin Panel an Admin Panel Category Flat Bootstrap Responsive Website Template | Sign Up :: w3layouts
    </title>
    <base href="{{asset('')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel='stylesheet' type='text/css' />
    <!-- Graph CSS -->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <!-- lined-icons -->
    <link rel="stylesheet" href="assets/css/icon-font.min.css" type='text/css' />
    <!-- //lined-icons -->
    <!-- chart -->
    <script src="assets/js/Chart.js"></script>
    <!-- //chart -->
    <!--animate-->
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="assets/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!--//end-animate-->
    <!----webfonts--->
    <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic'
        rel='stylesheet' type='text/css'>
    <!---//webfonts--->
    <!-- Meters graphs -->
    <script src="assets/js/jquery-1.10.2.min.js"></script>
    <!-- Placed js at the end of the document so the pages load faster -->

</head>

<body class="sign-in-up">
    <section>
        <div id="page-wrapper" class="sign-in-wrapper">
            <div class="graphs">
                <form data-parsley-validate class="form-horizontal form-label-left" action="admin/singup" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="sign-up">
                        <h3>Register Here</h3>
                        <h5>Personal Information</h5>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Name <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Email <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Age <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="age" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Phone <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="phone" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Address <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="address" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Information <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="information" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Department <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="department" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Position <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="position" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Permissions <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="permissions" class="form-control">
                                </div>
                            </div>
                        </div>
                        <h6>Login Information</h6>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Username <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="username" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Password <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Confirm Password <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="password" name="confirm" id="confirm_password" class="form-control">
                                    <span id='message'></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="sub_home">
                            <div class="sub_home_left">
                                <button type="submit" class="btn btn-success">Singup</button>
                            </div>
                            <div class="sub_home_right">
                                <p>Go Back to <a href="#">Home</a></p>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--footer section start-->
        <footer>
            <p>&copy 2015 Easy Admin Panel. All Rights Reserved | Design by <a href="https://w3layouts.com/"
                    target="_blank">w3layouts.</a></p>
        </footer>
        <!--footer section end-->
    </section>

    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/scripts.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
        $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else 
                $('#message').html('Not Matching').css('color', 'red');
        });
    </script>
</body>

</html>