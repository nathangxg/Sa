<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Situação de Aprendizagem</title>
</head>
<header>
    <h1>Cadastro Senai
</header>

<body>
    <div id="body_layout">
        <div>
            <?php

            $flag = 0;
            /* conexao para select estado */
            $con = new mysqli('localhost', 'root', '', 'sa_') or die("Erro ao conectar");
            $query = "SELECT * FROM tb_estado";
            $resultado_estado = $con->query($query);
            foreach ($resultado_estado as $res) {
                $array_estado[] = $res;
            }

            $resultado_estado->free_result();
            $con->close();

            /* conexao para pesquisa */
            if (isset($_POST['pesquisa'])) {
                $id = $_POST['pesquisar'];
                $flag = 1;
                $con = new mysqli('localhost', 'root', '', 'sa_')
                    or die("Não foi possível conectar");

                $query = "SELECT * FROM cadastro WHERE id = $id";

                /* adicionado resultado da pesquisa nos inputs */
                $resultado = $con->query($query);
                if ($resultado->num_rows > 0) {
                    foreach ($resultado as $res) {
                        $id = $res['id'];
                        $name_php = $res['nome'];
                        $cpf_php = $res['cpf'];
                        $email_php = $res['email'];
                        $endereco_php = $res['endereco'];
                        $lougradouro_php = $res['lougradouro'];
                        $numero_php = $res['numero'];
                        $complemento_php = $res['complemento'];
                        $cidade_php = $res['cidade'];
                        $id_estado = $res['id_estado'];
                    }
                }
            }
            ?>
            <fieldset>
                <div id="pesquisa_display" class="lay">
                    <form action="#" method="post">
                        <label for="pesquisar">Pesquisar cadastro:</label>
                        <input type="text" name="pesquisar" id="pesquisar" placeholder="Entre com um id...">
                        <input type="submit" name="pesquisa" value="Pesquisar">
                    </form>
                </div>
            </fieldset>
            <br>
            <fieldset>
                <form action="conexao.php" method="post">

                    <div id="loguin">
                        <input type="hidden" name="id" id="id" value="<?= isset($id) ? $id : '' ?>" size="15">
                        <br><br>
                        <label for="nome">Nome: </label>
                        <input type="text" name="nome" id="nome" value="<?= isset($name_php) ? $name_php : '' ?>">
                        <br><br>
                        <label for="cpf">Cpf: </label>
                        <input type="text" name="cpf" id="cpf" value="<?= isset($cpf_php) ? $cpf_php : '' ?>" placeholder="Apenas numeros..." maxlength="11">
                        <br><br>
                        <label for="email">Email: </label>
                        <input type="text" name="email" id="email" value="<?= isset($email_php) ? $email_php : '' ?>">
                        <br><br>
                        <label for="endereco">Endereço: </label>
                        <input type="text" name="endereco" id="endereco" value="<?= isset($endereco_php) ? $endereco_php : '' ?>">
                        <br><br>
                        <label for="lougradouro">Lougradouro: </label>
                        <select name="lougradouro" id="lougradouro">
                            <option value="casa">Casa</option>
                            <option value="apartamento">Apartamento</option>
                            <option value="barraco">Barraco</option>
                        </select>
                        <br><br>
                        <label for="numero">Numero: </label>
                        <input type="text" name="num" id="num" value=" <?= isset($numero_php) ? $numero_php : '' ?>">
                        <label for="complemento">Complemento: </label>
                        <input type="text" name="complemento" value=" <?= isset($complemento_php) ? $complemento_php : '' ?>">
                        <br><br>
                        <label for="cidade">Cidade: </label>
                        <input type="text" name="cidade" id="cidade" value="<?= isset($cidade_php) ? $cidade_php : '' ?>">
                        <label for="estado">Estado: </label>
                        <select name="estado" id="estado">

                            <?php foreach ($array_estado as $est) : ?>
                                <option value="<?= $est['id'] ?>" <?= isset($id_estado) && $est['id'] == $id_estado ? 'selected' : '' ?>><?= $est['sigla_estado'] ?></option>
                            <?php endforeach ?>

                        </select>

                    </div>

                    <br>



                    <?php

                    switch ($flag) {
                        case 0:
                            echo "<div id='env'> <input type='submit' name='enviar' value='Enviar'> </div>";
                            break;

                        case 1:
                            echo "<div id='alter'> <input type='submit' name='alterar' value='Alterar'> </div>";
                            break;
                    }
                    ?>

                </form>
            </fieldset>
            <br>
            <fieldset>
                <div id="del_layout" class="lay">
                    <form action="delete.php" method="POST">
                        <label for="id_deletar">Selecione um id de aluno para deletar</label>
                        <input type="text" name="id_deletar" id="id_deletar"><br>
                        <input type="submit" value="Deletar">
                    </form>
                </div>
            </fieldset>
        </div>
        <br>
        <fieldset>

            <?php
            $con = new mysqli('localhost', 'root', '', 'sa_')
                or die("Não foi possível conectar");

            $query_t = "SELECT id, nome, cpf, email FROM cadastro";

            $table = $con->query($query_t);

            $con2 = new mysqli('localhost', 'root', '', 'sa_')
                or die("Não foi possível conectar");

            $query_t2 = "SELECT nome, endereco, lougradouro, numero, complemento, cidade FROM cadastro";

            $table2 = $con2->query($query_t2);

            ?>
            <div>
                <h2>Tabela de cada aluno cadastrado com seus dados:</h2>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                    </tr>
                    <tr>
                        <?php
                        if ($table->num_rows > 0) {
                            while ($row = $table->fetch_assoc()) {
                                echo "<tr><td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['nome'] . "</td>";
                                echo "<td>" . $row['cpf'] . "</td>";
                                echo "<td>" . $row['email'] . "</td></tr>";
                            }
                        }
                        ?>
                    </tr>
                </table>
                <br>

                <h2>Tabela de endereço de cada aluno cadastrado:</h2>
                <table border="1">
                    <tr>
                        <th>Nome</th>
                        <th>Endereco</th>
                        <th>Lougradouro</th>
                        <th>Numero</th>
                        <th>Complemento</th>
                        <th>Cidade</th>
                    </tr>
                    <tr>
                        <?php
                        if ($table2->num_rows > 0) {
                            while ($row = $table2->fetch_assoc()) {
                                echo "<tr><td>" . $row['nome'] . "</td>";
                                echo "<td>" . $row['endereco'] . "</td>";
                                echo "<td>" . $row['lougradouro'] . "</td>";
                                echo "<td>" . $row['numero'] . "</td>";
                                echo "<td>" . $row['complemento'] . "</td>";
                                echo "<td>" . $row['cidade'] . "</td></tr>";
                            }
                        }
                        ?>
                    </tr>
                </table>

            </div>

        </fieldset>
        <br>
</body>

</html>