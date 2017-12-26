@extends('layouts.admin')

@section('title','帳號管理')

@section('content')

@php ($REST_API = '/api/admin/company/')

        <div class="content" id="panel-form">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <legend>修改公司資料</legend>
                            </div>
                            <div class="content">
                                
                                <form method="POST" name="user_form" class="form-horizontal">
                                    {{ csrf_field() }}
                                
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">公司名稱</label>
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
                                            <label class="col-sm-2 control-label">公司信箱</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('email') }" type="text" name="email" placeholder="公司信箱" data-vv-as="公司信箱" v-model="row.email" v-validate="'required|email'" required>
                                                <span v-show="errors.has('email')" class="help-block">@{{ errors.first('email') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">公司網站</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('website') }" type="text" name="website" placeholder="公司網站" data-vv-as="公司網站" v-model="row.website">
                                                <span v-show="errors.has('website')" class="help-block">@{{ errors.first('website') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">傳真號碼</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('fax') }" type="text" name="fax" placeholder="傳真號碼" data-vv-as="傳真號碼" v-model="row.fax" v-validate="'required|numeric'">
                                                <span v-show="errors.has('fax')" class="help-block">@{{ errors.first('fax') }}</span>
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
                                            <label class="col-sm-2 control-label">公司地址</label>
                                            <div class="col-sm-10">
                                                <input :class="{'form-control': true, 'error': errors.has('address') }" type="text" name="address" placeholder="公司地址" data-vv-as="公司地址" v-model="row.address" v-validate="'required'">
                                                <span v-show="errors.has('address')" class="help-block">@{{ errors.first('address') }}</span>
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

    var panelForm = new Vue({
        el: '#panel-form',
        data: {
            roles:{},
            row: {
                _token: csrf_token,
            }
        },
        mounted: function(){
            _this = this;
            
            Vue.http.get('/api/admin/user/'  + user_id + '/roles/' +  menu_id).then(function(response) {
                _this.roles = response.body;
            });

            _this.load();
        },
        methods: {
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

                    Vue.http.put(__REST_API_URL__, _this.row).then(cb_success, notifyAfterHttpError);

                }).catch(function() {
                    $('.form-control.error').first().focus();
                });
            },
            cancel: function(e) {
                if (e) e.preventDefault();
                this.load();
            },
            load: function() {
                var _this = this;

                _this.row = {};
                _this.errors.clear();

                Vue.http.get(__REST_API_URL__).then(function(response) {
                    _this.row = response.body;
                });
            }
        }
    });


</script>
@stop
        