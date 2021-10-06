$(document).ready(function(){

    $("#btnGerar").click(function(){
        if($("#iDisciplina").val().trim() != "" && $("#iData").val() != ""){

            var dados = {
                nome: $("#iDisciplina").val().trim(),
                data_evento: $("#iData").val()
            }
    
            $.ajax({
                type: 'POST',
                url: '../pi/evento/create',
                dataType: 'json',
                contentType: 'application/json',
                data : JSON.stringify(dados),
                success: function(data){
                    console.log(data["message"]);
                    $("#modalTitle").text($("#iDisciplina").val());
                    $("#modalText").text($("#iData").val());
                    $("#imgQrcode").attr("src","https://api.qrserver.com/v1/create-qr-code/?size=500x500&ecc=L&qzone=1&data=http%3A%2F%2Flocalhost%2Fpi%2Fpresenca.php%2F" + data["message"]);
                    $("#modalLink").text("Link manual");
                    $("#modalLink").attr("href", "http://localhost/pi/presenca.php?id=" + data["message"]);
                    $('#modalQR').modal('show');
                }
            })

        }else{
            alert("Os campos não podem estar vazios.");
        }
    });

});