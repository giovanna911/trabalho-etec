<?php    
    include("functions.php");
    index();
    if (!isset($_SESSION)) session_start();

    if(isset($_GET['pdf'])){
        if($_GET['pdf']=="ok"){
            pdf();
        } else {
            pdf($_GET['pdf']);
        }
    }
    include(HEADER_TEMPLATE);
    
    
?>

            <header class="mt-2">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Usuários</h2>
                    </div>
                    <div class="col-sm-6 text-end h2">
                        <a class="btn btn-light" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
                        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
                            <a class="btn btn-danger" href="index.php?pdf=<?php echo $_POST['users']; ?>" download><i class="fa-solid fa-file-pdf"></i>Listagem</a>
                        <?php else : ?>
                            <a class="btn btn-danger" href="index.php?pdf=ok" download><i class="fa-solid fa-file-pdf"></i> Listagem</a>
                        <?php endif; ?>
                    </div>
                </div>
            </header>
            <form name="filtro" action="index.php" method="post">
                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" maxlength="80" name="enfermeiro" required>
                            <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Consultar</button>
                        </div>
                    </div>
                </div>
            </form>

            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php 
                clear_messages();
                endif;
            ?>

            <hr>

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Usuário (login)</th>
                        <th class="img-flex">Foto</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($usuarios) : ?>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['nome']; ?></td>
                            <td><?php echo $usuario['user']; ?></td>
                            <td class="img-flex">
                                <?php 
                                    if(!empty($usuario['foto'])) {
                                        echo "<img src=\"fotos/" . $usuario['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"50px\">";
                                    } else {
                                        echo "<img src=\"fotos/semimagem.png\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"50px\">";
                                    }
                                ?>
                            </td>
                            <td class="actions-links">
                                <a href="view.php?id=<?php echo $usuario['id']; ?>" class="btn btn-light"><i class="fa fa-eye"></i> Visualizar</a>
                                <?php if (isset($_SESSION['user'])) : //Verifica se está logado ?>
                                    <?php if ($_SESSION['user']) : //Verifica se está logado como admin ?>
                                        <a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-secondary">
                                            <i class="fa-solid fa-paperclip"></i> 
                                            Editar
                                        </a>

                                        <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#delete-user-modal" data-usuario="<?php echo $usuario['id']; ?>"data-prefixo="<?php echo $usuario['nome']?>">
                                            <i class="fa fa-trash"></i> 
                                            Excluir
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">Nenhum registro encontrado.</td>
                    </tr>
        <?php endif; ?>
                </tbody>
            </table>
<?php include("modal.php"); ?>
<?php include(FOOTER_TEMPLATE); ?>