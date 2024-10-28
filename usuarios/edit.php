<?php 
    include("functions.php"); 
    edit();

    if (!isset($_SESSION)) session_start();
    if (isset($_SESSION['user'])) { // Verifica se tem um usuário logado
        if ($_SESSION['user'] != "admin") {
            header("Location: index.php");
            $_SESSION["message"] = "Você precisa ser administrador para acessar esse recurso!";
            $_SESSION['type'] = "danger";
            header("Location:" . BASEURL ."index.php");
        }
    } else {
        header("Location: index.php");
        $_SESSION["message"] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
        $_SESSION["type"] = "danger";
    }

    include(HEADER_TEMPLATE);     
    
?>
           
             <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php else : ?>
            <h2 class="mt-2">Atualizar Usuário</h2>
            <style>
                .row {
                    --bs-gutter-x: 0rem !important;
                }
            </style>

            <form action="edit.php?id=<?php echo $usuario['id']; ?>" method="post" enctype="multipart/form-data">
                <!-- area de campos do form -->
                <hr />
                <div class="col-md-6 d-flex justify-content-between gap-2">
                    <div class="form-group col">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="usuario[nome]" value="<?php echo $usuario['nome']; ?>">
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-between gap-2 mt-1">
                    <div class="form-group col">
                        <label for="campo2">Usuário (login)</label>
                        <input type="text" class="form-control" name="usuario[user]" value="<?php echo $usuario['user']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="campo3">Senha</label>
                        <input type="password" class="form-control" name="usuario[password]" >
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-between gap-2 mt-1">
                    <?php 
                        $foto = "";
                        if (empty( $usuario["foto"] )) {
                            $foto = "semimagem.png";
                        } else {
                            $foto = $usuario['foto'];
                        }
                    ?>
                    <div class="form-group col">
                        <label for="foto">Foto</label>
                        <div class="input-group col-md-2">
                            <input type="file" class="form-control" id="foto" name="foto" value="fotos/<?php echo $foto?>">
                            <button class="btn btn-light text-secondary" type="button" onclick="limparCaminho()" id="btnLimpar"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    
                </div>
                <div class="form-group col-md-6 mt-1">
                    <label for="imgPreview">Pré-visualização</label>
                    <img class="form-control shadow p-2 m-0 bg-body rounded" id="imgPreview" src="fotos/<?php echo $foto?>" alt="Foto do usuário">
                </div>
                
                <div id="actions" class="mt-3">
                    <div class="col-md-6 d-flex justify-content-between gap-2">
                        <button type="submit" class="btn btn-secondary col"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
                        <a href="index.php" class="btn btn-light text-dark"><i class="fa-solid fa-eraser"></i> Cancelar</a>
                    </div>
                </div>
            </form>
            <?php endif; ?> 

<?php include(FOOTER_TEMPLATE); ?>

<script>  
    function limparCaminho() {
            // Limpar o valor do input
            document.getElementById('foto').value = '';

            // Exibir a foto original na pré-visualização
            document.getElementById('imgPreview').src = 'fotos/<?php echo $foto?>';
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