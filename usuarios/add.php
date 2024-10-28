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

?>
           
        <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <a href="<?php echo BASEURL ?>index.php" class="btn btn-light">
                    <i class="fa-solid fa-chevron-left"></i> Voltar
                </a>
            <?php else : ?>
            <h2 class="mt-2">Novo Usuário</h2>
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

            <form action="add.php" method="post" enctype="multipart/form-data">

                <!-- area de campos do form -->
                <hr />
                <div class="col-md-6 d-flex justify-content-between gap-2">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="usuario[nome]" required>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-between gap-2">
                    <div class="form-group mt-1">
                        <label for="user">Usuário (login)</label>
                        <input type="text" class="form-control" id="user" name="usuario[user]" required>
                    </div>
                    <div class="form-group mt-1 ">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="usuario[password]" required >
                    </div>  
                </div>
                <div class="col-md-6 d-flex justify-content-between gap-2 mt-1">
                    <div class="form-group col-md-4">
                        <label for="foto">Foto</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="foto" name="foto">
                            <button class="btn btn-light text-secondary" type="button" onclick="limparCaminho()"><i class="fa-solid fa-trash"></i></button>
                        </div>
                        
                    </div>
                    
                </div>

                <div class="col-md-6 mt-1">
                    <label for="imgPreview">Pré-visualização</label>
                    <img class="form-control rounded shadow" id="imgPreview" src="fotos/semimagem.png">
                </div>

                <<div id="actions" class="mt-3">
                    <div class="col-md-6 d-flex justify-content-between gap-2">
                        <button type="submit" class="btn btn-secondary col"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
                        <a href="index.php" class="btn btn-light text-dark"><i class="fa-solid fa-eraser"></i> Cancelar</a>
                    </div>
                </div>
            </form>
            <?php endif;?>

<?php include(FOOTER_TEMPLATE); ?>

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