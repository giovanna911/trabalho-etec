<?php 
    include("functions.php"); 
    
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
    edit(); 

?>

            <h2 class="mt-2">Atualizar Enfermeiros</h2>
            <style>
                label {
                    font-weight: bold;
                    color: #707070;
                }
            </style>

            <form action="edit.php?id=<?php echo $enfermeiros['id']; ?>" method="post" enctype="multipart/form-data">
                <!-- area de campos do form -->
                <hr />
                <div class="col-md-6 d-flex justify-content-between gap-2">
                    <div class="form-group col">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="enfermeiros[nome]" value="<?php echo $enfermeiros['nome']?>">
                    </div>
                </div>

                <div class="col-md-6 d-flex justify-content-between gap-2 mt-1">
                    <div class="form-group col">
                        <label for="campo2">Endereço</label>
                        <input type="text" class="form-control" name="enfermeiros[endereco]" value="<?php echo $enfermeiros['endereco']?>">
                    </div>
                    <div class="form-group col">
                        <label for="campo2">COREN</label>
                        <input type="text" class="form-control" name="enfermeiros[COREN]" value="<?php echo $enfermeiros['COREN']?>">
                    </div>
                </div>

                <div class="col-md-6 d-flex justify-content-between gap-2 mt-1">
                    <div class="form-group">
                        <label for="campo3">Data de Nascimento</label>
                        <input type="date-local" class="form-control fw-bold" disabled value="<?php echo $enfermeiros['DataNasc'] ?>">
                    </div>

                    <?php 
                        $foto = "";
                        if (empty( $enfermeiros["foto"] )) {
                            $foto = "semimagem.png";
                        } else {
                            $foto = $enfermeiros['foto'];
                            
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
                    <img class="form-control shadow p-2 mb-2 bg-body rounded" id="imgPreview" src="fotos/<?php echo $foto?>" alt="Foto dos Enfermeiros">
                </div>


                <div id="actions" class="mt-3">
                    <div class="col-md-6 d-flex justify-content-between gap-2">
                        <button type="submit" class="btn btn-secondary col"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
                        <a href="index.php" class="btn btn-light text-dark"><i class="fa-solid fa-eraser"></i> Cancelar</a>
                    </div>
                </div>
            </form>

<?php include(FOOTER_TEMPLATE); ?>

<script>
    function limparCaminho() {
        // Limpar o valor do input
        document.getElementById('foto').value = '';

        // Exibir a foto original na pré-visualização
        document.getElementById('imgPreview').src = 'fotos/<?php echo $foto?>';
    }

    $(document) .ready(() => {
        $("#foto").change(function () {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $("#imgPreview").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>