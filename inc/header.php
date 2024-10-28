<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CRUD | Enfermeiros</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
        <link rel="shortcut icon" href="<? echo BASEURL; ?>" type="image/png">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }

            .btn-light {
                background-color: #ccc;
                border-color: #ccc;
                transition: 0.5s;
            }

            .btn {
                transition: 0.5s;
            }


            .btn-light:hover {
                background-color: #999;
                border-color: #999;
            }
        </style>
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-dark fixed-top" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="<?php echo BASEURL; ?>"><i class="fa-solid fa-house"></i> Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-users"></i> Pacientes
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers"><i class="fa-solid fa-users"></i> Gerenciar Pacientes</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i class="fa-solid fa-user-plus"></i> Novo Paciente</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user-nurse"></i> Enfermeiros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo BASEURL; ?>enfe"><i class="fa-solid fa-laptop-medical"></i> Gerenciar os Enfermeiros</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASEURL; ?>enfe/add.php"><i class="fa-solid fa-user-doctor"></i> Adicionar Enfermeiros</a></li>
                            </ul>
                        </li>
                        <!-- Usuários -->
                        <?php if (isset($_SESSION['user'])) : //Verifica se está logado ?>
                            <?php if ($_SESSION['user'] == "admin") : //Verifica se está logado como admin ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-users-gear"></i> Usuários 
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios"><i class="fa-solid fa-users-gear"></i> Gerenciar o Usuários</a></li>
                                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios/add.php"><i class="fa-solid fa-user-tie"></i> Novo Usuário</a></li>
                                    </ul>
                                </li>
                                
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASEURL; ?>criadores.php">
                                    <i class="fa-solid fa-people-group"></i> Criadores
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASEURL . "usuarios/view.php?id=" . $_SESSION['id'] ?>">Bem vindo <?php echo $_SESSION['user'] ?>!</a>
                            </li>
                            
                            </ul>
                            <style>
                                .text-secondary:hover .nav-link {
                                    color: #eee;
                                    transition: .5s;
                                    background-color: #6c757d !important;
                                }
                            </style>
                            <div class="text-secondary">
                                <a class="nav-link border pt-1 pb-1 ps-3 pe-3 rounded" href="<?php echo BASEURL; ?>inc/logout.php">
                                    <i class="fa-solid fa-plug-circle-xmark"></i> Desconectar
                                </a>
                            </div>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASEURL; ?>criadores.php">
                                    <i class="fa-solid fa-people-group"></i> Criadores
                                </a>
                            </li>
                            <div class="">
                                <a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php">
                                    <i class="fa-solid fa-right-to-bracket"></i> Login
                                </a>
                            </div>
                        <?php endif; ?>
                            

                </div>
            </div>
        </nav>
        <main class="container">
            <br>