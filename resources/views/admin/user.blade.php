@extends('layouts.admin')

@section('title','帳號管理')

@section('content')

@php ($REST_API = '/api/admin/user/')

        <div class="content" id="panel-list">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content table-responsive table-full-width">
                                <div class="toolbar">
                                    <button v-if="roles.insert" id="btn-create" class="btn btn-default" type="button" title="新增一位人員">
                                        <i class="glyphicon fa fa-plus"></i>
                                        新增
                                    </button>
                                    &nbsp;
                                    <button v-if="roles.delete" id="btn-remove" class="btn btn-default" type="button" title="刪除人員">
                                        <i class="glyphicon fa fa-remove"></i>
                                        刪除
                                    </button>
                                    &nbsp;
                                </div>
                                
                                <table id="bootstrap-table" class="table" data-toggle="table" data-url="{{$REST_API}}" data-click-to-select="ture">
                                    <thead>
                                        <th data-field="state" data-width="50" data-checkbox="true"></th>
                                        <th data-field="id" data-width="50" data-visible="false" class="text-center">ID</th>
                                        <th data-field="userName" data-sortable="true">帳號名稱</th>
                                        <th data-field="name" data-visible="true"  data-sortable="true">姓名</th>
                                        <th data-field="email" data-sortable="true">Email</th>
                                        <th data-field="phoneNumber" data-visible="false" data-sortable="true">手機號碼</th>
                                        <th data-field="lastLoginAt" data-visible="false">最後登入時間</th>
                                        <th data-field="created_at" data-visible="false" data-sortable="true">建立時間</th>
                                        <th data-field="updated_at" data-visible="true" data-sortable="true">更新時間</th>
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
            
            Vue.http.get(__REST_API_URL__  + user_id + '/roles/' +  menu_id).then(function(response) {
                console.log(response.body);
                _this.roles = response.body;
                roles = response.body;
            });
        },
        methods: {
            load: function(id){
                _this = this;

                REDENVELOPE_ID = id;
                _this.redenvelope_time = REDENVELOPE_TIME;

                $table.bootstrapTable('refresh', {
                    url: __REST_API_URL__  + $user_id + '/roles/' +  $menu_id
                });
            },
            close: function() {
                _this = this;

                $('#panel-red-envelope-list').show();
                $('#panel-list').hide();
                $('#panel-form').hide();

                $table2.bootstrapTable('refresh');
            }
        }
    });

    $('#btn-create').click(function(e) {
        $('#panel-list').hide();
        $('#panel-form').show();
        panelForm.load();
    });

    $('#btn-remove').click(function(e) {
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
        }, function(isConfirm) {
            if (isConfirm) {
                Vue.http.delete(__REST_API_URL__, {body: ids}).then(function(response) {
                    console.log(ids);
                    notifyAfterHttpSuccess(response.body);
                    $table.bootstrapTable('refresh');
                }, function() {
                    notifyAfterHttpError();
                });
            }
        });
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
            }, function(isConfirm) {
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
        