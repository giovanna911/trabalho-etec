<?php 
    include('functions.php'); 
    add();

    
    if (!isset($_SESSION)) session_start();
    if (isset($_SESSION['user'])) { // Verifica se tem um usuário logado
        if (!$_SESSION['user']) {
            header("Location: index.php");
            $_SESSION["message"] = "Você precisa estar logado para acessar esse recurso!";
            $_SESSION['type'] = "danger";
        }
    } else {
        header("Location: index.php");
        $_SESSION["message"] = "Você precisa estar logado para acessar esse recurso!";
        $_SESSION['type'] = "danger";
    }
    
    include(HEADER_TEMPLATE); 


    $today = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    $dataAtual = $today->format("Y-m-d H:m:s");
?>


            <h2 class="mt-2">Novo Enfermeiro</h2>

            <form action="add.php" method="post" enctype="multipart/form-data">
                <!-- area de campos do form -->
                <hr />
                <div class="col-md-6">
                    <style>
                        .form-group{
                            --bs-gutter-x: 1rem !important;
                            width: 100%;
                        }

                        .form-group #imgPreview {
                            width: 25%;
                        }

                        @media (max-width: 900px) {
                            .form-group {
                                margin: 0px auto;
                            }
                        }
                    </style>
                    <div class="form-group col">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="enfermeiros[nome]" required>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="col">
                            <label for="campo2">Endereço</label>
                            <input type="text" class="form-control" name="enfermeiros[endereco]" required>
                        </div>
                        <div class="">
                            <label for="campo2">COREN</label>
                            <input type="text" class="form-control" name="enfermeiros[COREN]" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex gap-2 mt-1" >
                    <div class="form-group col">
                        <label for="campo3">Data de Nascimento</label>
                        <input type="date" class="form-control fw-bold" name="enfermeiros[DataNasc]" required>
                    </div>
                    <div class="form-group col">
                        <label for="foto">Foto</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="foto" name="foto">
                            <button class="btn btn-light text-secondary" type="button" onclick="limparCaminho()"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="mt-1">
                        <label for="">Pré-visualização</label>
                        <img class="form-control rounded" id="imgPreview" src="fotos/semimagem.png" alt="Sem foto">
                    </div>
                </div>
                

                <div id="actions" class="mt-3">
                    <div class="col-md-6 d-flex justify-content-between gap-2">
                        <button type="submit" class="btn btn-secondary col"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
                        <a href="index.php" class="btn btn-light text-dark"><i class="fa-solid fa-eraser"></i> Cancelar</a>
                    </div>
                </div>
            </form>

<?php  include(FOOTER_TEMPLATE); ?>
<script>
    function limparCaminho() {
        // Limpar o valor do input
        document.getElementById('foto').value = '';

        // Exibir a foto original na pré-visualização
        document.getElementById('imgPreview').src = 'fotos/semimagem.png';
    }

    $(document).ready(()=>{
      $('#foto').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#imgPreview').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
    });
</script>