<?php
    include("../config.php");
    include(DBAPI);
    include(PDF);
    

    $usuarios = null;
    $usuario = null;

    
    // Listagem de Usuários

    function index() {
        global $usuarios;
        if (!empty($_POST['users'])) {
            $usuarios = filter("usuarios", "nome like '%" . $_POST['users'] . "%'");
        } else {
            $usuarios = find_all("usuarios");
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

    function add() {

        if (!empty($_POST['usuario'])) {
            try {
            $usuario = $_POST['usuario'];
            
            if(!empty($_FILES["foto"] ["name"])) {
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

                $usuario["foto"] = $nomearquivo;
            }
            else {
                $usuario["foto"] = "semimagem.png";
            }

            if (!empty($usuario["password"])) {
                $senha = criptografia($usuario['password']);
                $usuario['password'] = $senha;
            }
            

            save('usuarios', $usuario);
            header("Location: index.php");
            } catch (Exception $e) {
                $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
                $_SESSION['type'] = "danger";
            }
        }
    }

    // Atualizacao/Edicao de Usuário

    function edit() {
        try {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
    
                // Obtendo o valor da senha na tabela de usuários e armazenando-o em uma variável.
                $usuario = find("usuarios", $id);
                $senhaDoBanco = $usuario['password'];
                $fotoAntiga = $usuario['foto']; // Obtenha a foto antiga
                
                if (isset($_POST['usuario'])) {
                    $usuario = $_POST['usuario'];
                    
                    // Se a senha foi fornecida no formulário, atualize-a
                    if (isset($usuario['password']) && !empty($usuario['password'])) {
                        $senhaNova = criptografia($usuario['password']);
    
                        // Se a nova senha for diferente da senha do banco, atualize-a
                        if ($senhaNova != $senhaDoBanco) {
                            $usuario['password'] = $senhaNova;
                        } else {
                            // Se a senha fornecida for igual à senha armazenada no banco, preserve a senha existente no banco de dados.
                            $usuario['password'] = $senhaDoBanco;
                        }
                    } else {
                        // Se a senha não foi fornecida, mantenha a senha do banco
                        $usuario['password'] = $senhaDoBanco;
                    }
    
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
    
                        $usuario['foto'] = $nomearquivo;
                    } else {
                        // Se nenhuma nova foto foi enviada, mantenha a foto antiga
                        $usuario['foto'] = $fotoAntiga;
                    }
    
                    update("usuarios", $id, $usuario);
                    header("Location: index.php");
                } else {
                    global $usuario;
                    $usuario = find("usuarios", $id);
                } 
            } else {
                header("location: index.php");
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    }
    
    //  Visualização de um Usuário

    function view($id = null) {
        global $usuario;
        $usuario = find("usuarios", $id);
    }

    // Exclusão de um Usuário
  
    function delete($id = null) {
    
        if (isset($_GET['id'])){
            remove("usuarios", $_GET['id']);
        }
    
        header("location: index.php");
    }


    

    function pdf($p = null) {
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 12);

        // Cabeçalho da tabela
        $header = array('ID', 'Nome', 'Usuario (login)', 'Foto');
        
        // Obter os dados dos usuários
        $usuarios = null;
        if ($p) {
            $usuarios = filter("usuarios", "nome like '%" . $p . "%'");
        } else {
            $usuarios = find_all("usuarios");
        }

        // Gerar a tabela
        $pdf->ImprovedTable($header, $usuarios);
        $pdf->Output();
    }

	
	




    // function pdf($usuarios = null) {
    //     if ($usuarios === null) {
    //         // Obtém todos os usuários se não foram passados como argumento
    //         $usuarios = findAllUsers();
    //     }
        
    //     class PDF extends FPDF {
    //         // Cabeçalho
    //         function Header() {
    //             $this->SetFont('Arial', 'B', 12);
    //             $this->Cell(0, 10, 'Lista de Usuários', 0, 1, 'C');
    //             $this->Ln(5);
    //         }
            
    //         // Rodapé
    //         function Footer() {
    //             $this->SetY(-15);
    //             $this->SetFont('Arial', 'I', 8);
    //             $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    //         }
    //     }

    //     $pdf = new PDF();
    //     $pdf->AddPage();
    //     $pdf->SetFont('Arial', 'B', 12);

    //     // Cabeçalhos das colunas
    //     $pdf->Cell(10, 10, 'ID', 1);
    //     $pdf->Cell(60, 10, 'Nome', 1);
    //     $pdf->Cell(60, 10, 'Usuário', 1);
    //     $pdf->Cell(60, 10, 'Foto', 1);
    //     $pdf->Ln();

    //     // Dados
    //     $pdf->SetFont('Arial', '', 12);
    //     foreach ($usuarios as $usuario) {
    //         $pdf->Cell(10, 10, $usuario['id'], 1);
    //         $pdf->Cell(60, 10, $usuario['nome'], 1);
    //         $pdf->Cell(60, 10, $usuario['user'], 1);
    //         if (!empty($usuario['foto'])) {
    //             $fotoPath = "fotos/" . $usuario['foto'];
    //             if (file_exists($fotoPath)) {
    //                 $pdf->Cell(60, 10, $pdf->Image($fotoPath, $pdf->GetX(), $pdf->GetY(), 10), 0, 0, 'C', false);
    //             } else {
    //                 $pdf->Cell(60, 10, 'semimagem.png', 1);
    //             }
    //         } else {
    //             $pdf->Cell(60, 10, 'semimagem.png', 1);
    //         }
    //         $pdf->Ln();
    //     }

    //     $pdf->Output('D', 'usuarios.pdf');
    // }

?>