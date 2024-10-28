<?php

    // Configurações do banco de dados
    define('DB_HOST', 'localhost');
    define('DB_USER', 'usuario');
    define('DB_PASSWORD', 'senha');
    define('DB_NAME', 'nome_do_banco');

    // Retorna se houver erro
    function open_database()
    {
        try {
            $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
            return $conn;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    function close_database($conn)
    {
        try {
            $conn = null;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    function find($table = null, $id = null)
    {
        try {
            $database = open_database();
            $found = null;

            if ($id) {
                $sql = "SELECT * FROM $table WHERE id = :id";
                $stmt = $database->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                
                if ($stmt->rowCount() > 0) {
                    $found = $stmt->fetch(PDO::FETCH_ASSOC);
                }
                
            } else {
                $sql = "SELECT * FROM $table";
                $stmt = $database->prepare($sql);
                $stmt->execute();
                
                if ($stmt->rowCount() > 0) {
                    $found = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
        
        close_database($database);
        return $found;
    }

    function save($table = null, $data = null)
    {
        $database = open_database();
    
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    
        try {
            $stmt = $database->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
    
            $_SESSION['message'] = "Registro cadastrado com sucesso.";
            $_SESSION['type'] = "success";
        
        } catch (PDOException $e) { 
            $_SESSION['message'] = "Não foi possível realizar a operação.";
            $_SESSION['type'] = "danger";
        } 
    
        close_database($database);
    }

    function find_all($table)
    {
        return find($table);
    }

    function filter($table = null, $p = null)
    {
        $database = open_database();
        $found = null;

        try {
            if ($p) {
                $sql = "SELECT * FROM $table WHERE $p";
                $stmt = $database->prepare($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $found = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    throw new Exception("Não foram encontrados registros de dados!");
                }
            }
        } catch (PDOException $e) { 
            $_SESSION["message"] = "Ocorreu um erro: " . $e->getMessage();
            $_SESSION["type"] = "danger";
        }

        close_database($database);
        return $found;
    }

    function clear_messages()
    {
        $_SESSION['message'] = null;
        $_SESSION['type'] = null;
    }

    function criptografia($senha)
    {
        $custo = "08";
        $salt = "Cf1f11ePArKlBJomM0F6aJ";
        
        // Gera um hash baseado em bcrypt
        $hash = crypt($senha, "$2a$" . $custo . "$" . $salt . "$");

        return $hash;
    }

    function formatadata($date, $formato)
    {
        $dt = new DateTime($date, new DateTimeZone("America/Sao_Paulo"));
        return $dt->format($formato);
    }

    function formatacep($cep)
    {
        $cp = substr($cep, 0, 5) . "-" . substr($cep, 5);
        return $cp;
    }

    function formatatel($tel)
    {
        $tl = substr($tel, 0, 4) . "-" . substr($tel, 4);
        return $tl;
    }

    function formatacel($cell)
    {
        $cll = "(" . substr($cell, 0, 2) . ") " . substr($cell, 2 ,5) . "-" . substr($cell, 7);
        return $cll;
    }
?>
