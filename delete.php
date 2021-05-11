<?php
    $id_deletar = $_POST['id_deletar'];
    
    $con = new mysqli('localhost', 'root', '', 'sa_') or die("Não foi possível conectar");
    if($con->connect_error){
        echo "<h2>Erro ao conectar</h2>";
    }else{
        echo "<h2>Conectado com sucesso</h2>";
    }
    
    $query="DELETE FROM cadastro WHERE id = $id_deletar";

    $resultado=$con->query($query);

    if($resultado){
        echo "<h2>Comando realizado com sucesso!</h2>";
    }else{
        echo "<h2>Erro ao enviar dados!</h2>";
    }
    $con->close();
?>