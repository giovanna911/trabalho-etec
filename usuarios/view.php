<?php 
	include("functions.php"); 
    if (!isset($_SESSION)) session_start();
    if (isset($_SESSION['user'])) { // Verifica se tem um usuário logado
        if ($_SESSION['user'] != "admin") {
            $_SESSION["message"] = "Você precisa ser administrador para acessar esse recurso!";
            $_SESSION['type'] = "danger";
            header("Location:" . BASEURL ."index.php");
        }
    } else {
        $_SESSION["message"] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
        $_SESSION["type"] = "danger";
        header("Location:" . BASEURL . "index.php");
    }
	view($_GET['id']);
    include(HEADER_TEMPLATE);
?>          
            <style>
                .card-img-top {
                    width: 250px;
                }

                .senha {
                    word-break: break-all;
                }

                .img-user {
                    border-radius: 50%;
                    text-align: center;
                }

                dd::first-letter {
                    text-transform: uppercase;
                }

                .img-user {
                    max-width: 100%;
                }

            </style>

            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php else : ?>
                <header>
                    <h2>Usuário | <b class="title-user"><?php echo $usuario['nome']; ?></b></h2>
                    <hr>
                </header>

                <dl class="dl-horizontal col-md-6">
                    <?php 
                        if(!empty($usuario['foto'])) {
                            echo "<img src=\"fotos/" . $usuario['foto'] ."\" class=\" p-1 mb-1 bg-body img-user col-md-6\">";
                        } else {
                            echo "<img src=\"fotos/semimagem.png\" class=\"shadow p-1 mb-1 bg-body img-user rounded col\" >";
                        }
                    ?>

                    <dt>Nome:</dt>
                    <dd class="col border p-2 rounded"><?php echo $usuario['nome']; ?></dd>

                    <dt>User (admin):</dt>
                    <dd class="col border p-2 rounded"><?php echo $usuario['user']; ?></dd>

                    <dt>Senha:</dt>
                    <dd class="col senha border p-2 rounded"><?php echo $usuario['password'] ?></dd>
                </dl>
                    
                        <div id="actions">
                            <div class="col-md-6 d-flex justify-content-between gap-2">
                                <?php if (empty($_SESSION['message'])) : ?> 
                                <a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-secondary rounded-1 btn-editar col">
                                    <i class="fa-solid fa-pen"></i> Editar
                                </a>
                                <?php endif; ?> 

                                <a href="index.php" class="btn btn-light rounded-1 col-md-3">
                                    <i class="fa-solid fa-chevron-left"></i> Voltar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
               
            <?php endif; ?> 
           
            <?php clear_messages(); ?> 

<?php include(FOOTER_TEMPLATE); ?>