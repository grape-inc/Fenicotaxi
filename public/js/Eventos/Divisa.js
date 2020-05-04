$(document).ready(function () {
    ConfigurarTablas();
});

function ConfigurarTablas() {
    $('#TablaDivisas').DataTable({
        dom: 'Bfrtip',
        "autoWidth": true,
        buttons: [
            {
                extend: 'excel',
                text: 'Exportar a excel',
                title: "Fenicotaxi",
                messageTop: 'Reporte de divisas',
                className: 'btn btn-success btn-fw btn-rounded rectificadortablaboton',
                customize: function( Xlsx ) {
                    var Source = Xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                    Source.setAttribute('name','Divisas');
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
                download: 'open',
                messageTop: 'Reporte de divisas',
                className: 'btn btn-success btn-fw btn-rounded rectificadortablaboton',
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