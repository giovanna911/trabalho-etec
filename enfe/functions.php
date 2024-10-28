<?php
ob_start();

    include("../config.php");
    include(DBAPI);

    $enfermeiros = null;
    $enfermeiro = null;

    
    // Listagem de Usuários

    function index() {
        global $enfermeiros;
        if (!empty($_POST['enfermeiro'])) {
            $enfermeiros = filter("enfermeiros", "nome like '%" . $_POST['enfermeiro'] . "%'");
        } else {
            $enfermeiros = find_all("enfermeiros");
        }
    }

    

    // Upload de imagens

    function upload ($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo) {
        try {
            $nomearquivo = basename($arquivo_destino);
            $uploadOk = 1;
            if(isset($_POST["submit"])) {
                $check = getimagesize($nome_temp);
                if($check !== false) {
                    $_SESSION['message'] = "File is an image - " . $check["mime"] . ".";
                    $_SESSION['type'] = "info";
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                    throw new Exception("O arquivo não é uma imagem!");
                }
            }

            if (file_exists($arquivo_destino)) {
                $uploadOk = 0;
                throw new Exception("Desculpe, mas o arquivo já existe!");
            }

            if ($tamanho_arquivo > 5000000) {
                $uploadOk = 0;
                throw new Exception("Desculpe, mas o arquivo é muito grande!");
            }

            if ($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg" && $tipo_arquivo != "gif") {
                $uploadOk = 0;
                throw new Exception("Desculpe, mas só são permitidos arquivos de imagem JPG, PNG, JPEG E GIF!");
            }

            if ($uploadOk == 0) {
                throw new Exception("Desculpe, mas o arquivo não pode ser enviado!");
            } else {
                if (move_uploaded_file($_FILES["foto"] ["tmp_name"], $arquivo_destino)) {
                    $_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . " foi armazenado.";
                    $_SESSION["type"] = "success";
                } else {
                    throw new Exception("Desculpe, mas o arquivo não pode ser enviado!");
                }
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu algum erro: " . $e->getMessage();
            $_SESSION["type"] = "danger";
        }
    }
    
    //  Cadastro de Usuários

    /**
     * Add vai receber o post do navegador e salvar o item
     */
    function add() {

        if (!empty($_POST['enfermeiros'])) {
            try {
                $enfermeiros = $_POST['enfermeiros'];

                $today = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));

                if(!empty($_FILES["foto"]["name"])) {
                    // Upload de Foto
                    $pasta_destino = "fotos/";
                    $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
                    $nomearquivo = basename($_FILES["foto"]["name"]); 
                    $resolucao_arquivo = getimagesize($_FILES["foto"]["tmp_name"]);
                    $tamanho_arquivo = $_FILES["foto"] ["size"];
                    $nome_temp = $_FILES["foto"] ["tmp_name"];
                    $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));

                    // Chamada da função upload para gravar a imagem
                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

                    $enfermeiros["foto"] = $nomearquivo;
                }
                else {
                    $enfermeiros["foto"] = "semimagem.png";
                }

                save('enfermeiros', $enfermeiros);
                return header("Location: index.php");
            } catch (Exception $e) {
                $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
                $_SESSION['type'] = "danger";
            }
        }
    }

    // Atualizacao/Edicao de Usuário
    

    function edit() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Obtém o enfermeiro atual do banco de dados
            $enfermeiro = find("enfermeiros", $id);
            $fotoAntiga = $enfermeiro['foto']; // Armazena a foto antiga
    
            if (isset($_POST['enfermeiros'])) {
                $enfermeiros = $_POST['enfermeiros'];
    
                if (!empty($_FILES['foto']['name'])) {
                    $pasta_destino = "fotos/";
                    $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
                    $nomearquivo = basename($_FILES["foto"]["name"]);
                    $resolucao_arquivo = getimagesize($_FILES["foto"]["tmp_name"]);
                    $tamanho_arquivo = $_FILES["foto"]["size"];
                    $nome_temp = $_FILES["foto"]["tmp_name"];
                    $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));
    
                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
    
                    // Exclui a foto antiga
                    if ($fotoAntiga && file_exists($pasta_destino . $fotoAntiga)) {
                        unlink($pasta_destino . $fotoAntiga);
                    }
    
                    $enfermeiros['foto'] = $nomearquivo;
                } else {
                    // Se nenhuma nova foto foi enviada, mantém a foto antiga
                    $enfermeiros['foto'] = $fotoAntiga;
                }
    
                update("enfermeiros", $id, $enfermeiros);
                header("location: index.php");
            } else {
                global $enfermeiros;
                $enfermeiros = find("enfermeiros", $id);
            }
        } else {
            header("location: index.php");
        }
    }
    

    //  Visualização de um Usuário

    function view($id = null) {
        global $enfermeiros;
        $enfermeiros = find("enfermeiros", $id);
    }

    // Exclusão de um Usuário
  
    function delete($id = null) {
    
        global $enfermeiros;
        $enfermeiros = remove("enfermeiros", $id);
    
        header("location: index.php");
    }
?>