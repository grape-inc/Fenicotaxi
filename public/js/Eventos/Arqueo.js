$(document).ready(function () {
    ConfigurarTablas();
});

function ConfigurarTablas() {
    $('#TablaArqueo').DataTable({
        buttons: [
            {
                extend: 'excel',
                text: 'Exportar a excel',
                title: "Fenicotaxi",
                messageTop: 'Reporte de Arqueo',
                className: 'btn btn-success btn-fw btn-rounded rectificadortablaboton',
                customize: function( Xlsx ) {
                    var Source = Xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                    Source.setAttribute('name','Arqueo');
                },
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17]
                },
            },
            {
                extend: 'pdf',
                orientation: 'landscape',
                text: 'Exportar a pdf',
                title: "Fenicotaxi",
                messageTop: 'Reporte de arqueo',
                className: 'btn btn-success btn-fw btn-rounded rectificadortablaboton',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17]
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


function EliminarArqueo(ID, URL) {
    Swal.fire({
        title: '¿Seguro?',
        text: "Se eliminara el cargo.",
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
