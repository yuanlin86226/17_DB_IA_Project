<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="/admin/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/admin/assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>@yield('title')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS     -->
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Sweetalert2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.min.css" rel="stylesheet">

    <!-- Animation library for notifications   -->
    <link href="/admin/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="/admin/assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <!-- <link href="/admin/assets/css/demo.css" rel="stylesheet" /> -->

    <link rel="stylesheet" href="/admin/assets/css/custom.css">

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="/admin/assets/css/themify-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/pe-icon-7-stroke.css">

    <link rel="stylesheet" href="/admin/assets/sass/style.scss">
    <link rel="stylesheet" href="/admin/assets/css/style.css">

    @yield('css')
    
    @show

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="azure">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    IA 3rd
                </a>
            </div>

            <!-- <ul class="nav">
                <li class="active">
                    <a href="dashboard.html">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="user.html">
                        <i class="ti-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="table.html">
                        <i class="ti-view-list-alt"></i>
                        <p>Table List</p>
                    </a>
                </li>
                <li>
                    <a href="typography.html">
                        <i class="ti-text"></i>
                        <p>Typography</p>
                    </a>
                </li>
                <li>
                    <a href="icons.html">
                        <i class="ti-pencil-alt2"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a href="maps.html">
                        <i class="ti-map"></i>
                        <p>Maps</p>
                    </a>
                </li>
                <li>
                    <a href="notifications.html">
                        <i class="ti-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
				<li class="active-pro">
                    <a href="upgrade.html">
                        <i class="ti-export"></i>
                        <p>Upgrade to PRO</p>
                    </a>
                </li>
            </ul> -->

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

                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user"></i>
									<p>{{ Auth::user()->userName }}</p>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">修改帳號資料</a></li>
                                <li><a href="logout">登出</a></li>
                              </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>


        @yield('content')


        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>
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

    <!--   Core JS Files   -->
    <script src="/admin/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="/admin/assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="/admin/assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="/admin/assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="/admin/assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="/admin/assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="/admin/assets/js/demo.js"></script>

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
                        console.log(_this.items);

                        Vue.nextTick(function() {
                            $(document).ready(load_scrollbar);
                            copyright.getcopyright();
                        });
                    });
                }
            }
        });

	</script>
    @yield('script')
</html>
