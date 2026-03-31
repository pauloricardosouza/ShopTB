<?php include "header.php" ?>

<section class="py-5">

    <div class="d-flex justify-content mt-3 mb-3">

        <div class="row">
            <div class="col">

                <?php
                    echo "<h3 class='text-center'>Listar Registros em uma TABELA:</h3>";

                    //Query para listar TODOS os registros da tabela Usuarios
                    $listarUsuarios = "SELECT * FROM Usuarios";

                    include "conexaoBD.php";
                    //A função mysqli_query() é responsável pela execução de comandos SQL no Banco de Dados
                    $res = mysqli_query($conn, $listarUsuarios) or die("Erro ao tentar listar Usuários!");
                    $totalUsuarios = mysqli_num_rows($res); //Usa a função mysqli_num_rows() para buscar o total de registros retornados pela QUERY

                    echo "<div class='alert alert-info text-center'>Há <strong>$totalUsuarios</strong> usuários cadastrados no sistema!</div>";

                    //Parte 1 - Montar o cabeçalho da tabela para exibir os registros
                    echo "
                        <table class='table'>
                            <thead class='table-dark'>
                                <tr>
                                    <th>ID</th>
                                    <th>FOTO</th>
                                    <th>NOME</th>
                                    <th>DATA DE NASCIMENTO</th>
                                    <th>CIDADE</th>
                                    <th>EMAIL</th>
                                </tr>
                            </thead>
                            <tbody>
                    ";

                    //Parte 2 - Enquanto houver registros, executa a função abaixo para armazenar em variáveis PHP
                    while($registro = mysqli_fetch_assoc($res)){
                        $idUsuario             = $registro['idUsuario'];
                        $fotoUsuario           = $registro['fotoUsuario'];
                        $nomeUsuario           = $registro['nomeUsuario'];
                        $dataNascimentoUsuario = $registro['dataNascimentoUsuario'];
                        $dia                   = substr($dataNascimentoUsuario, 8, 2);
                        $mes                   = substr($dataNascimentoUsuario, 5, 2);
                        $ano                   = substr($dataNascimentoUsuario, 0, 4);
                        $cidadeUsuario         = $registro['cidadeUsuario'];
                        $emailUsuario          = $registro['emailUsuario'];

                        //Parte 3 - Exibir os valores armazenados nas variáveis
                        echo "
                            <tr>
                                <td>$idUsuario</td>
                                <td><img src='$fotoUsuario' title='Foto de $nomeUsuario' style='width:100px'></td>
                                <td>$nomeUsuario</td>
                                <td>$dia/$mes/$ano</td>
                                <td>$cidadeUsuario</td>
                                <td>$emailUsuario</td>
                            </tr>
                        ";
                    }
                    //Parte 4 - Encerrar a tabela e a conexão com o BD.
                    echo "</tbody>";
                    echo "</table>";
                    mysqli_close($conn);
                ?>

            </div>
        </div>

    </div>

</section>

<?php include "footer.php" ?>