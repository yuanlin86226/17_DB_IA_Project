@extends('layouts.admin')

@section('title','選單管理')
@section('page_title','選單管理')

@section('content')

@php ($REST_API = '/api/admin/menu/')
        <div class="content" id="panel-list">
            <div class="container-fluid">

            

             <ol id="breadcrumb" class="breadcrumb" v-cloak style="[v-cloak] {display: none}">
                <li v-if="!row.id">頂層</li>
                <li v-if="row.id"><a href="/admin/menu">頂層</a></li>
                <li v-if="row.id" class="active">@{{row.title}}</li>
            </ol> 
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content table-responsive table-full-width">

                                <div id="toolbox" class="toolbar">
                                    <button v-if="roles.insert" v-on:click="create" id="btn-create" class="btn btn-default" type="button" title="新增一位人員">
                                        <i class="glyphicon fa fa-plus"></i>
                                        新增
                                    </button>
                                    &nbsp;
                                    <button v-if="roles.delete" v-on:click="delete_many" id="btn-remove" class="btn btn-default" type="button" title="刪除人員">
                                        <i class="glyphicon fa fa-remove"></i>
                                        刪除
                                    </button>
                                    &nbsp;
                                </div>
                                
                                @if( isset($_GET['parent']) )
                                    <table v-if="" id="bootstrap-table" class="table" data-toggle="table" data-url="{{$REST_API}}?parent={{$_GET['parent']}}" data-click-to-select="ture">
                                @else
                                    <table v-if="" id="bootstrap-table" class="table" data-toggle="table" data-url="{{$REST_API}}" data-click-to-select="ture">
                                @endif
                                
                                
                                    <thead>
                                        <th data-field="state" data-width="50" data-checkbox="true"></th>
                                        <th data-field="id" data-width="50" data-visible="false" class="text-center">ID</th>
                                        <th data-field="icon" data-sortable="true" data-formatter="displayIcon">圖示</th>
                                        <th data-field="title" data-sortable="true">標題</th>
                                        <th data-field="href" data-sortable="true">位址</th>
                                        <th data-field="created_at" data-visible="false" data-sortable="true">建立時間</th>
                                        <th data-field="updated_at" data-visible="false" data-sortable="true">更新時間</th>
                                        <th data-field="actions" data-width="200" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">操作</th>
                                    </thead>
                                    <tbody id="table-body"></tbody>
                                </table>

                                <div class="clearfix"></div>

                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <div class="content" id="panel-view" style="display:none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">檢視</h4>
                            </div>
                            <div class="content">

                                <form class="form-horizontal">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">名稱</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{ row.title }}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">位址</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{ row.href }}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">建立日期</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{ row.created_at }}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">更新日期</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{ row.updated_at }}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-md-2"></label>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-fill btn-info" v-on:click="done">返回</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                
                                </form>
                            
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                

                </div>
            </div>
        </div>

        <div class="content" id="panel-form" style="display:none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <legend v-if="type==='update'">修改 選單</legend>
                                <legend v-if="type==='create'">新增 選單</legend>
                            </div>
                            <div class="content">
                                
                                <form  method="POST" name="user_form" class="form-horizontal">

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">預覽</label>
                                            <div class="col-sm-10">
                                                <button type="button" class="btn btn-wd btn-default">
                                                    <span class="btn-label">
                                                        <i :class="row.icon" style="font-size:28px"></i>
                                                    </span>
                                                    @{{ row.title }}
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">圖示</label>
                                            <div class="col-sm-10">
                                                <select v-model="row.icon" class="form-control">
                                                    <option disabled value="">請選擇圖示</option>
                                                    <option v-for="icon in icons" :value="icon">@{{ icon }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">名稱</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('title')}" type="text" name="title" placeholder="名稱" data-vv-as="名稱" v-model="row.title" v-validate="'required'" required >
                                                <span v-show="errors.has('title')" class="help-block"> @{{errors.first('title')}} </span>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">位址</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('href')}" type="text" name="href" placeholder="位址" data-vv-as="位址" v-model="row.href" v-validate="'required'" required >
                                                <span v-show="errors.has('href')" class="help-block"> @{{errors.first('href')}} </span>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">上層選單</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" v-model="row.parent" disabled>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-md-2"></label>
                                            <div class="col-md-10">
                                                <button type="submit" class="btn btn-fill btn-info" v-on:click="save" v-if="type==='update'">更新</button>
                                                <button type="submit" class="btn btn-fill btn-info" v-on:click="save" v-if="type==='create'">儲存</button>
                                                <button type="submit" class="btn btn-default" v-on:click="cancel">取消</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                                
                                <div class="clearfix"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@stop

@section('script')

<script type="text/javascript">
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    var $table = $('#bootstrap-table');

    var __REST_API_URL__ = '{{$REST_API}}';

    var user_id = '{{Auth::user()->id}}';
    var menu_id = '{{ $menu_id }}';

    if (window.location.search!=""){
        var parent_arr = window.location.search.split("=");
        var __PARENT_ID__ = parent_arr[1];
    } else {
        var __PARENT_ID__ = null;
    }

    new Vue({
        el: "#breadcrumb",
        data: {
            row: {}
        },
        mounted: function() {
            if (__PARENT_ID__) {
                var _this = this;
                Vue.http.get(__REST_API_URL__ + __PARENT_ID__).then(function(response) {
                    _this.row = response.body;
                });
            }
        }
    });

    function displayIcon(value, row, index) {
        return '<i class="' + value + '" style="font-size:150%"></i> <small>' + value + '</small>';
    }

    var toolBox = new Vue({
        el: '#toolbox',
        data: {
            roles:{},
            
        },
        mounted: function(){
            _this = this;
            
            Vue.http.get('/api/admin/user/'  + user_id + '/roles/' +  menu_id).then(function(response) {
                _this.roles = response.body;
                roles = response.body;
            });
        },
        methods: {
            create: function(id){
                $('#panel-list').hide();
                $('#panel-form').show();
                panelForm.load();
            },
            delete_many: function() {
                var selections = $table.bootstrapTable('getAllSelections');

                if (selections.length == 0) {
                    swal("尚未選取任何資料");
                    return;
                }

                var ids = selections.map(function(x) {
                    return x.id;
                });

                swal({title: "確認刪除",
                    text: "是否確定要刪除多筆資料？",
                    type: "warning",
                    showCancelButton: true
                }).then( function(isConfirm) {
                    if (isConfirm) {
                        console.log(ids);
                        Vue.http.delete(__REST_API_URL__, {body: ids}).then(function(response) {
                            notifyAfterHttpSuccess(response.body);
                            $table.bootstrapTable('refresh');
                        }, function() {
                            notifyAfterHttpError();
                        });
                    }
                });
            }
        }
    });
    
    var panelView = new Vue({
        el: '#panel-view',
        data: {
            row: {
                title: "Undefined"
            }
        },
        methods: {
            done: function(e) {
                if (e) e.preventDefault();
                $('#panel-view').hide();
                $('#panel-list').show();
            },
            load: function(id) {
                _this = this;
                Vue.http.get(__REST_API_URL__ + id).then(function(response) {
                    _this.row = response.body;
                    Vue.http.get(__REST_API_URL__ + id + '/roles').then(function(response) {
                        _this.row.roles = response.body;
                    });
                });
            }
        }
    });

    var panelForm = new Vue({
        el: '#panel-form',
        data: {
            type: 'create',
            row: {
                _token: csrf_token,
            },
            icons: ["pe-7s-album","pe-7s-arc","pe-7s-back-2","pe-7s-bandaid","pe-7s-car","pe-7s-diamond","pe-7s-door-lock","pe-7s-eyedropper","pe-7s-female","pe-7s-gym","pe-7s-hammer","pe-7s-headphones","pe-7s-helm","pe-7s-hourglass","pe-7s-leaf","pe-7s-magic-wand","pe-7s-male","pe-7s-map-2","pe-7s-next-2","pe-7s-paint-bucket","pe-7s-pendrive","pe-7s-photo","pe-7s-piggy","pe-7s-plugin","pe-7s-refresh-2","pe-7s-rocket","pe-7s-settings","pe-7s-shield","pe-7s-smile","pe-7s-usb","pe-7s-vector","pe-7s-wine","pe-7s-cloud-upload","pe-7s-cash","pe-7s-close","pe-7s-bluetooth","pe-7s-cloud-download","pe-7s-way","pe-7s-close-circle","pe-7s-id","pe-7s-angle-up","pe-7s-wristwatch","pe-7s-angle-up-circle","pe-7s-world","pe-7s-angle-right","pe-7s-volume","pe-7s-angle-right-circle","pe-7s-users","pe-7s-angle-left","pe-7s-user-female","pe-7s-angle-left-circle","pe-7s-up-arrow","pe-7s-angle-down","pe-7s-switch","pe-7s-angle-down-circle","pe-7s-scissors","pe-7s-wallet","pe-7s-safe","pe-7s-volume2","pe-7s-volume1","pe-7s-voicemail","pe-7s-video","pe-7s-user","pe-7s-upload","pe-7s-unlock","pe-7s-umbrella","pe-7s-trash","pe-7s-tools","pe-7s-timer","pe-7s-ticket","pe-7s-target","pe-7s-sun","pe-7s-study","pe-7s-stopwatch","pe-7s-star","pe-7s-speaker","pe-7s-signal","pe-7s-shuffle","pe-7s-shopbag","pe-7s-share","pe-7s-server","pe-7s-search","pe-7s-film","pe-7s-science","pe-7s-disk","pe-7s-ribbon","pe-7s-repeat","pe-7s-refresh","pe-7s-add-user","pe-7s-refresh-cloud","pe-7s-paperclip","pe-7s-radio","pe-7s-note2","pe-7s-print","pe-7s-network","pe-7s-prev","pe-7s-mute","pe-7s-power","pe-7s-medal","pe-7s-portfolio","pe-7s-like2","pe-7s-plus","pe-7s-left-arrow","pe-7s-play","pe-7s-key","pe-7s-plane","pe-7s-joy","pe-7s-photo-gallery","pe-7s-pin","pe-7s-phone","pe-7s-plug","pe-7s-pen","pe-7s-right-arrow","pe-7s-paper-plane","pe-7s-delete-user","pe-7s-paint","pe-7s-bottom-arrow","pe-7s-notebook","pe-7s-note","pe-7s-next","pe-7s-news-paper","pe-7s-musiclist","pe-7s-music","pe-7s-mouse","pe-7s-more","pe-7s-moon","pe-7s-monitor","pe-7s-micro","pe-7s-menu","pe-7s-map","pe-7s-map-marker","pe-7s-mail","pe-7s-mail-open","pe-7s-mail-open-file","pe-7s-magnet","pe-7s-loop","pe-7s-look","pe-7s-lock","pe-7s-lintern","pe-7s-link","pe-7s-like","pe-7s-light","pe-7s-less","pe-7s-keypad","pe-7s-junk","pe-7s-info","pe-7s-home","pe-7s-help2","pe-7s-help1","pe-7s-graph3","pe-7s-graph2","pe-7s-graph1","pe-7s-graph","pe-7s-global","pe-7s-gleam","pe-7s-glasses","pe-7s-gift","pe-7s-folder","pe-7s-flag","pe-7s-filter","pe-7s-file","pe-7s-expand1","pe-7s-exapnd2","pe-7s-edit","pe-7s-drop","pe-7s-drawer","pe-7s-download","pe-7s-display2","pe-7s-display1","pe-7s-diskette","pe-7s-date","pe-7s-cup","pe-7s-culture","pe-7s-crop","pe-7s-credit","pe-7s-copy-file","pe-7s-config","pe-7s-compass","pe-7s-comment","pe-7s-coffee","pe-7s-cloud","pe-7s-clock","pe-7s-check","pe-7s-chat","pe-7s-cart","pe-7s-camera","pe-7s-call","pe-7s-calculator","pe-7s-browser","pe-7s-box2","pe-7s-box1","pe-7s-bookmarks","pe-7s-bicycle","pe-7s-bell","pe-7s-battery","pe-7s-ball","pe-7s-back","pe-7s-attention","pe-7s-anchor","pe-7s-albums","pe-7s-alarm","pe-7s-airplay"]
        },
        methods: {
            close: function(e) {
                $('#panel-form').hide();
                $('#panel-list').show();

                $table.bootstrapTable('refresh');
            },
            save: function(e) {
                if (e) e.preventDefault();

                _this = this;
                
                this.$validator.validateAll().then(function() {

                    var cb_success = function(response) {
                        notifyAfterHttpSuccess(response.body);
                        if (response.body.result) {
                            adminMenu.fetch();
                            _this.close();
                        }
                    };

                    if (_this.type == 'update') {
                        Vue.http.put(__REST_API_URL__ + _this.row.id, _this.row).then(cb_success, notifyAfterHttpError);

                    }
                    else {
                        Vue.http.options.emulateJSON = true;
                        Vue.http.post(__REST_API_URL__, _this.row).then(cb_success, notifyAfterHttpError);
                        Vue.http.options.emulateJSON = false;                       
                    }

                }).catch(function() {
                    $('.form-control.error').first().focus();
                });
            },
            cancel: function(e) {
                if (e) e.preventDefault();
                this.close();
            },
            load: function(id) {
                _this = this;
                if (!id) {
                    _this.type = 'create';
                    _this.row = {
                        icon: "",
                        title: "",
                        parent: __PARENT_ID__
                    };
                }
                else {
                    _this.type = 'update';
                    $.getJSON(__REST_API_URL__ + id, function(data) {
                        _this.row = data;
                    });
                }
            }
        }
    });

    window.operateEvents = {
        'click .open': function (e, value, row, index) {
            location.href='/admin/menu?parent='+row.id;
        },
        'click .view': function (e, value, row, index) {
            $('#panel-list').hide();
            $('#panel-view').show();
            panelView.load(row.id);
        },
        'click .edit': function (e, value, row, index) {
            $('#panel-list').hide();
            $('#panel-form').show();
            panelForm.load(row.id);
        },
        'click .remove': function (e, value, row, index) {
            swal({title: "確認刪除",
                text: "是否確定要刪除此筆資料？",
                type: "warning",
                showCancelButton: true
            }).then( function(isConfirm) {
                if (isConfirm) {
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: [row.id]
                    });
                    Vue.http.delete(__REST_API_URL__ + row.id).then(function(response) {
                        notifyAfterHttpSuccess(response.body);
                        adminMenu.fetch();
                    }, function() {
                        notifyAfterHttpError();
                    });
                }
            });
        }
    };
    var initDataTable = function($table) {
        $table.bootstrapTable({
            locale: 'zh-TW',
            toolbar: ".toolbar",
            striped: true,
            sortOrder: 'desc',
            sortName: 'order',
            clickToSelect: true,
            showRefresh: true,
            search: true,
            showToggle: false,
            showColumns: true,
            pagination: true,
            searchAlign: 'right',
            pageSize: 25,
            clickToSelect: false,
            pageList: [25, 50, 100],
            formatShowingRows: function(pageFrom, pageTo, totalRows){
                return "共 " + totalRows + " 筆 ";
            },
            formatRecordsPerPage: function(pageNumber){
                return "每頁顯示 " + pageNumber + " 筆資料";
            },
            icons: {
                refresh: 'fa fa-refresh',
                toggle: 'fa fa-th-list',
                columns: 'fa fa-columns',
                detailOpen: 'fa fa-plus-circle',
                detailClose: 'fa fa-minus-circle'
            }
        });
        $(window).resize(function () {
            $table.bootstrapTable('resetView');
        });
    };

    initDataTable($table);

    

    function operateFormatter(value, row, index) {
        if (__PARENT_ID__==null) {
            $parent = [
                '<a rel="tooltip" title="開啟" class="btn btn-simple btn-info btn-icon table-action open" href="javascript:void(0)">'+
                    '<i class="fa fa-folder-open-o"></i>'+
                '</a>'
            ]
        } else { $parent = []; }

        if(roles.view){
            $view = [
                '<a rel="tooltip" title="檢視" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">'+
                    '<i class="fa fa-file-text-o"></i>'+
                '</a>'
            ];
        } else { $view = []; }

        if(roles.edit){
            $edit = [
                '<a rel="tooltip" title="修改" class="btn btn-simple btn-warning btn-icon table-action edit" href="javascript:void(0)">'+
                    '<i class="fa fa-edit"></i>'+
                '</a>'
            ];
        } else { $edit = []; }

        if(roles.delete){
            $delete = [
                '<a rel="tooltip" title="移除" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">'+
                    '<i class="fa fa-remove"></i>'+
                '</a>'
            ];
        } else { $delete = []; }

        return [
            $parent,
            $view,
            $edit,
            $delete
        ].join('');
        
    }


</script>
@stop



