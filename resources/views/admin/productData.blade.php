@extends('layouts.admin')

@section('title','廠商資料')

@section('content')

@php ($REST_API = '/api/admin/productData/')

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
                                        <th data-field="type_name"  data-sortable="true">類別</th>
                                        <th data-field="name"  data-sortable="true">名稱</th>
                                        <th data-field="price" data-sortable="true">定價</th>
                                        <th data-field="inventory" data-sortable="true">庫存量</th>
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
                                            <label class="col-sm-2 control-label">商品類別</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.type_name}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">商品名稱</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.name}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">定價</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.price}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">庫存量</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.inventory}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">總訂貨量</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.total_amount}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">總成交量</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.sales_amount}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">圖片</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">
                                                    @{{row.photo}}<br/>
                                                    <img v-if="row.photo" :src="row.photo" class="img-responsive img-thumbnail" style="height:300px" />
                                                </p>
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
                                <legend v-if="type==='update'">修改 商品</legend>
                                <legend v-if="type==='create'">新增 商品</legend>
                            </div>
                            <div class="content">
                                
                                <form method="POST" name="user_form" class="form-horizontal">
                                    {{ csrf_field() }}
                                
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">商品類別</label>
                                            <div class="col-sm-10">
                                                <select class="form-control menu-dropdown" v-model="row.type_id">
                                                    <option disabled="disabled" value="0" selected>請選擇商品類別</option>
                                                    <option v-for="type in types" :value="type.id">@{{ type.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">商品名稱</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('name') }" type="text" name="name" placeholder="商品名稱" data-vv-as="商品名稱" v-model="row.name" v-validate="'required'" required>
                                                <span v-show="errors.has('name')" class="help-block">@{{ errors.first('name') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">定價</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('price') }" type="text" name="price" placeholder="定價" data-vv-as="定價" v-model="row.price" v-validate="'required|numeric'" required>
                                                <span v-show="errors.has('price')" class="help-block">@{{ errors.first('price') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">庫存量</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('inventory') }" type="text" name="inventory" placeholder="庫存量" data-vv-as="庫存量" v-model="row.inventory" v-validate="'required|numeric'" required>                                                
                                                <span v-show="errors.has('inventory')" class="help-block">@{{ errors.first('inventory') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">訂貨量</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('total_amount') }" type="text" name="total_amount" placeholder="訂貨量" data-vv-as="訂貨量" v-model="row.total_amount" v-validate="'required|numeric'" required>
                                                <span v-show="errors.has('total_amount')" class="help-block">@{{ errors.first('total_amount') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">成交量</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('sales_amount') }" type="text" name="sales_amount" placeholder="成交量" data-vv-as="成交量" v-model="row.sales_amount" v-validate="'required|numeric'" required>                                                                                                
                                                <span v-show="errors.has('sales_amount')" class="help-block">@{{ errors.first('sales_amount') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">圖片</label>
                                            <div class="col-sm-10">
                                                <span class="btn btn-default fileinput-button">
                                                    <span>
                                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                                        標準
                                                    </span>
                                                    <input class="fileupload" type="file" id="photo" name="photo" accept="image/*"> 
                                                </span>
                                                <br/>
                                                <span>@{{ row.photo }}</span>
                                                <br/>
                                                <br/>
                                                <img v-if="row.photo" :src="row.photo" class="img-responsive img-thumbnail" style="height:300px" />
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
                _token: csrf_token
            },
            types:{}
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

                if (_this.row.type_id == 0) {
                    swal({
                        text:"請選擇商品分類",
                        type:"info"
                    });
                } else {
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
                }
                
                
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

                var setupFileupload = function() {
                    $('#photo').fileupload({
                        url: __REST_API_URL__ + 'upload',
                        formData: {
                            input_file_sign: 'photo',
                            input_folder: _this.input_folder
                        },
                        dataType: 'json',
                        done: function (e, data) {
                            _this.afterUpload(data.result.path,'photo');
                            notifyAfterHttpSuccess(data.result);
                        }
                    });
                };

                Vue.http.get('/api/admin/productType').then(function(response) {
                    _this.types = response.body;
                    _this.types = JSON.parse(JSON.stringify(_this.types));

                    Vue.http.get(__REST_API_URL__ + (id || 'new')).then(function(response) {
                        _this.row = response.body;

                        if (!id) {
                            _this.row['type_id'] = 0;
                        }
                    });
                });

                setupFileupload();
                
            },
            afterUpload: function(photo,path) {
                var _this = this;
                _this.row[path] = photo;

                _this.row = JSON.parse(JSON.stringify(_this.row));
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
        