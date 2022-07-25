<footer>
</footer>
<a href="javascript:" id="return-to-top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
@push('scripts')
<script type="text/javascript">
    $(document).on('click', '#quickviewbtn', function(event) {
        event.preventDefault();
        var href = $(this).attr('data-attr');
        console.log(href);
        $.ajax({
            url: href,
            beforeSend: function() {
                $(this).html("Loading...");
            },
            // return the result
            success: function(result) {
                console.log(result);
                $('#quickviewmodal').modal("show");
                $('#quickviewbody').html(result).show();
            },
            complete: function() {
                $(this).html("");
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $(this).html("");
            },
            timeout: 8000
        })
    });
</script>
@endpush


