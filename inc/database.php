<?php

    mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR); 
    // Retornando se houver erro

    function open_database()
    {
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            $conn->set_charset("utf8"); // Código para formatação utf-8;
            return $conn;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    function close_database($conn)
    {
        try {
            mysqli_close($conn);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    function find( $table = null, $id = null ) {
        try {
            $database = open_database();
            $found = null;

            if ($id) {
                $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
                $result = $database->query($sql);
                
                if ($result->num_rows > 0) {
                    $found = $result->fetch_assoc();
                }
                
            } else {
                $sql = "SELECT * FROM " . $table;
                $result = $database->query($sql);
                
                if ($result->num_rows > 0) {
                    // $found = $result->fetch_all(MYSQLI_ASSOC);
                    
                    // Metodo alternativo

                    $found = array();
                    while ($row = $result->fetch_assoc()) {
                        array_push($found, $row);
                    }
                }
            }
        } catch (Exception $e) {
            $_SESSION['message'] = $e->GetMessage();
            $_SESSION['type'] = 'danger';
        }
        
        close_database($database);
        return $found;
    }    

    // Insere um registro no BD

    function save ($table = null, $data = null) {

        $database = open_database();
    
        $columns = null;
        $values = null;
    
        foreach ($data as $key => $value) {
            $columns .= trim($key, "'") . ",";
            $values .= "'$value',";
        }
    
        // remove a ultima virgula
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');
        
        $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
    
        try {
            $database->query($sql);
    
            $_SESSION['message'] = "Registro cadastrado com sucesso.";
            $_SESSION['type'] = "success";
        
        } catch (Exception $e) { 
            $_SESSION['message'] = "Nao foi possivel realizar a operacao.";
            $_SESSION['type'] = "danger";
        } 
    
        close_database($database);
    }

    // Atualiza um registro em uma tabela, por ID
    
    function update($table = null, $id = 0, $data = null) {

        $database = open_database();
    
        $items = null;
    
        foreach ($data as $key => $value) {
            $items .= trim($key, "'") . "='$value',";
        }
    
        // remove a ultima virgula
        $items = rtrim($items, ',');
    
        $sql  = "UPDATE " . $table;
        $sql .= " SET $items";
        $sql .= " WHERE id=" . $id . ";";
    
        try {
            $database->query($sql);
        
            $_SESSION['message'] = "Registro atualizado com sucesso.";
            $_SESSION['type'] = "success";
    
        } catch (Exception $e) { 
            $_SESSION['message'] = "Nao foi possivel realizar a operacao.";
            $_SESSION['type'] = "danger";
        } 
    
        close_database($database);
    }

    // Remove uma linha de uma tabela pelo ID do registro
    
    function remove( $table = null, $id = null ) {
    
        $database = open_database();
        
        try {
            if ($id) {
        
                $sql = "DELETE FROM " . $table . " WHERE id = " . $id;
                $result = $database->query($sql);
        
                if ($result = $database->query($sql)) {   	
                    $_SESSION['message'] = "Registro Removido com Sucesso.";
                    $_SESSION['type'] = 'success';
                }
            }
        } catch (Exception $e) { 
    
            $_SESSION['message'] = $e->GetMessage();
            $_SESSION['type'] = 'danger';
        }
    
        close_database($database);
    }

    // Excluir Mensagem

    function clear_messages() {
        $_SESSION['message'] = null;
        $_SESSION['type'] = null;
    }

    function filter ($table = null, $p = null) {
        $database = open_database();
        $found = null;

        try {
            if ($p) {
                $sql = "SELECT * FROM " . $table . " WHERE " . $p;
                $result = $database->query($sql);
                if ($result -> num_rows > 0) {
                    $found = array();
                    while($row = $result -> fetch_assoc()) {
                        array_push($found, $row);
                    }
                } else {
                    throw new Exception("Não foram encontrados registrados de dados!");
                }
            }
        } catch (Exception $e) { 
            $_SESSION["message"] = "Ocorreu um erro: " . $e->getMessage();
            $_SESSION["type"] = "danger";
        }

        close_database($database);
        return $found;
    }


    function criptografia($senha) {
        $custo = "08";
        $salt = "Cf1f11ePArKlBJomM0F6aJ";
        
        // Gera um hash baseado em bcrypt
        $hash = crypt($senha, "$2a$" . $custo . "$" . $salt . "$");

        return $hash;
    }

    // Pesquisa Todos os Registros de uma Tabela

    function find_all( $table ) {
        return find($table);
    }

    // Formata as datas do projeto
    function formatadata( $date, $formato ) {
        $dt = new DateTime ( $date, new DateTimeZone("America/Sao_Paulo"));
        return $dt -> format($formato);
    }

    // Formata CEP
    function formatacep( $cep ) {
        $cp = substr($cep, 0, 5) . "-" . substr($cep, 5);
        return $cp;
    }
    
    // Formata TEL
    function formatatel( $tel ) {
        $tl = substr($tel, 0, 4) . "-" . substr($tel, 4);
        return $tl;
    }

    // Formata CELL
    function formatacel( $cell ) {
        $cll = "(" . substr($cell, 0, 2) . ") " . substr($cell, 2 ,5) . "-" . substr($cell, 7);
        return $cll;
    }

?>