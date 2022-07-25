function addtocart(productId,qty){
    var cartval = 0;
    if(qty == 'add' ){
        qty = ++cartval;
    }else if(qty == 'sub'){
        qty = --cartval;
    }
    $.ajax({
        data: {
            product_id : productId,
            qty : qty,
            _method:'POST'
        },
        type: "POST",
        dataType: 'json',
        url: config.routes.addtocart,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend:function (){
            $(this).parent('li').append('<i class="fa fa-spinner" aria-hidden="true"></i>');
        },
        complete:function (){
            $(this).parent('li').remove('<i class="fa fa-spinner" aria-hidden="true"></i>');
        },
        success: function( data ) {
            console.log(data)
            if(data['success']){
                alertify.set('notifier','position', 'top-right');
                alertify.success("Product Added successfully");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            }
            if (data['redirect']) {
                location = data['redirect'];
            }
        },
        error: function( data ) {
            alertify.set('notifier','position', 'top-right');
            alertify.error("Please Login");
        }
    });
}

function addtowishlist(productId){
    $.ajax({
        data: {
            product_id : productId,
            _method:'POST'
        },
        type: "POST",
        url: config.routes.addtowishlist,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function( data ) {
            console.log(data)
            if(data['success']){
                alertify.set('notifier','position', 'top-right');
                alertify.success(data['success']);
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            }
            if (data['error']) {
                alertify.set('notifier','position', 'top-right');
                alertify.error("Please Login");
                return false;
            }
        },
        error: function( data ) {
            alertify.set('notifier','position', 'top-right');
            alertify.error("Please Login");
        }
    });
}

function updateCart(id, qty){
    if(id != "" && qty != ""){
        $.ajax({
           url: config.routes.updatecart,
           method: "patch",
           dataType: 'json',
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           data: {id: id, quantity: qty},
           success: function (response) {
                console.log(response)
                if(response['success']){
                    alertify.set('notifier','position', 'top-right');
                    alertify.success("Cart Updated Successfully");
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
           }
        });
    }
}

$(document).ready(function(){
    /*$(".update-cart").click(function (e) {
       e.preventDefault();
       var ele = $(this);
        $.ajax({
           url: config.routes.updatecart,
           method: "patch",
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           data: {id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
           success: function (response) {
                alertify.success("Cart Updated Successfully");
                window.location.reload();
           }
        });
    });*/

    $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure want to remove this item?")) {
                $.ajax({
                    url: config.routes.removefromcart,
                    method: "DELETE",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {id: ele.attr("data-id")},
                    success: function (response) {
                        alertify.set('notifier','position', 'top-right');
                        alertify.success("Item removed from cart successfully");
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        });
    $(".remove-from-wishlist").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm("Are you sure want to remove this item?")) {
            $.ajax({
                url: config.routes.removefromwishlist,
                method: "DELETE",
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {id: ele.attr("data-id")},
                success: function (response) {
                    console.log(response)
                    if(response['success']){
                        alertify.set('notifier','position', 'top-right');
                        alertify.success("Product removed from wishlist successfully");
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    }
                    if (response['error']) {
                        alertify.set('notifier','position', 'top-right');
                        alertify.error(response['error']);
                    }
                }
            });
        }
    });
});

$('.searchSec input[name=\'search\']').on('keydown', function(e) {
    if (e.keyCode == 13) {
        var q = $(this).val();
        if(q){
            location = config.routes.search+"?q="+q;
        }
    }
});
