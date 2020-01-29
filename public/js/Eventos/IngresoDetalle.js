$(document).ready(function () {
    $('#Agregar').click(function () {
        agregar();
    });
});

var cont = 0;
total = 0;
subtotal = [];
$("#guardar").hide();

function agregar() {
    idproducto = $("#ID_Producto").val();
    producto = $("#ID_Producto option:selected").text();
    cantidad = $("#Cantidad").val();
    precio = $("#Precio").val();

    if (idproducto != "" && cantidad != "" && cantidad > 0 && precio != "") {
        subtotal[cont] = (cantidad * precio);
        total = total + subtotal[cont];

        var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="idproducto[]" value="' + idproducto + '">' + producto + '</td><td><input type="number" name="Cantidad[]" value="' + cantidad + '"></td><td><input type="number" name="precio[]" value="' + precio + '"></td><td><input type="number" name="precio[]" value="' + precio + '"></td><td>' + subtotal[cont] + '</td></tr>';
        cont++;
        limpiar();
        $('#total').html("$/ " + total);
        evaluar();
        $('#TablaDetalle').append(fila);

    } else {
        alert("Error al ingresar el detalle del ingreso, revise los datos del articulo")
    }

}

function limpiar() {
    $("#ID_Producto").val("");
    $("#Cantidad").val("");
    $("#Precio").val("");
}

function evaluar() {
    if (total > 0) {
        $("#guardar").show();
    } else {
        $("#guardar").hide();
    }
}

function eliminar(index) {
    total = total - subtotal[index];
    $("#total").html("S/. " + total);
    $("#fila" + index).remove();
    evaluar();

}
