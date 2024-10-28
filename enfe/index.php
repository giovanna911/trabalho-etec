<?php
    include("functions.php");
    if (!isset($_SESSION)) session_start();

    include(HEADER_TEMPLATE);
    index();
?>

            <header class="mt-2">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Enfermeiros</h2>
                    </div>
                    <div class="col-sm-6 text-end h2">
                        <a class="btn btn-light" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
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
                        <th>Endereço</th>
                        <th>COREN</th>
                        <th>Data de Nascimento</th>
                        <th class="img-flex">Foto</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($enfermeiros) : ?>
                    <?php foreach ($enfermeiros as $enfermeiro) : ?>
                        <tr>
                            <td><?php echo $enfermeiro['id']; ?></td>
                            <td><?php echo $enfermeiro['nome']; ?></td>
                            <td><?php echo $enfermeiro['endereco']; ?></td>
                            <td><?php echo $enfermeiro['COREN']; ?></td>
                            <td><?php echo $enfermeiro['DataNasc']; ?></td>
                            <td class="img-flex"><?php 
                                            if(!empty($enfermeiro['foto'])) {
                                                echo "<img src=\"fotos/" . $enfermeiro['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"50px\">";
                                            } else {
                                                echo "<img src=\"fotos/semimagem.png\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"50px\">";
                                            }
                                        ?>
                            </td>
                            <td class="actions-links">
                                <a href="view.php?id=<?php echo $enfermeiro['id']; ?>" class="btn btn-light"><i class="fa fa-eye"></i> Visualizar</a>
                                <?php if (isset($_SESSION['user'])) : //Verifica se está logado ?>
                                    <?php if ($_SESSION['user']) : //Verifica se está logado como admin ?>
                                        <a href="edit.php?id=<?php echo $enfermeiro['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-paperclip"></i></i> Editar</a>

                                        <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#delete-enfe-modal" data-enfermeiro="<?php echo $enfermeiro['id']; ?>"data-prefixo="<?php echo $enfermeiro['nome']?>">
                                            <i class="fa fa-trash"></i></i> Excluir
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