        <?php
            include 'config.php';
            include DBAPI;
            if (!isset($_SESSION)) session_start(); 
            include(HEADER_TEMPLATE);
            $db = open_database();
        ?>
        <h1> <b class="text-danger">Hospital dos Desenvolvedores</b></h1>
        <hr>
        <div class="container-index">
            <?php if ($db) : ?>
                <div class="row mb-2 cards-index">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 links-index">
                        <a href="customers/add.php" class="btn btn-secondary">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <i class="fa-solid fa-user-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p>Novo Paciente</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 links-index">
                        <a href="customers" class="btn btn-light">
                            <div class="row">
                                <div class="col-xs-12 text-center text-dark">
                                    <i class="fa-solid fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p>Ver Pacientes</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row mb-2 cards-index">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 links-index">
                        <a href="enfe/add.php" class="btn btn-secondary mt-0">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <i class="fa-regular fa-hospital fa-5x"></i>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p>Novo Enfermeiro</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 links-index">
                        <a href="enfe" class="btn btn-light text">
                            <div class="row">
                                <div class="col-xs-12 text-center text-dark">
                                    <i class="fa-solid fa-user-nurse fa-5x"></i>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p>Enfermeiros</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <?php if (isset($_SESSION['user'])) : // Verifica se existe o usuário ?>
                    <?php if ($_SESSION['user'] == "admin") : // Verifica se está logado como admin ?>
                        <div class="row mb-2 cards-index">
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 links-index">
                                <a href="usuarios/add.php" class="btn btn-secondary">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <i class="fa-solid fa-user-tie fa-5x"></i>
                                        </div>
                                        <div class="col-xs-12 text-center">
                                            <p>Novo Usuário</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 links-index">
                                <a href="usuarios" class="btn btn-light">
                                    <div class="row cards-index">
                                        <div class="col-xs-12 text-center text-dark">
                                            <i class="fa-solid fa-users-gear fa-5x"></i>
                                        </div>
                                        <div class="col-xs-12 text-center">
                                            <p>Usuários</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else : ?>
                <!-- <div class="alert alert-danger" role="alert">
                    <p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
                </div> -->
                <?php if (!empty($_SESSION['message'])) : ?>
                    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                        <p><strong>ERRO:</strong> Não foi possível conectar ao Banco de Dados!<br>
                        <?php echo $_SESSION['message']; ?></p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php clear_messages(); ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>

<?php include(FOOTER_TEMPLATE); ?>