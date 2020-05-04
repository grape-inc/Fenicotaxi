$(document).ready(function () {
    ConfigurarTablas();
});

function ConfigurarTablas() {
    $('#TablaUsuarios').DataTable({
        dom: 'Bfrtip',
        "autoWidth": true,
        buttons: [
            {
                extend: 'excel',
                text: 'Exportar a excel',
                title: "Fenicotaxi",
                messageTop: 'Reporte de usuarios',
                className: 'btn btn-success btn-fw btn-rounded rectificadortablaboton',
                customize: function( Xlsx ) {
                    var Source = Xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                    Source.setAttribute('name','Usuarios');
                },
                exportOptions: {
                    columns: [ 0,1,2]
                },
            },
            {
                extend: 'pdf',
                orientation: 'landscape',
                className: 'btn btn-success btn-fw btn-rounded rectificadortablaboton',
                text: 'Exportar a pdf',
                title: "Fenicotaxi",
                download: 'open',
                messageTop: 'Reporte de usuarios',
                exportOptions: {
                    columns: [ 0,1,2]
                },
                customize: function (doc) {
                    doc.content.splice(0, 1, {
                        text: [{
                          text: 'FENICOTAXI, R.L\n',
                          bold: true,
                          fontSize: 16
                        },{
                          text: 'Dir: Barrio Martha Quezada, C.S.T. 1 c al Este. Tel: (505) 2222-5001\n',
                          bold: true,
                          fontSize: 16
                        },{
                            text: 'www.fenicotaxi.org * Managua, Nicaragua * RUC:J0810000002960',
                            bold: true,
                            fontSize: 16
                        }],
                        margin: [0, -60, 0, 50],
                        alignment: 'center'
                      });
                    var now = new Date();
                    var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
                    var logo = 'data:image/png;base64,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';
                    doc.pageMargins = [20,120,20,30];
                    doc['header']=(function() {
                        return {
                            columns: [
                                {
                                    image: logo,
                                    width: 80,
                                    height: 80,
                                    margin: [80,0]
                                },
                                {
                                    alignment: 'left',
                                    text: 'Federación Nicaragüense de Cooperativas de Taxi, R.L.',
                                    margin: [95,10],
                                    bold: true,
                                    fontSize: 21
                                }
                            ],
                            margin: 20
                        }
                    });
                    doc['footer']=(function(page, pages) {
                        return {
                            columns: [
                                {
                                    alignment: 'left',
                                    bold: true,
                                    margin: [20,0],
                                    text: ['Creado el: ', { text: jsDate.toString() }]
                                },
                                {
                                    alignment: 'right',
                                    bold: true,
                                    margin: [20,0],
                                    text: ['Pagina ', { text: page.toString() },	' de ',	{ text: pages.toString() }]
                                }
                            ]
                        }
                    });
                    var objLayout = {};
                    objLayout['hLineWidth'] = function(i) { return .5; };
                    objLayout['vLineWidth'] = function(i) { return .5; };
                    objLayout['hLineColor'] = function(i) { return '#aaa'; };
                    objLayout['vLineColor'] = function(i) { return '#aaa'; };
                    objLayout['paddingLeft'] = function(i) { return 4; };
                    objLayout['paddingRight'] = function(i) { return 4; };
                    doc.content[0].layout = objLayout;
                }
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


function EliminarUsuario(ID, URL) {
    Swal.fire({
        title: '¿Seguro?',
        text: "Se eliminara El Usuario.",
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
