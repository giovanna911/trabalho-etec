<?php
    include("functions.php");
    if (!isset($_SESSION)) session_start(); 
    include(HEADER_TEMPLATE);
    index();
?>

            <header class="mt-2">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Pacientes</h2>
                    </div>
                    <div class="col-sm-6 text-end h2">
                        <a class="btn btn-light" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
                    </div>
                </div>
            </header>

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
                        <th width="30%">Nome</th>
                        <th>CPF/CNPJ</th>
                        <th>Telefone</th>
                        <th class="img-flex">Atualizado em</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($customers) : ?>
                <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <td><?php echo $customer['id']; ?></td>
                        <td><?php echo $customer['name']; ?></td>
                        <td><?php echo $customer['cpf_cnpj']; ?></td>
                        <td><?php echo formatacel($customer['mobile']); ?></td>
                        <td class="img-flex"><?php echo formatadata($customer['modified'], "d/m/Y - H:i:s"); ?></td>
                        <td class="actions text-start actions-links">
                            <a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn btn-light"><i class="fa fa-eye"></i> Visualizar</a>
                            <?php if (isset($_SESSION['user'])) : //Verifica se está logado ?>
                                <?php if ($_SESSION['user']) : //Verifica se está logado como admin ?>
                                    <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn btn-secondary"><i class="fa-solid fa-user-pen"></i> Editar</a>
                                    <a href="#" class="btn btn btn-dark" data-bs-toggle="modal" data-bs-target="#delete-modal" data-customer="<?php echo $customer['id']; ?>" data-nome="<?php echo $customer['name']?>"><i class="fa fa-trash"></i> Excluir </a>
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