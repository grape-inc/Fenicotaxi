$(document).ready(function () {
    ConfigurarTablas();
});

function ConfigurarTablas() {
    $('#TablaNominaDetalle').DataTable({
        dom: 'Bfrtip',
        "autoWidth": true,
        buttons: [
            {
                extend: 'excel',
                text: 'Exportar a excel',
                title: "Fenicotaxi",
                messageTop: 'Reporte de Detalle de Nomina',
                className: 'btn btn-success btn-fw btn-rounded rectificadortablaboton',
                customize: function( Xlsx ) {
                    var Source = Xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                    Source.setAttribute('name','Nominas');
                }
            },
            {
                extend: 'pdf',
                orientation: 'landscape',
                className: 'btn btn-success btn-fw btn-rounded rectificadortablaboton',
                text: 'Exportar a pdf',
                title: "Fenicotaxi",
                messageTop: 'Reporte de nomina',
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


function EliminarNomina(ID, URL) {
    Swal.fire({
        title: '¿Seguro?',
        text: "Se eliminara la Nomina.",
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
