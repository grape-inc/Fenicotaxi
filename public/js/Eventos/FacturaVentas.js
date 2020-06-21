$(document).ready(function () {
    var Divisa_previa = null;
    $('#Agregar').click(function () {
        agregar();
        EvaluarTotales();
    });

    $('#Agregar_Pago').click(function () {
        agregar_pago();
    });
    $('#ID_Divisa').change(function(event){
       EvaluarTotales(true,Divisa_previa);
       Divisa_previa = $('#ID_Divisa').val();
    });

    $('#Es_Credito').change(function(event){
        if(this.checked) {
          $('#pagos_contado').hide();
          $('#total_pendiente').hide();
        }
        else {
            $('#pagos_contado').show();
            $('#total_pendiente').show();
        }
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

    $("form").submit(function(e){
        var total_pendiente = parseFloat($('#total_pendiente').text().split(":")[1])
        if (total_pendiente != 0 && $('#Es_Credito').is(':checked') == false) {
            Swal.fire('¡Error!','Aun no se ha pagado la totalidad de la factura.','error');
          e.preventDefault();
        }
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
                var Fila = '<tr id="Fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="ID_Producto[]" value="' + ID_Producto + '">' + producto + '</td><td><input style="width: 100px;" type="number" name="Cantidad[]" onchange="EvaluarTotales()" class="Cantidad" value="' + Cantidad + '" readonly ></td><td><input type="number" style="width: 140px;" name="Precio[]" onchange="EvaluarTotales()" value="' + Precio + '" readonly></td><td><input type="hidden" name="ID_Moneda[]" value="' + $("#ID_Divisa").val() + '">' + $("#ID_Divisa option:selected").text() + '</td><td><input type="text" name="Descripcion[]" value="' + Descripcion + '"></td><td>' + subtotal[cont] + ' ' +$("#ID_Divisa option:selected").text() +'</td></tr>';
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

function agregar_pago() {
    if($('#ID_Pago').val() != "") {
        ID_Pago = $("#ID_Pago").val();
        Nombre_Pago = $("#ID_Pago option:selected").text();
        ID_Divisa = $("#ID_Divisa_Pago").val();
        Nombre_Divisa = $("#ID_Divisa_Pago option:selected").text();
        Monto = $("#Monto_Pago").val();

        if (ID_Pago != "" && ID_Divisa != "" && Monto > 0) {
                var Fila = '<tr id="FilaPago' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminarpago(' + cont + ');">X</button></td><td><input type="hidden" name="ID_Pago_Factura[]" value="' + ID_Pago + '">' + Nombre_Pago + '</td><td><input type="hidden" name="ID_Divisa_Pago[]" value="' + ID_Divisa + '">' + Nombre_Divisa + '</td><td><input type="number" style="width: 140px;" name="Monto[]" value="' + Monto + '" readonly></td></tr>';
            cont++;
            $('#TablaDetallePagos').append(Fila);

        } else {
            alert("Error al ingresar el detalle de pago, revise bien los datos.")
        }
        EvaluarTotales();
        $('#ID_Pago').val("");
        $('#ID_Divisa_Pago').val("");
        $('#Monto_Pago').val("");
        $('.selectpicker').selectpicker('refresh');
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

function eliminarpago(index) {
    $("#FilaPago" + index).remove();
    EvaluarTotalesPago();
}

function EvaluarTotales(CambioDivisa,Divisa_Anterior) {
    var Suma = 0;
    $('#TablaDetalle > tbody > tr').each(function(Index, Fila ) {
        if (CambioDivisa == null) {
            PrecioProducto = parseFloat($(Fila.childNodes[3].innerHTML)[0].value);
        }
        else if (CambioDivisa == true) {
            PrecioProducto = conversion_divisa(Divisa_Anterior,parseFloat($(Fila.childNodes[3].innerHTML)[0].value))
            Fila.childNodes[3].innerHTML = '<input type="number" style="width: 140px;" name="Precio[]" onchange="EvaluarTotales()" value="'+PrecioProducto+'" readonly="">';
            Fila.childNodes[4].innerHTML = $("#ID_Divisa option:selected").text();
        }
        CantidadProducto = parseFloat($(Fila.childNodes[2].innerHTML)[0].value);
        Fila.childNodes[6].innerHTML =redondear((PrecioProducto * CantidadProducto),2) + ' ' +$("#ID_Divisa option:selected").text();
        TotalProducto = parseFloat(Fila.childNodes[6].innerHTML);
        Suma = Suma + TotalProducto;
    });
    var Descuento = $('#Descuento').val();;
    var TotalConDescuento = Suma - (Suma * (Descuento / 100) );
    var IVA = TotalConDescuento * 0.15;
    TotalConDescuento = (IVA + TotalConDescuento);
    $('#SubTotal').val(redondear(Suma,2));
    $('#IVA').val(redondear(IVA,2));
    $('#Total').val(redondear(TotalConDescuento,2));
    $('#total_factura').text("Total Facturado : "+redondear(TotalConDescuento,2) + " "+ $("#ID_Divisa option:selected").text());
    EvaluarTotalesPago();
}

function EvaluarTotalesPago() {
    var Suma = 0;
    $('#TablaDetallePagos > tbody > tr').each(function(Index, Fila ) {
        Pago = new Number(conversion_divisa($(Fila.childNodes[2].innerHTML)[0].value,parseFloat($(Fila.childNodes[3].innerHTML)[0].value)))
        Suma = Suma + Pago;
    });
    TotalPendiente = (parseFloat($('#Total').val()) - Suma).toFixed(2);
    $('#total_pendiente').text("Monto Pendiente: "+TotalPendiente + " "+ $("#ID_Divisa option:selected").text());
}

function ActualizarPrecio() {
    $.ajax({
        type: 'GET',
        url: "../../../precio_producto/"+ $('#ID_Producto').val(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (Resultado) {
            $('#Precio').val(conversion_divisa(Resultado.Producto.ID_Divisa,Resultado.Producto.Precio_Venta))
            $('#Cantidad').val("1");
        }
    });
}
function conversion_divisa(moneda_destino,monto) {
    moneda_origen = $('#ID_Divisa').val();
    tasa_cambio = $('#tasa_cambio').val();
    if(moneda_origen != ""){
        if (moneda_origen == 1 && moneda_destino == 2) {
            return (monto / tasa_cambio);
        }
        else if (moneda_origen == 2 && moneda_destino == 1) {
            return (monto * tasa_cambio);
        }
        else {
            return monto;
        }
    }
    else{
        limpiar()
        alert("Debes elegir una divisa antes de añadir cualquier producto.")
        $('#ID_Producto').val("").trigger("change")
        throw "NOORIGINMONEY"
    }
}


function redondear(numero, precision) {
    var re = new RegExp('^-?\\d+(?:\.\\d{0,' + (precision || -1) + '})?');
    return numero.toString().match(re)[0];
}