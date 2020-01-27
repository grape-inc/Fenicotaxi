$(document).ready(function () {
    ConfigurarEventos();
});

function ConfigurarEventos(){
    $('#esrepuesto').change(function() {
        if ($('#esrepuesto')[0].checked)
        {
            $("#divrepuesto").removeClass("quitardiv");            
        }
        else{            
            $("#divrepuesto").addClass("quitardiv");
        }
    });
}