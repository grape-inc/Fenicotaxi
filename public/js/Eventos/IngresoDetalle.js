    $(document).ready(function () {
        var Divisa_Previa = null;
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
        $('#ID_Divisa').change(function(event){
            EvaluarTotales(true,Divisa_Previa );
            Divisa_Previa = $('#ID_Divisa').val();
         });
    });

    var cont = 0;
    total = 0;
    subtotal = [];

    function agregar() {
        numero_de_detalles = $('#TablaDetalle > tbody > tr').length;
        if (numero_de_detalles && cont == 0) {
            cont = numero_de_detalles;
        }

        ID_Producto = $("#ID_Producto").val();
        producto = $("#ID_Producto option:selected").text();
        Cantidad = new Number($("#Cantidad").val());
        Impuesto = $("#Impuesto").val();
        Precio = new Number($("#Precio").val());
        Total = $("Total")

        if (ID_Producto != "" && Cantidad != "" && Cantidad > 0 && Precio != "") {
            subtotal[cont] = (Cantidad * Precio);
            total = total + subtotal[cont];
            var Fila = '<tr class="selected" id="Fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="ingreso_detalles['+ cont +'][ID_Producto]" value="' + ID_Producto + '">' + producto + '</td><td><input type="number" name="ingreso_detalles['+ cont +'][Cantidad]" value="' + Cantidad + '" readonly ></td><td><input type="number" name="ingreso_detalles['+ cont +'][Precio]" value="' + Precio + '" readonl></td><td><input type="hidden" value="' + $("#ID_Divisa").val() + '">' + $("#ID_Divisa option:selected").text() + '</td><td>' + subtotal[cont]  + ' ' +$("#ID_Divisa option:selected").text() +'</td></tr>';
            cont++;
            limpiar();
            evaluar();
            $('#TablaDetalle').append(Fila);
            EvaluarTotales();

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
            Fila.childNodes[5].innerHTML =redondear((PrecioProducto * CantidadProducto),2) + ' ' +$("#ID_Divisa option:selected").text();
            TotalProducto = parseFloat(Fila.childNodes[5].innerHTML);
            Suma = Suma + TotalProducto;
        });
        var SubTotal = Suma;
        var IVA = SubTotal * 0.15;
        Total = SubTotal + IVA;
        $('#SubTotal').val(redondear(SubTotal,2));
        $('#IVA').val(redondear(IVA,2));
        $('#Total').val(redondear(Total,2));
    }

    function redondear(numero, precision) {
        var re = new RegExp('^-?\\d+(?:\.\\d{0,' + (precision || -1) + '})?');
        return numero.toString().match(re)[0];
    }
