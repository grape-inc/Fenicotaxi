    var Divisa_Previa = null;
    $(document).ready(function () {
        $('#Agregar').click(function () {
            Divisa_Previa = $('#ID_Divisa').val();
            if (Divisa_Previa == ""){
                alert("Debes elegir una divisa antes de añadir cualquier producto.")
                $('#ID_Producto').val("").trigger("change")
                $('#Cantidad').val("");
                $('#Precio').val("");
            }
            else {
                agregar();
            }
        });
    });

    var cont = 0;
    total = 0;
    subtotal = [];

    function agregar() {
        ID_Producto = $("#ID_Producto").val();
        producto = $("#ID_Producto option:selected").text();
        Cantidad = new Number($("#Cantidad").val());
        Impuesto = $("#Impuesto").val();
        Precio = new Number($("#Precio").val());
        Total = $("Total")

        if (ID_Producto != "" && Cantidad != "" && Cantidad > 0 && Precio != "") {
            subtotal[cont] = (Cantidad * Precio);
            total = total + subtotal[cont];
            var Fila = '<tr class="selected" id="Fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="ID_Producto[]" value="' + ID_Producto + '">' + producto + '</td><td><input type="number" name="Cantidad[]" value="' + Cantidad + '" readonly ></td><td><input type="number" name="Precio[]" value="' + Precio + '" readonl></td><td><input type="hidden" name="ID_Moneda[]" value="' + $("#ID_Divisa").val() + '">' + $("#ID_Divisa option:selected").text() + '</td><td>' + subtotal[cont]  + ' ' +$("#ID_Divisa option:selected").text() +'</td></tr>';
            cont++;
            limpiar();
            evaluar();
            $('#TablaDetalle').append(Fila);

        } else {
            alert("Error al ingresar el detalle del ingreso, revise los datos del articulo")
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
        cont = cont - 1;
    }

    function conversion_divisa(moneda_destino,monto) {
        moneda_origen = $('#ID_Divisa').val();
        tasa_cambio = $('#tasa_cambio').val();
        if(moneda_origen != ""){
            if (moneda_origen == 1 && moneda_destino == 2) {
                return (monto / tasa_cambio).toFixed(2);
            }
            else if (moneda_origen == 2 && moneda_destino == 1) {
                return (monto * tasa_cambio).toFixed(2);
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