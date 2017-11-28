<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="/admin/assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>登入</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS     -->
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    
    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="/admin/assets/css/app.css" rel="stylesheet">
    
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/admin/assets/css/demo.css" rel="stylesheet" />
    
        
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/admin/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body> 



<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="azure" data-image="/admin/assets/img/full-screen-image-5.jpg">   

    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <form method="POST" action="{{ action('AuthController@login') }}">
                            {{ csrf_field() }}

                            <div class="card card-hidden">
                                <div class="header text-center">Login</div>

                                @if($errors->has('msg'))
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-4 text-center text-danger">
                                            {!! $errors->first('msg') !!}
                                        </div>
                                    </div>
                                @endif

                                <div class="content">
                                    <div class="form-group">
                                        <label>帳號</label>
                                        <input name="username" type="text" placeholder="Username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>密碼</label>
                                        <input name='password' type="password" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox">

                                            <input name="remember" type="checkbox" data-toggle="checkbox">
                                            記住帳號名稱
                                        </label>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-fill btn-info btn-wd">登入</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


</body>

    <!--   Vue.js   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.1/vue.min.js"></script>
    
    <!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
    <script src="/admin/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="/admin/assets/js/jquery-ui.min.js" type="text/javascript"></script> 
	<script src="/admin/assets/js/bootstrap.min.js" type="text/javascript"></script>
	
	
	<!--  Forms Validations Plugin -->
	<script src="/admin/assets/js/jquery.validate.min.js"></script>
	
	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="/admin/assets/js/moment.min.js"></script>
	
    <!--  Date Time Picker Plugin is included in this js file -->
    <script src="/admin/assets/js/bootstrap-datetimepicker.js"></script>
    
    <!--  Select Picker Plugin -->
    <script src="/admin/assets/js/bootstrap-selectpicker.js"></script>
    
	<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
	<script src="/admin/assets/js/bootstrap-checkbox-radio-switch-tags.js"></script>
	
	<!--  Charts Plugin -->
	<script src="/admin/assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="/admin/assets/js/bootstrap-notify.js"></script>
    
    <!-- Sweet Alert 2 plugin -->
	<script src="/admin/assets/js/sweetalert2.js"></script>
        
    <!-- Vector Map plugin -->
	<script src="/admin/assets/js/jquery-jvectormap.js"></script>
	
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
	
	<!-- Wizard Plugin    -->
    <script src="/admin/assets/js/jquery.bootstrap.wizard.min.js"></script>

    <!--  Datatable Plugin    -->
    <script src="/admin/assets/js/bootstrap-table.js"></script>
    
    <!--  Full Calendar Plugin    -->
    <script src="/admin/assets/js/fullcalendar.min.js"></script>
    
    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="/admin/assets/js/light-bootstrap-dashboard.js"></script>
	
	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	<script src="/admin/assets/js/demo.js"></script>
	    
    <script type="text/javascript">
        $().ready(function(){
            lbd.checkFullPageBackgroundImage();
            
            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
    
</html>