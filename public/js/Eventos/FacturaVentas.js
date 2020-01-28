$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('#ID_Producto').change(function () {
    var producto = $.getElementeByName("#ID_Producto").val();
    $.ajax({
        url: 'ValoresCalculo',
        type: 'GET',
        data: {
            'producto': "producto"
        },
        success: function (response) {
            alert(response);
        }
    });
});



// $(document).ready(function () {

// });
