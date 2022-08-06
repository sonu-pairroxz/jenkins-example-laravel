$(function() {
    var table = $('#queries').DataTable({
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
                data: 'title',
                name: 'title'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'asin',
                name: 'asin'
            },
            {
                data: 'work_stream',
                name: 'work_stream'
            },
            {
                data: 'marketplace',
                name: 'marketplace'
            },
            {
                data: 'tariff_node',
                name: 'tariff_node'
            },
            {
                data: 'manager_id',
                name: 'manager_id'
            },
            {
                data: 'ruling_referred',
                name: 'ruling_referred'
            },
            {
                data: 'external_links',
                name: 'external_links'
            },
            {
                data: 'document_referred',
                name: 'document_referred'
            },
            {
                data: 'no_of_nfa_parked',
                name: 'no_of_nfa_parked'
            },
            {
                data: 'itk',
                name: 'itk'
            },
            {
                data: 'requester_comment',
                name: 'requester_comment'
            },
            {
                data: 'resolver_comment',
                name: 'resolver_comment'
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
