function selected() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var producto = $("#ID_Producto").val();
    $.ajax({
        url: '/valoresCalculo',
        type: 'GET',
        dataType: 'json',
        data: {
            'producto': producto
        },
        success: function (response) {
            alert(response.msg);
        }
    });
}
$(document).ready(function () {});
