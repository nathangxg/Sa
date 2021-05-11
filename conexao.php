<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    /* setando informações nas variaveis */
        $id = trim($_POST['id']);
        $nome_php = trim($_POST['nome']);
        $cpf_php = trim($_POST['cpf']);
        $email_php =$_POST['email'];
        $endereco_php = trim($_POST['endereco']);
        $lougradouro_php = trim($_POST['lougradouro']);
        $numero_php = trim($_POST['num']);
        $complemento_php = trim($_POST['complemento']);
        $cidade_php = trim($_POST['cidade']);
        $id_estado = trim($_POST['estado']);    
    ?>
    <h1>Dados do Formulário:</h1>
    <?php
        /* apresentando informaoçoes adicionadas */
        echo "<h3>Nome: </h3>";
        echo "<p>$nome_php</p>";

        echo "<h3>Cpf: </h3>";
        echo "<p>$cpf_php</p>";

        echo "<h3>Email: <h3>";
        echo "<p>$email_php<p>";

        echo "<h3>Endereço: </h3>";
        echo "<p>$endereco_php</p>";
        
        echo "<h3>Lougradouro: </h3>";
        echo "<p>$lougradouro_php</p>";

        echo "<h3>Número: </h3>";
        echo "<p>$numero_php</p>";

        echo "<h3>Complemento: </h3>";
        echo "<p>$complemento_php</p>";

        echo "<h3>Cidade: </h3>";
        echo "<p>$cidade_php</p>";

        echo "<h3>Estado: </h3>";
        echo "<p>$id_estado</p>";

        /* fazendo conexao */
        $con = new mysqli("localhost", "root", "", "sa_");
        if($con->connect_error){
            echo "<h2>Erro ao conectar</h2>";
        }else{
            echo "<h2>Conectado com sucesso</h2>";
        }
        $query="";
        
        /* selecionadno se e uma conexao para envio de dados ou atualização dos mesmos */
        if(isset($_POST['enviar'])){
        $query="INSERT INTO cadastro 
        VALUES(NULL, '$nome_php', '$cpf_php', '$email_php', '$endereco_php', '$lougradouro_php', '$numero_php', '$complemento_php', '$cidade_php', '$id_estado')";
        }else{
        $query ="UPDATE cadastro SET nome='$nome_php', cpf='$cpf_php',
        email='$email_php', endereco='$endereco_php', lougradouro='$lougradouro_php', numero ='$numero_php', complemento = '$complemento_php', cidade= '$cidade_php', id_estado='$id_estado' WHERE id=$id";
        }
        
        $resultado=$con->query($query);
        
        if($resultado){
            echo "<h2>Comando realizado com sucesso!</h2>";
        }else{
            echo "<h2>Erro ao enviar dados!</h2>";
        }
        $con->close();
    
    ?>
</body>

</html>