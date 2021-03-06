define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'engineer_list/index' + location.search,
                    add_url: 'engineer_list/add',
                    edit_url: 'engineer_list/edit',
                    del_url: 'engineer_list/del',
                    multi_url: 'engineer_list/multi',
                    table: 'engineer_list',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'name', title: __('Name')},
                        {field: 'score', title: __('Score')},
                        {field: 'sort', title: __('Sort')},
                        {field: 'avater_image', title: __('Avater_image'), events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'order_num', title: __('Order_num')},
                        {field: 'create_time', title: __('Create_time')},
                        {field: 'status', title: __('Status'), searchList: {"normal":__('Normal'),"finish":__('Finish'),"fail":__('Fail')}, formatter: Table.api.formatter.status},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});