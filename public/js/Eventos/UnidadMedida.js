$(document).ready(function () {
    ConfigurarTablas();
});

function ConfigurarTablas() {
    $('#TablaUnidades').DataTable({
        dom: 'Bfrtip',
        "autoWidth": true,
        buttons: [            
            {                
                extend: 'excel',
                text: 'Exportar a excel',
                title: "Fenicotaxi",
                className: 'btn btn-success btn-fw btn-rounded rectificadortablaboton',
                messageTop: 'Reporte de unidades de medida',
                customize: function( Xlsx ) {
                    var Source = Xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                    Source.setAttribute('name','Unidades de medida');
                },
                exportOptions: {
                    columns: [ 0,1]
                },
            },
            {
                extend: 'pdf',
                orientation: 'landscape',
                text: 'Exportar a pdf',
                title: "Fenicotaxi",
                className: 'btn btn-success btn-fw btn-rounded rectificadortablaboton',
                messageTop: 'Reporte de unidades de medida',
                exportOptions: {
                    columns: [ 0,1]
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


function EliminarUnidad(ID, URL) {
    Swal.fire({
        title: '¿Seguro?',
        text: "Se eliminara la unidad de medida.",
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
