<html>
    <head>
        <meta charset="utf-8">
        <title>Gerador de QRCode</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styleGerador.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="js/scriptGerador.js"></script>
    </head>
    <body>
    <div class="container">
          <div class="formulario">
              <center><img style="width:60px;height: auto;" src="imagens/logoFEB.png"></center>
              <h1><center>Gerador de QRCode </center></h1>
                  <div class="form-group">
                    <label>Disciplina</label>
                    <input placeholder="Professor, favor insira a disciplina." type="text" class="form-control" id="iDisciplina">
                  </div>
                  <div class="form-group">
                    <label>Data do evento</label>
                    <input type="date" class="form-control" id="iData">
                  </div>
                  <button id="btnGerar" class="btn mx-auto d-block btn-primary">Gerar QRCode</button>
          </div>
      </div>

      <div class="modal" tabindex="-1" role="dialog" id="modalQR">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p id="modalText"></p>
                <center><img id="imgQrcode" style="width: 100%;" alt=""></center>
                <a id="modalLink"></a>
              </div>
            </div>
          </div>
        </div>
      
      </body></html>