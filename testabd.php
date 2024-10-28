<?php 
    include 'config.php';
    include DBAPI;

    try{
        $db = open_database(); 
        echo "<h1>Conexão foi estabelecida ;)</h1>";
    } catch (Exception $e) {
        echo "<h1>ERRO: " . $e->getMessage()  . "</h1>";
    }


    /*
    
	$db = open_database(); 
	
	if ($db) {
		echo '<h1>Banco de Dados Conectado!</h1>';
	} else {
		echo '<h1>ERRO: Não foi possível Conectar!</h1>';
	}

    */
?>