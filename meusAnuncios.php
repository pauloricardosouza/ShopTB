<?php include "header.php" ?>

    <div class="container mt-3 mb-3">

        <?php
            //Query para listar TODOS os registros da tabela Anuncios
            $listarAnuncios = "SELECT * FROM Anuncios WHERE Usuarios_idUsuario = " . $_SESSION['idUsuario'];

            include "conexaoBD.php";
            //A função mysqli_query() é responsável pela execução de comandos SQL no Banco de Dados
            $res = mysqli_query($conn, $listarAnuncios) or die("Erro ao tentar listar anúncios!");
            $totalAnuncios = mysqli_num_rows($res); //Usa a função mysqli_num_rows() para buscar o total de registros retornados pela QUERY

            if($totalAnuncios > 0){
                if($totalAnuncios == 1){
                    echo "<div class='alert alert-info text-center'>Você possui <strong>$totalAnuncios</strong> anúncio no sistema!</div>";
                }
                else{
                    echo "<div class='alert alert-info text-center'>Você possui <strong>$totalAnuncios</strong> anúncios no sistema!</div>";
                }
            }
            else{
                echo "<div class='alert alert-info text-center'>Você ainda <strong>não possui</strong> anúncios no sistema!</div>";
            }
            //Parte 1 - Montar o cabeçalho da tabela para exibir os registros
            echo "
                <table class='table'>
                    <thead class='table-dark'>
                        <tr>
                            <th>ID</th>
                            <th>FOTO</th>
                            <th>TÍTULO</th>
                            <th>DATA</th>
                            <th>HORA</th>
                            <th>VALOR</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>";

                        //Parte 2 - Enquanto houver registros, executa a função abaixo para armazenar em variáveis PHP
                        while($registro = mysqli_fetch_assoc($res)){
                            $idAnuncio             = $registro['idAnuncio'];
                            $fotoAnuncio           = $registro['fotoAnuncio'];
                            $tituloAnuncio         = $registro['tituloAnuncio'];
                            $dataAnuncio           = $registro['dataAnuncio'];
                            $diaAnuncio            = substr($dataAnuncio, 8, 2);
                            $mesAnuncio            = substr($dataAnuncio, 5, 2);
                            $anoAnuncio            = substr($dataAnuncio, 0, 4);
                            $horaAnuncio           = $registro['horaAnuncio'];
                            $valorAnuncio          = $registro['valorAnuncio'];
                            $statusAnuncio         = $registro['statusAnuncio'];

                            //Parte 3 - Exibir os valores armazenados nas variáveis
                            echo "
                                <tr>
                                    <td>$idAnuncio</td>
                                    <td><img src='$fotoAnuncio' title='Foto de $tituloAnuncio' style='width:100px'></td>
                                    <td>$tituloAnuncio</td>
                                    <td>$diaAnuncio/$mesAnuncio/$anoAnuncio</td>
                                    <td>$horaAnuncio</td>
                                    <td>$valorAnuncio</td>
                                    <td>";
                                        if ($statusAnuncio == 'disponivel'){
                                            echo "<a href='visualizarAnuncio.php?idAnuncio=$idAnuncio' title='Visualizar este anúncio'><i class='bi bi-eye' style='font-size:30px'></i></a></td>";
                                        }
                                        else{
                                            echo "Anúncio Finalizado";
                                        }
                                    echo "</td>
                                </tr>
                            ";
                        }
                        //Parte 4 - Encerrar a tabela e a conexão com o BD.
                    echo "</tbody>";
            echo "</table>";
            mysqli_close($conn);
        ?>

    </div>

</section>

<?php include "footer.php" ?>