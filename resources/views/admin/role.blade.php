@extends('layouts.admin')

@section('title','群組管理')

@section('css')

<link href="/admin/assets/css/role-style.css" rel="stylesheet">

@stop

@section('content')

@php ($REST_API = '/api/admin/role/')
        <div class="content" id="panel-list">
            <div class="container-fluid">
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
                                
                                <table id="bootstrap-table" class="table" data-toggle="table" data-url="{{$REST_API}}" data-click-to-select="ture">
                                    <thead>
                                        <th data-width="50" data-field="state" data-checkbox="true"></th>
                                        <th data-width="300" data-field="id" data-visible="false">ID</th>
                                        <th data-field="name" data-sortable="true">角色名稱</th>
                                        <th data-field="description">角色說明</th>
                                        <th data-field="actions" data-width="150" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">操作</th>
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
        <div class="content">
            <div id="panel-view" style="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <legend class="title">檢視</legend>
                                </div>

                                <div class="content">

                                    <form class="form-horizontal">
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">ID</label>
                                                <div class="col-sm-10">
                                                    <p class="form-control-static">@{{row.userName}}</p>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">角色名稱</label>
                                                <div class="col-sm-10">
                                                    <p class="form-control-static">@{{row.name}}</p>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">角色說明</label>
                                                <div class="col-sm-10">
                                                    <p class="form-control-static">@{{row.email}}</p>
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

            <div id="panel-form" style="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                <legend class="title">權限</legend>
                                </div>
                                <div class="content">
                                <form class="form-horizontal">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">頂層</label>
                                            <div class="col-sm-9">
                                                <select class="form-control menu-dropdown">
                                                    <option disabled="disabled" value="">請選擇父層</option>
                                                    <option value="">系統管理</option>
                                                    <option value="">基本資料</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">子層</label>
                                            <div class="col-sm-9">
                                                <table id="bootstrap-table" class="table role-table" data-toggle="table"data-click-to-select="ture">
                                                <thead>
                                                    <th data-width="200" data-field="child-menu">頁面名稱</th>
                                                    <th data-field="view">檢視</th>
                                                    <th data-field="create">新增</th>
                                                    <th data-field="update">修改</th>
                                                    <th data-field="delete">刪除</th>
                                                </thead>
                                                <tbody id="table-body">
                                                    <tr>
                                                        <td>帳號管理</td>
                                                        <td class="text-success"><span>Ｏ</span></td>
                                                        <td class="text-success"><span>Ｏ</span></td>
                                                        <td class="text-success"><span>Ｏ</span></td>
                                                        <td class="text-danger"><span>Ｘ</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>群組管理</td>
                                                        <td class="text-success"><span>Ｏ</span></td>
                                                        <td class="text-success"><span>Ｏ</span></td>
                                                        <td class="text-danger"><span>Ｘ</span></td>
                                                        <td class="text-success"><span>Ｏ</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>選單管理</td>
                                                        <td class="text-danger"><span>Ｘ</span></td>
                                                        <td class="text-success"><span>Ｏ</span></td>
                                                        <td class="text-success"><span>Ｏ</span></td>
                                                        <td class="text-success"><span>Ｏ</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
        </div>

        <div class="content">
            <div id="panel-view" style="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <legend class="title">修改</legend>
                                </div>

                                <div class="content">

                                    <form class="form-horizontal">
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">ID</label>
                                                <div class="col-sm-10">
                                                    <p class="form-control-static">@{{row.userName}}</p>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">角色名稱</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control"/>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">角色說明</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control"/>
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

            <div id="panel-form" style="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                <legend class="title">權限</legend>
                                </div>
                                <div class="content">
                                <form class="form-horizontal">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">頂層</label>
                                            <div class="col-sm-9">
                                                <select class="form-control menu-dropdown">
                                                    <option disabled="disabled" value="">請選擇父層</option>
                                                    <option value="">系統管理</option>
                                                    <option value="">基本資料</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">子層</label>
                                            <div class="col-sm-9">
                                                <table id="bootstrap-table" class="table role-table" data-toggle="table"data-click-to-select="ture">
                                                <thead>
                                                    <th data-width="200" data-field="child-menu">頁面名稱</th>
                                                    <th data-field="view">檢視</th>
                                                    <th data-field="create">新增</th>
                                                    <th data-field="update">修改</th>
                                                    <th data-field="delete">刪除</th>
                                                </thead>
                                                <tbody id="table-body">
                                                    <tr>
                                                        <td>帳號管理</td>
                                                        <td class="text-success">
                                                            <input class="role-checkbox" type="checkbox"/>
                                                        </td>
                                                        <td class="text-success">
                                                            <input class="role-checkbox" type="checkbox"/> 
                                                        </td>
                                                        <td class="text-success">
                                                            <input class="role-checkbox" type="checkbox"/>
                                                        </td>
                                                        <td class="text-danger">
                                                            <input class="role-checkbox" type="checkbox"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>群組管理</td>
                                                        <td class="text-success">
                                                            <input class="role-checkbox" type="checkbox"/>
                                                        </td>
                                                        <td class="text-success">
                                                            <input class="role-checkbox" type="checkbox"/>
                                                        </td>
                                                        <td class="text-danger">
                                                            <input class="role-checkbox" type="checkbox"/>
                                                        </td>
                                                        <td class="text-success">
                                                            <input class="role-checkbox" type="checkbox"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>選單管理</td>
                                                        <td class="text-danger">
                                                            <input class="role-checkbox" type="checkbox"/>
                                                        </td>
                                                        <td class="text-success">
                                                            <input class="role-checkbox" type="checkbox"/>
                                                        </td>
                                                        <td class="text-success">
                                                            <input class="role-checkbox" type="checkbox"/>
                                                        </td>
                                                        <td class="text-success">
                                                            <input class="role-checkbox" type="checkbox"/>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
        </div>


@stop

@section('script')

<script type="text/javascript">
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    var __REST_API_URL__ = '{{$REST_API}}';

    var user_id = '{{Auth::user()->id}}';
    var menu_id = '{{ $menu_id }}';

    var roles = {};

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
                roles:{},
            }
        },
        methods: {
            done: function(e) {
                if (e) e.preventDefault();
                $('#panel-view').hide();
                $('#panel-list').show();
            },
            load: function(id) {
                var _this = this;
                Vue.http.get(__REST_API_URL__ + id).then(function(response) {
                    _this.row = response.body;
                    Vue.http.get(__REST_API_URL__ + id + '/roles').then(function(response) {
                        _this.row.roles = response.body;
                        _this.row = JSON.parse(JSON.stringify(_this.row));
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
                all_roles:[],
                roles:[],
            }
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
                var _this = this;
                _this.type = id?'update':'create';

                _this.row = {};
                _this.errors.clear();

                Vue.http.get(__REST_API_URL__ + (id || 'new')).then(function(response) {
                    _this.row = response.body;
                    
                    Vue.http.get('/api/admin/role').then(function(response) {
                        _this.row.all_roles = response.body;
                        _this.row = JSON.parse(JSON.stringify(_this.row));
                    });

                    if (id) {
                        Vue.http.get(__REST_API_URL__ + id + '/roles').then(function(response) {
                            _this.row.roles = response.body;
                            _this.row = JSON.parse(JSON.stringify(_this.row));
                        });
                    }
                    else {
                        _this.row.roles = [];
                    }
                });
            }
        }
    });

    window.operateEvents = {
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
                    }, function() {
                        notifyAfterHttpError();
                    });
                }
            });
        }
    };
    
    var initDataTable = function($table) {
        $table.bootstrapTable({
            toolbar: ".toolbar",
            striped: true,
            sortOrder: 'desc',
            sortName: 'updatedAt',
            clickToSelect: true,
            showRefresh: true,
            search: true,
            showToggle: false,
            showColumns: true,
            pagination: true,
            searchAlign: 'right',
            pageSize: 8,
            clickToSelect: false,
            pageList: [8, 10, 25, 50, 100],
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

    var $table = $('#bootstrap-table');
    
    initDataTable($table);

    function operateFormatter(value, row, index) {
        
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
            $view,
            $edit,
            $delete
        ].join('');
    }


</script>
@stop
        