@extends('layouts.admin')

@section('title','退貨處理')

@section('content')

@php ($REST_API = '/api/admin/returnOrder/')

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
                                        <th data-field="created_at"  data-sortable="true" data-formatter="dateFormatter">退貨日期</th>
                                        <th data-field="customer_name" data-sortable="true">客戶名稱</th>
                                        <th data-field="total" data-sortable="true">總額</th>
                                        <th data-field="remark" data-visible="false" data-sortable="true">備註</th>
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
                                            <label class="col-sm-2 control-label">退貨日期</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.created_at}}</p>
                                            </div>
                                        </div>
                                    </fieldset>
                                    
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">客戶名稱</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.customer_name}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">總額</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">@{{row.total}}</p>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">備註</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" disabled="disabled" cols="30" rows="5">@{{row.remark}}
                                                </textarea>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">退貨內容</label>
                                            <div class="col-sm-6" style="border: 1px #cccccc solid; margin-left: 6px;">
                                                <table class="table">
                                                    <thead>
                                                        <th data-sortable="true">商品名稱</th>
                                                        <th data-sortable="true">定價</th>
                                                        <th data-sortable="true">數量</th>
                                                    </thead>
                                                    <tbody id="table-body">
                                                        <tr v-for="detail in row.details">
                                                            <td>@{{detail.name}}</td>
                                                            <td>@{{detail.price}}</td>
                                                            <td>@{{detail.num}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
                                <legend v-if="type==='update'">修改 退貨單</legend>
                                <legend v-if="type==='create'">新增 退貨單</legend>
                            </div>
                            <div class="content">
                                
                                <form method="POST" name="user_form" class="form-horizontal">
                                    {{ csrf_field() }}
                                
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">客戶名稱</label>
                                            <div class="col-sm-9">
                                                <select class="form-control menu-dropdown" v-model="row.customer_id" v-on:change="customer_select_change">
                                                    <option disabled="disabled" value="0" selected>請選擇客戶</option>
                                                    <option v-for="customer in customers" :value="customer.id">@{{ customer.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">購買紀錄</label>
                                            <div class="col-sm-9">
                                                <select class="form-control menu-dropdown" v-model="row.back_order_id" v-on:change="order_select_change">
                                                    <option disabled="disabled" value="0" selected>請選擇改買紀錄</option>
                                                    <option v-for="order in orders" :value="order.id">@{{ order.created_at }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">總額</label>
                                            <div class="col-sm-9">
                                                <input :class="{'form-control': true, 'error': errors.has('total') }" type="text" name="total" placeholder="請先選擇折扣，可自行修改總額" data-vv-as="總額" v-model="row.total" v-validate="'required|numeric'" required>
                                                <span v-show="errors.has('total')" class="help-block">@{{ errors.first('total') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">備註</label>
                                            <div class="col-sm-9">
                                                <textarea :class="{'form-control': true, 'error': errors.has('remark') }" name="remark" placeholder="備註" data-vv-as="備註" v-model="row.remark" cols="30" rows="10"></textarea>
                                                <span v-show="errors.has('remark')" class="help-block">@{{ errors.first('remark') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    
                                    

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">產品欄位</label>
                                            <div class="col-sm-9">

                                                <div id="input_apply_forms" style="padding:0;">
                                                    <template v-for="apply_form in apply_forms">
                                                        <div class="col-sm-2" style="padding-left:0;">
                                                            <select class="form-control menu-dropdown" v-model="value_types[apply_form]" v-on:change="type_select_change(apply_form)">
                                                                <option disabled="disabled" value="0" selected>請選擇產品類別</option>
                                                                <option v-for="type in types" :value="type.id">@{{ type.name }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select class="form-control menu-dropdown" v-model="value_products[apply_form]" v-on:change="product_select_change(value_products[apply_form],apply_form)">
                                                                <option disabled="disabled" value="0" selected>請選擇產品</option>
                                                                <option v-for="product in products[apply_form]" :value="product.id">@{{ product.name }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4"><input class="form-control" type="text" placeholder="可自行修正名稱" style="margin-bottom:10px;" :value="value_names[apply_form]" v-model="value_names[apply_form]"></div>
                                                        <div class="col-sm-2"><input class="form-control" type="text" placeholder="可自訂定價金額" style="margin-bottom:10px;" :value="value_prices[apply_form]" v-model="value_prices[apply_form]" v-on:change="count_total"></div>
                                                        <div class="col-sm-1" style="padding-right:0;"><input class="form-control" type="text" placeholder="數量" style="margin-bottom:10px;" :value="value_nums[apply_form]" v-model="value_nums[apply_form]" v-on:change="count_total"></div>
                                                    </template>
                                                </div> 
                                                

                                                <button id="input_apply_forms_btn" class="btn btn-default" type="button" style="float:right;margin-top:5px;" v-on:click="add">
                                                    <i class="glyphicon fa fa-plus"></i>
                                                    新增產品欄位
                                                </button>
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

    function discountFormatter (value, row, index) {
        if( value == -1 ) { return "無折扣"; }
        if( value == 0 ) { return "9折"; }
        if( value == 1 ) { return "8折"; }
        if( value == 2 ) { return "7折"; }
    }

    function dateFormatter (value, row, index) {
        return moment(value).format('YYYY-MM-DD');
    }

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

                    _this.row['created_at'] = moment(_this.row['created_at']).format('YYYY-MM-DD');

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
            customers:{},
            orders:{},
            types:{},
            products:[],
            apply_forms: [],
            value_types: {},
            value_products: {},
            value_names: {},
            value_prices: {},
            value_nums: {},
            value_inventorys: {}
        },
        methods: {
            close: function(e) {
                $('#panel-form').hide();
                $('#panel-list').show();
                this.reset();

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

                        if (_this.row.payment_method == -1 && _this.row.status==1) {
                            swal({
                                text: "請選擇付款方式",
                                type: 'info'
                            });
                        } else {
                            _this.row.form_datas = [];

                            var num = 0;
                            for (i=0; i<_this.apply_forms.length; i++) {
                                if ((_this.value_types[i]!="" && _this.value_types[i]!=null) && (_this.value_products[i]!="" && _this.value_products[i]!=null) && (_this.value_names[i]!="" && _this.value_names[i]!=null) && (_this.value_prices[i]!="" && _this.value_prices[i]!=null) && (_this.value_nums[i]!="" && _this.value_nums[i]!=null)) {
                                    _this.row.form_datas[num] = {
                                        type_id : _this.value_types[i],
                                        product_id : _this.value_products[i],
                                        name : _this.value_names[i],
                                        price : _this.value_prices[i],
                                        num : _this.value_nums[i]
                                    };

                                    num++;
                                }
                            }
                            
                            Vue.http.put(__REST_API_URL__ + _this.row.id, _this.row).then(cb_success, notifyAfterHttpError);
                        }
                        
                    }
                    else {
                        if (_this.row.payment_method == -1) {
                            swal({
                                text: "請選擇付款方式",
                                type: 'info'
                            });
                        } else {
                            Vue.http.options.emulateJSON = true;

                            _this.row.form_datas = [];

                            var num = 0;
                            for (i=0; i<_this.apply_forms.length; i++) {
                                if ((_this.value_types[i]!="" && _this.value_types[i]!=null) && (_this.value_products[i]!="" && _this.value_products[i]!=null) && (_this.value_names[i]!="" && _this.value_names[i]!=null) && (_this.value_prices[i]!="" && _this.value_prices[i]!=null) && (_this.value_nums[i]!="" && _this.value_nums[i]!=null)) {
                                    _this.row.form_datas[num] = {
                                        type_id : _this.value_types[i],
                                        product_id : _this.value_products[i],
                                        name : _this.value_names[i],
                                        price : _this.value_prices[i],
                                        num : _this.value_nums[i]
                                    };

                                    num++;
                                }
                            }

                            Vue.http.post(__REST_API_URL__, _this.row).then(cb_success, notifyAfterHttpError);
                            Vue.http.options.emulateJSON = false; 
                        }
                                             
                    }

                }).catch(function() {
                    $('.form-control.error').first().focus();
                });
            },
            cancel: function(e) {
                if (e) e.preventDefault();
                this.reset();
                this.close();
            },
            reset: function () {
                var _this = this;

                _this.types = {};
                _this.products = {};
                _this.apply_forms = [];
                _this.value_types = {};
                _this.value_products = {};
                _this.value_names = {};
                _this.value_prices = {};
                _this.value_nums = {};

                _this.types = JSON.parse(JSON.stringify(_this.types));
                _this.products = JSON.parse(JSON.stringify(_this.products));
                _this.apply_forms = JSON.parse(JSON.stringify(_this.apply_forms));
                _this.value_types = JSON.parse(JSON.stringify(_this.value_types));
                _this.value_products = JSON.parse(JSON.stringify(_this.value_products));
                _this.value_names = JSON.parse(JSON.stringify(_this.value_names));
                _this.value_prices = JSON.parse(JSON.stringify(_this.value_prices));
                _this.value_nums = JSON.parse(JSON.stringify(_this.value_nums));
            },
            load: function(id) {
                var _this = this;
                _this.type = id?'update':'create';

                _this.row = {};
                _this.errors.clear();

                // $('#payment').hide();

                Vue.http.get('/api/admin/customer').then(function(response) {
                    _this.customers = response.body;
                    _this.customers = JSON.parse(JSON.stringify(_this.customers));
                    
                    Vue.http.get(__REST_API_URL__ + (id || 'new')).then(function(response) {
                        _this.row = response.body;
                        _this.row = JSON.parse(JSON.stringify(_this.row));

                        total = _this.row['total'];

                        if (!id) {
                            _this.row['customer_id'] = 0;
                            _this.row['order_id'] = 0;

                            _this.apply_forms[_this.apply_forms.length] = _this.apply_forms.length;
                            _this.apply_forms = JSON.parse(JSON.stringify(_this.apply_forms));

                            _this.value_types[_this.apply_forms.length-1] = '';
                            _this.value_products[_this.apply_forms.length-1] = '';
                            _this.value_names[_this.apply_forms.length-1] = '';
                            _this.value_prices[_this.apply_forms.length-1] = '';
                            _this.value_nums[_this.apply_forms.length-1] = '';

                                
                            _this.value_types = JSON.parse(JSON.stringify(_this.value_types));
                            _this.value_products = JSON.parse(JSON.stringify(_this.value_products));
                            _this.value_names = JSON.parse(JSON.stringify(_this.value_names));
                            _this.value_prices = JSON.parse(JSON.stringify(_this.value_prices));
                            _this.value_nums = JSON.parse(JSON.stringify(_this.value_nums));

                            swal({
                                title:"使用須知",
                                text:"請先選擇客戶，在選擇購買紀錄",
                                type:"info"
                            }).then( function () {
                                swal({
                                    title:"使用須知",
                                    text:"購物紀錄的資料會顯示於下方，自行修改即可",
                                    type:"info"
                                });
                            });
            
                        } else {
                            
                            _this.customer_select_change();

                            // _this.orders = response.body['back'];
                            // 帶入資料
                            for (i=0; i<response.body['details'].length; i++) {
                                _this.apply_forms[i] = i;
                                _this.apply_forms = JSON.parse(JSON.stringify(_this.apply_forms));


                                _this.value_types[i] = response.body['details'][i]['type_id'];
                                _this.value_types = JSON.parse(JSON.stringify(_this.value_types));
                                // _this.type_select_change(i);

                                _this.value_products[i] = response.body['details'][i]['product_id'];
                                _this.value_products = JSON.parse(JSON.stringify(_this.value_products));

                                _this.value_names[i] = response.body['details'][i]['name'];
                                _this.value_names = JSON.parse(JSON.stringify(_this.value_names));

                                _this.value_prices[i] = response.body['details'][i]['price'];
                                _this.value_prices = JSON.parse(JSON.stringify(_this.value_prices));
                                    
                                _this.value_nums[i] = response.body['details'][i]['num'];
                                _this.value_nums = JSON.parse(JSON.stringify(_this.value_nums));

                            }
                        }

                        Vue.nextTick(function () {
                            _this.row.total = total;
                        });
                    });
                });

                
            },
            add: function() {
                _this = this;

                
                _this.apply_forms[_this.apply_forms.length] = _this.apply_forms.length;
                _this.apply_forms = JSON.parse(JSON.stringify(_this.apply_forms));

                _this.value_types[_this.apply_forms.length-1] = '';
                _this.value_products[_this.apply_forms.length-1] = '';
                _this.value_names[_this.apply_forms.length-1] = '';
                _this.value_prices[_this.apply_forms.length-1] = '';
                _this.value_nums[_this.apply_forms.length-1] = '';

                _this.value_types = JSON.parse(JSON.stringify(_this.value_types));
                _this.value_products = JSON.parse(JSON.stringify(_this.value_products));
                _this.value_names = JSON.parse(JSON.stringify(_this.value_names));
                _this.value_prices = JSON.parse(JSON.stringify(_this.value_prices));
                _this.value_nums = JSON.parse(JSON.stringify(_this.value_nums));
            },
            customer_select_change: function () {
                _this = this;

                back_order_id = _this.row.back_order_id;

                Vue.http.get(__REST_API_URL__ + _this.row.customer_id + '/orders').then(function(response) {
                    _this.orders = response.body;
                    _this.orders = JSON.parse(JSON.stringify(_this.orders));

                    Vue.nextTick(function () {
                        _this.row.back_order_id = back_order_id;
                        _this.row = JSON.parse(JSON.stringify(_this.row));                        
                    });                    
                });
            },
            order_select_change: function () {
                _this = this;


                Vue.http.get(__REST_API_URL__+_this.row.order_id+'/products').then(function(response) {
                    // _this.orders = response.body;
                });
            },
            type_select_change: function(form_num) {
                _this = this;

                _this.value_names[form_num] = '';
                _this.value_prices[form_num] = '';
                _this.value_nums[form_num] = '';
                
                Vue.http.get(__REST_API_URL__ + _this.value_types[form_num] + '/product').then(function(response) {
                    _this.products[form_num] = response.body;
                    _this.products = JSON.parse(JSON.stringify(_this.products));
                });
            },
            product_select_change: function(product_id,form_num) {
                _this = this;

                _this.value_nums[form_num] = '';
                
                Vue.http.get(__REST_API_URL__ + product_id + '/data').then(function(response) {
                    _this.value_names[form_num] = response.body['name'];
                    _this.value_prices[form_num] = response.body['cost'];
                    _this.value_inventorys[form_num] = response.body['inventory'] - response.body['order_amount'];

                    _this.value_names = JSON.parse(JSON.stringify(_this.value_names));
                    _this.value_prices = JSON.parse(JSON.stringify(_this.value_prices));
                    _this.value_inventorys = JSON.parse(JSON.stringify(_this.value_inventorys));
                });
            },
            count_total: function () {
                _this = this;
                
                var total = 0;

                for (i=0; i<_this.apply_forms.length; i++) {
                    if ((_this.value_prices[i]!="" || _this.value_prices[i]!=null) && (_this.value_nums[i]!="" || _this.value_nums[i]!=null)){
                        // 判斷是否超過庫存量
                        if (_this.value_nums[i] > _this.value_inventorys[i]) {
                            swal({
                                title: "數量錯誤",
                                text: "產品庫存不足，庫存為"+_this.value_inventorys[i],
                                type: "info",
                            });

                            _this.value_nums[i] = _this.value_inventorys[i];
                            _this.value_nums = JSON.parse(JSON.stringify(_this.value_nums));
                        } 
                        
                        
                        total += _this.value_prices[i] * _this.value_nums[i];
                    } else {
                        total = 0;
                        break;
                    }
                }

                if (total != 0) {
                    if (_this.row.discount == 0) {
                        total *= 0.9;
                    } else if (_this.row.discount == 1) {
                        total *= 0.8;
                    } else if (_this.row.discount == 2) {
                        total *= 0.7;
                    }

                    _this.row.total = Math.ceil(total);
                    _this.row = JSON.parse(JSON.stringify(_this.row));
                }
                
            },
            status_change: function () {
                _this = this;

                _this.row = JSON.parse(JSON.stringify(_this.row));

                if (_this.row.status==1) {
                    $('#payment').show();
                } else {
                    _this.row.payment_method = -1;
                    $('#payment').hide();
                }
                
                
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
        