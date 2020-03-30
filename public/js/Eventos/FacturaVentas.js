$(document).ready(function () {
    $('#Agregar').click(function () {
        agregar();
        EvaluarTotales();
    });

    $('#Descuento').change(function(){
        EvaluarTotales();
    });
});

var cont = 0;
total = 0;
subtotal = [];

function agregar() {
    ID_Producto = $("#ID_Producto").val();
    producto = $("#ID_Producto option:selected").text();
    Cantidad = $("#Cantidad").val();
    Impuesto = $("#Impuesto").val();
    Precio = $("#Precio").val();
    Total = $("Total")

    if (ID_Producto != "" && Cantidad != "" && Cantidad > 0 && Precio != "") {
        subtotal[cont] = (Cantidad * Precio);
        total = total + subtotal[cont];
        var Fila = '<tr class="selected" id="Fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="ID_Producto[]" value="' + ID_Producto + '">' + producto + '</td><td><input type="number" name="Cantidad[]" value="' + Cantidad + '"></td><td><input type="number" name="Precio[]" value="' + Precio + '"></td><td>' + subtotal[cont] + '</td></tr>';
        cont++;
        limpiar();
        evaluar();
        $('#TablaDetalle').append(Fila);

    } else {
        alert("Error al ingresar el detalle de la factura, revise los datos del articulo")
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
}

function EvaluarTotales() {
    var Suma = 0;
    $('#TablaDetalle > tbody > tr').each(function(Index, Fila ) {
        TotalProducto = parseFloat(Fila.childNodes[4].innerHTML);
        Suma = Suma + TotalProducto;
    });
    var Descuento = $('#Descuento').val();;
    var TotalConDescuento = Suma - (Suma * (Descuento / 100) );
    $('#SubTotal').val(Suma);
    $('#Total').val(TotalConDescuento);
}