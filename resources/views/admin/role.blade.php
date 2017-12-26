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
                                        <th data-field="name" data-sortable="true">群組名稱</th>
                                        <th data-field="description">群組說明</th>
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

        <div id="panel-view" class="content" style="display:none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <legend class="title">檢視資訊</legend>
                            </div>

                            <div class="content">

                                <form class="form-horizontal">

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">群組名稱</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.name}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">群組說明</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.description}}</p>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>

                                <div class="clearfix"></div>

                            </div>

                            <div class="header">
                                <legend class="title">檢視權限</legend>
                            </div>

                            <div class="content">
                                <form class="form-horizontal">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">頂層</label>
                                            <div class="col-sm-9">
                                                <select id="view_select" class="form-control menu-dropdown" v-on:change="select_change">
                                                    <option disabled="disabled" value="0" selected>請選擇父層</option>
                                                    <option v-for="parent in parents" :value="parent.id">@{{ parent.title }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">子層</label>
                                            <div class="col-sm-9">
                                                <table class="table role-table">
                                                <thead>
                                                    <th data-width="200" data-field="child-menu">頁面名稱</th>
                                                    <th data-field="view">檢視</th>
                                                    <th data-field="create">新增</th>
                                                    <th data-field="update">修改</th>
                                                    <th data-field="delete">刪除</th>
                                                </thead>
                                                <tbody id="table-body">
                                                    <tr v-if="table_datas.length == 0" style="height:100px;">
                                                        <td colspan="5" style="text-align: center;">No matching records found</td>
                                                    </tr>
                                                    <tr v-for="table_data in table_datas">
                                                        <td>@{{table_data.title}}</td>
                                                        <td v-if="table_data.view == true" class="text-success"><span>Ｏ</span></td>
                                                        <td v-if="table_data.view == false"class="text-danger"><span>Ｘ</span></td>
                                                        <td v-if="table_data.insert == true" class="text-success"><span>Ｏ</span></td>
                                                        <td v-if="table_data.insert == false"class="text-danger"><span>Ｘ</span></td>
                                                        <td v-if="table_data.edit == true" class="text-success"><span>Ｏ</span></td>
                                                        <td v-if="table_data.edit == false"class="text-danger"><span>Ｘ</span></td>
                                                        <td v-if="table_data.delete == true" class="text-success"><span>Ｏ</span></td>
                                                        <td v-if="table_data.delete == false"class="text-danger"><span>Ｘ</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group" style="margin-top: 20px;">
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

        <div id="panel-form" class="content" style="display:none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <legend v-if="type==='update'">修改資料</legend>
                                <legend v-if="type==='create'">新增資料</legend>
                            </div>

                            <div class="content">

                                <form class="form-horizontal">

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">群組名稱</label>
                                            <div class="col-sm-9">
                                                <input :class="{'form-control': true, 'error': errors.has('name')}" type="text" name="name" placeholder="名稱" data-vv-as="名稱" v-model="row.name" v-validate="'required'" required >
                                                <span v-show="errors.has('name')" class="help-block"> @{{errors.first('name')}} </span>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">群組說明</label>
                                            <div class="col-sm-9">
                                                <input :class="{'form-control': true, 'error': errors.has('description')}" type="text" name="description" placeholder="說明" data-vv-as="說明" v-model="row.description" v-validate="'required'" required >
                                                <span v-show="errors.has('description')" class="help-block"> @{{errors.first('description')}} </span>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>

                                <div class="clearfix"></div>

                            </div>

                            <div class="header">
                                <legend v-if="type==='update'">修改權限</legend>
                                <legend v-if="type==='create'">新增權限</legend>
                            </div>

                            <div class="content">
                                <form class="form-horizontal">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">頂層</label>
                                            <div class="col-sm-9">
                                                <select id="edit_select" class="form-control menu-dropdown" v-on:change="select_change">
                                                    <option disabled="disabled" value="0" selected>請選擇父層</option>
                                                    <option v-for="parent in parents" :value="parent.id">@{{ parent.title }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">子層</label>
                                            <div class="col-sm-9">
                                                <table class="table role-table">
                                                    <thead>
                                                        <th data-width="200" data-field="child-menu">頁面名稱</th>
                                                        <th data-field="view">檢視</th>
                                                        <th data-field="create">新增</th>
                                                        <th data-field="update">修改</th>
                                                        <th data-field="delete">刪除</th>
                                                    </thead>
                                                    <tbody id="table-body">
                                                        <tr v-if="table_datas.length == 0" style="height:100px;">
                                                            <td colspan="5" style="text-align: center;">No matching records found</td>
                                                        </tr>
                                                        <tr v-if="table_datas.length!=0" v-for="table_data in table_datas">
                                                            <td>@{{ table_data.title }}</td>
                                                            <td class="text-success">
                                                                <span class="space"></span> <input v-model="table_data.view" class="role-checkbox" type="checkbox"/>
                                                            </td>
                                                            <td class="text-success">
                                                                <span class="space"></span> <input v-model="table_data.insert" class="role-checkbox" type="checkbox"/> 
                                                            </td>
                                                            <td class="text-success">
                                                                <span class="space"></span> <input v-model="table_data.edit" class="role-checkbox" type="checkbox"/>
                                                            </td>
                                                            <td class="text-danger">
                                                                <span class="space"></span> <input v-model="table_data.delete" class="role-checkbox" type="checkbox"/>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group" style="margin-top: 20px;">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-9">
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

    var __REST_API_URL__ = '{{$REST_API}}';

    var user_id = '{{Auth::user()->id}}';
    var menu_id = '{{ $menu_id }}';

    var roles = {};

    var toolBox = new Vue({
        el: '#toolbox',
        data: {
            roles: {}
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
            row: {},
            parents: {},
            table_datas: {}
        },
        methods: {
            done: function(e) {
                if (e) e.preventDefault();
                $('#panel-view').hide();
                $('#panel-list').show();
            },
            load: function(id) {
                var _this = this;

                $('#view_select').val(0);

                _this.row = {};
                _this.parents = {};
                _this.table_datas = {};

                Vue.http.get(__REST_API_URL__ + id).then(function(response) {
                    _this.row = response.body['role'];
                    _this.parents = response.body['parents'];

                });
            },
            select_change: function() {
                var _this = this;

                Vue.http.get(__REST_API_URL__ + _this.row.id + '/menu_detail/' + $('#view_select').val() ).then(function(response) {
                    _this.table_datas = response.body;
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
                'menu': {}
            },
            parents: {},
            table_datas: {},
            menu_id: 0
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

                _this.row['menu'][_this.menu_id] = _this.table_datas;
                
                this.$validator.validateAll().then(function() {

                    var cb_success = function(response) {
                        notifyAfterHttpSuccess(response.body);
                        if (response.body.result) {
                            _this.close();
                            adminMenu.fetch();
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
                _this.row['menu'] = {};
                _this.parents = {}; 
                _this.table_datas = {}; 
                _this.menu_id = 0;

                $('#edit_select').val(0);

                _this.errors.clear();

                Vue.http.get(__REST_API_URL__ + (id || 'new')).then(function(response) {
                    if (response.body['role']) {
                        _this.row = response.body['role'];
                        _this.row['menu'] = {};
                    }

                    // 資料要分兩層，一層table名，另一層資料內容
                    
                    _this.parents = response.body['parents'];                    
                    
                });
            },
            select_change: function() {
                var _this = this;

                if(_this.menu_id!=0) {
                    _this.row['menu'][_this.menu_id] = _this.table_datas;
                }

                if(_this.row['menu'][$('#edit_select').val()]==null || _this.row['menu'][$('#edit_select').val()]=="") {
                    Vue.http.get(__REST_API_URL__ + (_this.row.id || 'new') + '/menu_detail/' + $('#edit_select').val() ).then(function(response) {                  
                        _this.table_datas = response.body;
                    });
                } else {
                    _this.table_datas = _this.row['menu'][$('#edit_select').val()];
                }

                _this.menu_id = $('#edit_select').val();
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
        