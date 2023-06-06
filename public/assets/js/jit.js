$(function() {
    var table = $('#jit-learnings').DataTable({
        processing: true,
        serverSide: true,
        bDestroy: true,
        scrollX: true,
        ajax: {
            url: datatbleurl,
            data: function (d) {
                  d.search = $('input[type="search"]').val()
              }
          },
        columns: [{
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'ticket_id',
                name: 'ticket_id'
            },
            {
                data: 'asin',
                name: 'asin'
            },
            {
                data: 'product_name',
                name: 'product_name'
            },
            {
                data: 'error_type',
                name: 'error_type'
            },
            {
                data: 'sim',
                name: 'sim'
            },
            {
                data: 'node',
                name: 'node'
            },
            {
                data: 'marketplace',
                name: 'marketplace'
            },
            {
                data: 'correct_code',
                name: 'correct_code'
            },
            {
                data: 'incorrect_code',
                name: 'incorrect_code'
            },
            {
                data: 'actions',
                name: 'actions'
            }
        ]
    });

    $(".search").keyup(function(){
        table.draw();
    });
});
