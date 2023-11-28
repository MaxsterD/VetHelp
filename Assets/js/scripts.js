$(document).ready(function(){
    $("#btnPerfil").click(function(){
        $.ajax({
            url: "cargar_perfil.php",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    $("#perfilContenido").html(data.content);
                    $("#perfilModal").modal('show');
                } else {
                    alert(data.content);
                }
            }
        });
    });

    $(document).on('submit', '#formEditarPerfil', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'actualizar_perfil.php',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data) {
                alert(data.message);
                if(data.success) {
                    $("#perfilModal").modal('hide');
                }
            }
        });
    });
});