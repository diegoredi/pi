$(document).ready(function() {

    var url = window.location.href;
    var id = url.split("?id=")[1];
    window.history.pushState("Object", "Title", "/pi/presenca.php");

    $("#btnGravar").click(function() {
        if ($("#iRa").val().trim() != "") {
            var dados = {
                evento_id: id,
                ra: $("#iRa").val().trim()
            }

            $.ajax({
                type: 'POST',
                url: '../pi/presenca/create',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify(dados),
                success: function(data) {
                    if (data["message"]) {
                        $("#modalTitle").text("Presença gravada com sucesso!");
                        $("#imgPresenca").attr("src", "https://cdn2.iconfinder.com/data/icons/greenline/512/check-512.png");
                        $('#modalPresenca').modal('show');
                        setInterval(function() {
                            location.reload();
                        }, 2000)
                    }
                },
                error: function(data) {
                    console.log(data);
                    $("#modalTitle").text("Houve um erro ao gravar presença, tente novamente!");
                    $("#imgPresenca").attr("src", "https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678069-sign-error-512.png");
                    $('#modalPresenca').modal('show');
                }
            });

        } else {
            alert("Os campos não podem estar vazios!");
        }
    });

});