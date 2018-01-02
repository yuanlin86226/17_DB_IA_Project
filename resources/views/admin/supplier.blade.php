@extends('layouts.admin')

@section('title','廠商資料')

@section('content')

@php ($REST_API = '/api/admin/supplier/')

        <div class="content" id="panel-list">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content table-responsive table-full-width">
                                <div class="toolbar">
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
                                        <th data-field="state" data-width="50" data-checkbox="true"></th>
                                        <th data-field="name"  data-sortable="true">廠商名稱</th>
                                        <th data-field="tax" data-visible="false" data-sortable="true">統一編號</th>
                                        <th data-field="telephone" data-sortable="true">電話號碼</th>
                                        <th data-field="fax" data-visible="false" data-sortable="true">傳真</th>
                                        <th data-field="email" data-sortable="true">Email</th>
                                        <th data-field="address" data-visible="false" data-sortable="true">地址</th>
                                        <th data-field="website" data-visible="false" data-sortable="true">網站</th>
                                        <th data-field="ceo" data-sortable="true">聯絡人</th>
                                        <th data-field="created_at" data-visible="false" data-sortable="true">建立時間</th>
                                        <th data-field="updated_at" data-visible="false" data-sortable="true">更新時間</th>
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

        <div class="content" id="panel-view" style="display:none">
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
                                            <label class="col-sm-2 control-label">廠商名稱</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.name}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">統一編號</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.tax}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">電話號碼</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.telephone}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">傳真</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.fax}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.email}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">地址</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.address}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">網站</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.website}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">聯絡人</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.ceo}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">建立時間</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.created_at}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">更新時間</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.updated_at}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group" style="margin-top: 20px;">
                                            <div class="col-sm-2">
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
                                <legend v-if="type==='update'">修改 廠商</legend>
                                <legend v-if="type==='create'">新增 廠商</legend>
                            </div>
                            <div class="content">
                                
                                <form method="POST" name="user_form" class="form-horizontal">
                                    {{ csrf_field() }}
                                
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">廠商名稱</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('name') }" type="text" name="name" placeholder="公司名稱" data-vv-as="公司名稱" v-model="row.name" v-validate="'required'" required>
                                                <span v-show="errors.has('name')" class="help-block">@{{ errors.first('name') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">統一編號</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('tax') }" type="text" name="tax" placeholder="統一編號" data-vv-as="統一編號" v-model="row.tax" v-validate="'required|numeric|digits:8'" required>
                                                <span v-show="errors.has('tax')" class="help-block">@{{ errors.first('tax') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">電話號碼</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('telephone') }" type="text" name="telephone" placeholder="電話號碼" data-vv-as="電話號碼" v-model="row.telephone" v-validate="'required|numeric'">
                                                <span v-show="errors.has('telephone')" class="help-block">@{{ errors.first('telephone') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">傳真</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('fax') }" type="text" name="fax" placeholder="傳真號碼" data-vv-as="傳真號碼" v-model="row.fax" v-validate="'required|numeric'">
                                                <span v-show="errors.has('fax')" class="help-block">@{{ errors.first('fax') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('email') }" type="text" name="email" placeholder="公司信箱" data-vv-as="公司信箱" v-model="row.email" v-validate="'required|email'" required>
                                                <span v-show="errors.has('email')" class="help-block">@{{ errors.first('email') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">地址</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('address') }" type="text" name="address" placeholder="公司地址" data-vv-as="公司地址" v-model="row.address" v-validate="'required'">
                                                <span v-show="errors.has('address')" class="help-block">@{{ errors.first('address') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">網站</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('website') }" type="text" name="website" placeholder="公司網站" data-vv-as="公司網站" v-model="row.website" v-validate="'required'">
                                                <span v-show="errors.has('website')" class="help-block">@{{ errors.first('website') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">聯絡人</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('ceo') }" type="text" name="ceo" placeholder="聯絡人" data-vv-as="聯絡人" v-model="row.ceo" v-validate="'required'">
                                                <span v-show="errors.has('ceo')" class="help-block">@{{ errors.first('ceo') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-10">
                                                <button v-if="roles.edit" type="submit" class="btn btn-fill btn-info" v-on:click="save">更新</button>
                                                <button v-if="roles.edit" type="submit" class="btn btn-default" v-on:click="cancel">取消</button>
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

    var panelList = new Vue({
        el: '#panel-list',
        data: {
            roles:{}
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
                        swal({
                            title:"刪除無法復原，確定要刪除？",
                            text:"相關資料有可能損毀或一併消失",
                            type:"warning",
                            showCancelButton: true
                        }).then( function (isConfire) {
                            if (isConfirm) {
                                Vue.http.delete(__REST_API_URL__, {body: ids}).then(function(response) {
                                    notifyAfterHttpSuccess(response.body);
                                    $table.bootstrapTable('refresh');
                                }, function() {
                                    notifyAfterHttpError();
                                });
                            }
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
                    swal({
                        title:"刪除無法復原，確定要刪除？",
                        text:"相關資料有可能損毀或一併消失",
                        type:"warning",
                        showCancelButton: true
                    }).then( function (isConfire) {
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
        