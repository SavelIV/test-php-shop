/*Ajax query for add and delete products in cart*/
$(document).ready(function () {
    $(".add-to-cart").click(function () {
        var id = $(this).attr("data-id");
        $.post("/cart/addAjax/" + id, {}, function (data) {
            $("#cart-count").html(data);
            alert('Добавлено в корзину.');

        });
        return false;
    });
});

$(document).ready(function () {
    $(".delete-from-cart").click(function () {
        var id = $(this).attr("data-id");
        $.post("/cart/deleteAjax/" + id, {}, function (data) {
            $("#cart-count").html(data.items);
            if (data.items)
            {
                if (data.amount !== 0)
                {
                    $("td." + id).html(data.amount);
                } else {
                    $("tr." + id).remove();
                }
                $("#total").html(data.price);
            } else {
                $("table").remove();
            }
        }, "json");

        return false;
    });
});

