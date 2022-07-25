$(function() {
    var table = $('#order').DataTable({
        processing: true,
        serverSide: true,
        bDestroy: true,
        scrollX: true,
        ajax: {
            url: datatbleurl,
            data: function (d) {
                d.status = $('#orderstatus').val(),
                //d.name = $('input[name="name"]').val(),
                d.date = $('input[name="date"]').val()
            }
        },
        columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
            {
                data: 'invoice_no',
                name: 'invoice_no'
            },
            {
                data: 'billing_name',
                name: 'billing_name'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'order_total',
                name: 'order_total'
            },
            {
                data: 'payment_method',
                name: 'payment_method'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'actions',
                name: 'actions'
            },
        ]
    });

    $('#orderstatus').change(function(){
        table.draw();
    });
    /*$("input[name='name']").on('keyup',function(){
        table.draw();
    });*/
    $("input[type='date']").change(function(){
        table.draw();
    });
});
