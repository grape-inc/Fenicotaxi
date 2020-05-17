$(document).ready(function () {
    $('#Agregar').click(function () {
        agregar();
        EvaluarTotales();
    });

    $('#Descuento').change(function(){
        EvaluarTotales();
    });

    $('#ID_Producto').change(function(event){
        ActualizarPrecio();
    });

    $('#ActualizarDatos').click(function(event){
        $.ajax({
         url: "../../../info_factura",
         type: "get"
        })
        .done(function(datos) {
            $('#ID_Cliente').html("");
            $('#ID_Empleado').html("");

            $.each(datos.Clientes, function(indice, opcion) {
                $('#ID_Cliente').append($('<option/>').attr("value", opcion.ID_Cliente).text(opcion.Nombre_Cliente + " "+ opcion.Apellido_Cliente));
            });
            $.each(datos.Empleados, function(indice, opcion) {
                $('#ID_Empleado').append($('<option/>').attr("value", opcion.ID_Empleado).text(opcion.Nombre_Empleado + " "+ opcion.Apellido_Empleado));
            });
            $('#ID_Cliente').trigger('change');
            $('#ID_Empleado').trigger('change');
            $('.selectpicker').selectpicker('refresh');
        });
    });
});

var cont = 0;
total = 0;
subtotal = [];

function agregar() {
    if($('#ID_Producto').val() != "") {
        ID_Producto = $("#ID_Producto").val();
        producto = $("#ID_Producto option:selected").text();
        Cantidad = $("#Cantidad").val();
        Impuesto = $("#Impuesto").val();
        Precio = $("#Precio").val();
        Total = $("Total");
        Descripcion = "";

        if (ID_Producto != "" && Cantidad != "" && Cantidad > 0 && Precio != "") {
            subtotal[cont] = (Cantidad * Precio);
            total = total + subtotal[cont];
                var Fila = '<tr id="Fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="ID_Producto[]" value="' + ID_Producto + '">' + producto + '</td><td><input style="width: 100px;" type="number" name="Cantidad[]" onchange="EvaluarTotales()" class="Cantidad" value="' + Cantidad + '" readonly ></td><td><input type="number" style="width: 140px;" name="Precio[]" onchange="EvaluarTotales()" value="' + Precio + '" readonly></td><td><input type="text" name="Descripcion[]" value="' + Descripcion + '"></td><td>' + subtotal[cont] + '</td></tr>';
            cont++;
            limpiar();
            evaluar();
            $('#TablaDetalle').append(Fila);
            EvaluarTotales();
            $('#ID_Producto').val("").trigger("change")

        } else {
            alert("Error al ingresar el detalle de la factura, revise los datos del articulo")
        }
        EvaluarTotales();
    }
}

function limpiar() {
    $("#Cantidad").val("");
    $("#Precio").val("");
}

function evaluar() {
    $("#Total").val(total);
}

function eliminar(index) {
    total = total - subtotal[index];
    $("#total").html("S/. " + total);
    $("#Fila" + index).remove();
    evaluar();
    EvaluarTotales();
}

function EvaluarTotales() {
    var Suma = 0;
    $('#TablaDetalle > tbody > tr').each(function(Index, Fila ) {
        PrecioProducto = parseFloat($(Fila.childNodes[3].innerHTML)[0].value);
        CantidadProducto = parseFloat($(Fila.childNodes[2].innerHTML)[0].value);
        Fila.childNodes[5].innerHTML =PrecioProducto * CantidadProducto;
        TotalProducto = parseFloat(Fila.childNodes[5].innerHTML);
        Suma = Suma + TotalProducto;
    });
    var Descuento = $('#Descuento').val();;
    var TotalConDescuento = Suma - (Suma * (Descuento / 100) );
    var IVA = TotalConDescuento * 0.15;
    TotalConDescuento = IVA + TotalConDescuento;
    $('#SubTotal').val(Suma);
    $('#IVA').val(IVA);
    $('#Total').val(TotalConDescuento);
}

function ActualizarPrecio() {
    $.ajax({
        url: "../../../precio_producto/"+ $('#ID_Producto').val(),
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (Resultado) {
            $('#Precio').val(Resultado.Producto.Precio_Venta)
            $('#Cantidad').val("1");
        }
    });
}