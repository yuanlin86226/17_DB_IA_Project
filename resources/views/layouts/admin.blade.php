<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="/admin/assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>@yield('title')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap core CSS     -->
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
        
    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="/admin/assets/css/app.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.min.css" rel="stylesheet">
    
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <!-- <link href="/admin/assets/css/demo.css" rel="stylesheet" /> -->

    <!-- CSS -->
    <link href="/admin/assets/css/custom.css" rel="stylesheet" />
        
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/admin/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <link href="/admin/assets/css/adminBlade.css" rel="stylesheet" href="" />

    @yield('css')
    
    @show

</head>
<body>

    

<div class="wrapper">
    <div class="sidebar" data-color="azure" data-image="/admin/assets/img/full-screen-image-4.jpg">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

        <div class="logo text-center">
            <!-- <a href="#" class="logo-text">
                IA 3rd
            </a> -->
            <img src="/admin/assets/img/97.png" alt="" style="max-height:30px" />
        </div>

    	<div class="sidebar-wrapper">
            <ul id="menu" class="nav" v-cloak>
                <li v-for="item in items" :class="item.active && 'active'">
                    <a v-if="item.childs.length==0" :href="item.href" :title="item.title">
                        <i :class="item.icon"></i>
                        <p>@{{ item.title }}</p>
                    </a>
                    <a v-if="item.childs.length>0" data-toggle="collapse" :href="'#menuItem'+item.id">
                        <i :class="item.icon"></i>
                        <p>@{{ item.title }}
                        <b class="caret"></b>
                        </p>
                    </a>
                    <div v-if="item.childs.length>0" :class="item.open?'collapse in':'collapse'" :id="'menuItem'+item.id" >
                        <ul class="nav">
                            <li v-for="item in item.childs" :class="item.active && 'active'"><a :href="item.href" :title="item.title">@{{ item.title }}</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">@yield('page_title')</a>
                </div>
                <div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown dropdown-with-icons">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-user"></i>
								<p>
									{{ Auth::user()->userName }}
									<b class="caret"></b>
								</p>
							</a>
							<ul class="dropdown-menu dropdown-with-icons">
								<li>
									<a href="profile">
										<i class="pe-7s-lock"></i> 修改帳號資料
									</a>
								</li>
								<li>
									<a href="logout" class="text-danger swal-prompt">
										<i class="pe-7s-close-circle"></i>
										登出
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
            </div>
        </nav>


        @yield('content')


        <footer class="footer" style="background-color: transparent;">
            <div class="container-fluid">
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-tree tree"></i> by 97line
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Vue.js   -->
    <script src="/lib/vue/dist/vue.min.js"></script>
    <script src="/lib/vue-resource/dist/vue-resource.min.js"></script>
    <script src="/lib/vee-validate/dist/vee-validate.min.js"></script>
    <script src="/lib/vee-validate/dist/locale/zh_TW.js"></script>
    <script src="/lib/moment/min/moment.min.js"></script>

    

    <!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
    <script src="/admin/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="/admin/assets/js/jquery-ui.min.js" type="text/javascript"></script> 
	<script src="/admin/assets/js/bootstrap.min.js" type="text/javascript"></script>


	<!--  Forms Validations Plugin -->
	<script src="/admin/assets/js/jquery.validate.min.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="/admin/assets/js/moment.min.js"></script>

    <!--  date.format.js -->
	<script src="/admin/assets/js/date.format.js"></script>

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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.min.js"></script> -->
    <!-- <script src="/admin/assets/js/sweetalert2.js"></script> -->
    
    <!-- Vector Map plugin -->
	<script src="/admin/assets/js/jquery-jvectormap.js"></script>

    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>

	<!-- Wizard Plugin    -->
     <script src="/admin/assets/js/jquery.bootstrap.wizard.min.js"></script> 

    <!--  Bootstrap Table Plugin    -->
    <script src="/admin/assets/js/bootstrap-table.js"></script>

	<!--  Plugin for DataTables.net  -->
    <script src="/admin/assets/js/jquery.datatables.js"></script>

    <!--  Full Calendar Plugin    -->
    <script src="/admin/assets/js/fullcalendar.min.js"></script>

    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	 <script src="/admin/assets/js/light-bootstrap-dashboard.js"></script> 

    <!-- sweetalert2.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.min.js"></script>

	<script type="text/javascript">
    
        var notifyAfterHttpSuccess = function(response) {
            if (!response) return;
            var body = response.body || response;
            if (body && body.message) {
                $.notify({
                    message: body.message
                }, {
                    type: body.type || (body.result?'success':'danger'),
                    timer: 1500
                });
            }
        };

        var notifyAfterHttpError = function(response) {
            var message = response?'操作失敗(代碼: ' + response.status + ' - ' + response.statusText + ')':'操作失敗';
            $.notify({
                message: message
            }, {
                type: 'danger',
                timer: 2000
            });
        };

        var getUrlParameter = function(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };

        Vue.use(VeeValidate, {locale: 'zh_TW'}); // good to go. 

        // Setup Vue Filters
        Vue.filter('formatDate', function(value) {
            if (!value) return value;
            return moment(String(value)).format('YYYY/MM/DD HH:mm:ss');
        });

        Vue.filter('formatBasename', function(value) {
            if (!value) return value;
            return value.split('/').pop();
        });

        Vue.filter('showdown', function(value) {
            if (!value) return value;
            return showdown.makeHtml(value);
        });

        var adminMenu = new Vue({
            el: '#menu',
            data: {
                items: []
            },
            created: function() {
                var _this = this;
                this.fetch();
            },
            updated: function() {
                // light bootstrap dashboard sidebar init
                lbd.initSidebarsCheck();
                lbd.initMinimizeSidebar();
                lbd.initCollapseArea();
            },
            mounted: function() {
                // nothing
            },
            methods: {
                fetch: function() {
                    var _this = this;
                    Vue.http.get('/api/admin/menu_list/'+{{Auth::user()->id}}).then(function(response) {
                        var items = response.body;
                        var currentPath = location.pathname;

                        for (var i = 0; i < items.length; i++) {
                            var item = items[i];

                            if (item.childs && item.childs.length > 0) {
                                for (var j = 0; j < item.childs.length; j++) {
                                    subItem = item.childs[j];

                                    if (currentPath.indexOf(subItem.href) === 0) {
                                        subItem.active = true;
                                        item.open = true;
                                    }
                                }
                            }
                            else {
                                if (item.href != '/admin/' && currentPath.indexOf(item.href) === 0) {
                                    item.active = true;
                                }
                                else if (item.href === currentPath) {
                                    item.active = true;
                                }
                            }
                        }
                        _this.items = items;
                        _this.items = JSON.parse(JSON.stringify(_this.items));
                        // console.log(_this.items);

                        // Vue.nextTick(function() {
                        //     $(document).ready(load_scrollbar);
                        //     copyright.getcopyright();
                        // });
                    });
                }
            }
        });

	</script>
    @yield('script')
</html>
