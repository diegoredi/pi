$(document).ready(function() {

    $("#btnAcessar").click(function() {
        console.log($("#iLogin").val());
        if ($("#iLogin").val().trim() != "" && $("#iSenha").val().trim() != "") {

            var login = { nome: $("#iLogin").val().trim(), senha: $("#iSenha").val().trim() };
            $.ajax({
                type: 'POST',
                url: '../pi/usuario/login',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify(login),
                success: function(data) {
                    if (data["message"] == "logado") {
                        window.location.href = "gerador.php";
                    }
                },
                error: function(e) {
                    window.location.href = "erroLogin.php";
                }
            })



        } else {
            alert("Os campos não podem estar vazios!");
        }
    });

});