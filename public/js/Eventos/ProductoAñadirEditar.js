$(document).ready(function () {
    ConfigurarEventos();

    $('#ActualizarDatos').click(function(event){
        $.ajax({
         url: "../../info_productos",
         type: "get"
        })
        .done(function(datos) {
            $('#ID_Categoria').html("");
            $('#ID_Proveedor').html("");
            $('#ID_UnidadMedida').html("");

            $.each(datos.Categorias, function(indice, opcion) {
                $('#ID_Categoria').append($('<option/>').attr("value", opcion.ID_Categoria).text(opcion.Nombre_Categoria));
            });
            $.each(datos.Proveedores, function(indice, opcion) {
                $('#ID_Proveedor').append($('<option/>').attr("value", opcion.ID_Proveedor).text(opcion.Nombre_Proveedor));
            });
            $.each(datos.UnidadMedida, function(indice, opcion) {
                $('#ID_UnidadMedida').append($('<option/>').attr("value", opcion.ID_Unidad).text(opcion.Nombre_Unidad));
            });
            $('#ID_Categoria').trigger('change');
            $('#ID_Proveedor').trigger('change');
            $('#ID_UnidadMedida').trigger('change');
            $('.selectpicker').selectpicker('refresh');
        });
    });
});

function ConfigurarEventos(){
    $('#Es_Repuesto').change(function() {
        if ($('#Es_Repuesto')[0].checked)
        {
            $("#divrepuesto").removeClass("quitardiv");
        }
        else{
            $("#divrepuesto").addClass("quitardiv");
            $('#Año').val("");
            $('#Modelo').val("");
            $('#Origen').val("");
            $('#Marca').val("");
        }
    });
}