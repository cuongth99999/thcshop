
$(document).ready(function () {
    $(".num-order").change(function () {
        var id = $(this).attr('data-id');
        var qty = $(this).val();
        var data = {id: id, qty: qty};

       $.ajax({
           url: '?mod=cart&act=update_ajax',
           method: 'POST',
           data: data,
           dataType: 'json',
           success: function (data) {
               // Xử lý dữ liệu trả về
               $("#sub-total-"+id).text(data.sub_total);
               $("#total-price span").text(data.total);
               $("#num").text(data.num);
               // console.log(data);
           },
           error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
           },
       });
    });
});