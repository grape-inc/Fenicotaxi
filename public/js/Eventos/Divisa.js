$(document).ready(function () {
    ConfigurarTablas();
});

function ConfigurarTablas() {
    $('#TablaDivisas').DataTable({
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