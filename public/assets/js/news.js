$(function() {
    var table = $('#news').DataTable({
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
                data: 'marketplace',
                name: 'marketplace'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'date_of_publish',
                name: 'date_of_publish'
            },
            {
                data: 'date_of_change_applied',
                name: 'date_of_change_applied'
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
