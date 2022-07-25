$(function() {
    var table = $('#banner').DataTable({
        processing: true,
        serverSide: true,
        bDestroy: true,
        scrollX: true,
        ajax: datatbleurl,
        columns: [{
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'banner_type',
                name: 'banner_type'
            },
            {
                data: 'link_type',
                name: 'link_type'
            },
            {
                data: 'link_url_type',
                name: 'link_url_type'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'actions',
                name: 'actions'
            },
        ]
    });
});