$(document).ready(function () {
    ConfigurarEventos();
});

function ConfigurarEventos(){
    $('#Es_Repuesto').change(function() {
        if ($('#Es_Repuesto')[0].checked)
        {
            $("#divrepuesto").removeClass("quitardiv");            
        }
        else{            
            $("#divrepuesto").addClass("quitardiv");
        }
    });
}