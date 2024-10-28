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

            <h2 class="mt-2">Novo Paciente</h2>

            <form action="add.php" method="post">
                <!-- area de campos do form -->
                <hr />
                <div class="row ">
                    <div class="form-group col-md-7" >
                        <label for="name">Nome / Razão Social</label>
                        <input type="text" class="form-control" name="customer[name]" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="campo2">CNPJ / CPF</label>
                        <input type="text" class="form-control" name="customer[cpf_cnpj]" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">Data de Nascimento</label>
                        <input type="date" class="form-control" name="customer[birthdate]" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="campo1">Endereço</label>
                        <input type="text" class="form-control" name="customer[address]" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="campo2">Bairro</label>
                        <input type="text" class="form-control" name="customer[hood]" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="campo3">CEP</label>
                        <input type="text" class="form-control" name="customer[zip_code]" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">Data de Cadastro</label>
                        <input type="text" class="form-control" name="customer[created]" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="campo1">Município</label>
                        <input type="text" class="form-control" name="customer[city]" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo2">Telefone</label>
                        <input type="text" class="form-control" name="customer[phone]" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">Celular</label>
                        <input type="text" class="form-control" name="customer[mobile]" required>
                    </div>

                    <div class="form-group col-md-1">
                        <label for="campo3">UF</label>
                        <input type="text" class="form-control" name="customer[state]" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">Inscrição Estadual</label>
                        <input type="text" class="form-control" name="customer[ie]" required>
                    </div>
                </div>

                <div id="actions" class="row mt-2">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
                        <a href="index.php" class="btn btn-light text-dark"><i class="fa-solid fa-eraser"></i> Cancelar</a>
                    </div>
                </div>
            </form>

<?php include(FOOTER_TEMPLATE); ?>