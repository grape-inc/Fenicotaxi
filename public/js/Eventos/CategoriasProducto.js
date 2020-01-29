$(document).ready(function () {
    ConfigurarTablas();
});

function ConfigurarTablas() {
    $('#TablaCategorias').DataTable({
        dom: 'Bfrtip',
        "autoWidth": true,
        buttons: [            
            {                
                extend: 'excel',
                text: 'Exportar a excel',
                title: "Fenicotaxi",
                messageTop: 'Reporte de categorias',
                customize: function( Xlsx ) {
                    var Source = Xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                    Source.setAttribute('name','Categorias');
                },
                exportOptions: {
                    columns: [ 0,1,2]
                },
            },
            {                
                extend: 'pdf',
                orientation: 'landscape',                
                text: 'Exportar a pdf',
                title: "Fenicotaxi",
                messageTop: 'Reporte de categorias',                
                exportOptions: {
                    columns: [ 0,1,2]
                },
            },
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron datos",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "La busqueda no devolvio resultados",
            "infoFiltered": "(Se busco en _MAX_ registros )",
            "sSearch": "Buscar",
            "paginate": {
                "next": "Siguiente pagina",
                "previous": "Pagina anterior"
            },
            "columnDefs": [{
                "className": "dt-center",
                "targets": "_all"
            }],
            "responsive": true
        }
    });
}


function EliminarCategoria(ID, URL) {
    Swal.fire({
        title: '¿Seguro?',
        text: "Se eliminara la categoria.",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminar.'
    }).then((Resultado) => {
        if (Resultado.value) {
            $.ajax({
                url: URL + "/" + ID,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (Resultado) {
                    window.location = Resultado;
                }
            });
        }
    })
}
