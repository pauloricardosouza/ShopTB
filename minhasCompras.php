<?php include "header.php" ?>

<div class="container mt-3 mb-3">

    <?php
        //Verifica se há sessão iniciada
        if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){
            //Inclui conexão com o Banco de Dados
            include "conexaoBD.php";
            //Query para listar as compras do usuário logado
            $listarCompras = "
                SELECT 
                    Compras.idCompra,
                    Compras.dataCompra,
                    Compras.horaCompra,
                    Compras.valorCompra,

                    Anuncios.idAnuncio,
                    Anuncios.fotoAnuncio,
                    Anuncios.tituloAnuncio

                FROM Compras
                INNER JOIN Anuncios
                    ON Compras.Anuncios_idAnuncio = Anuncios.idAnuncio
                WHERE Compras.Usuarios_idUsuario = " . $_SESSION['idUsuario'] . "
                ORDER BY Compras.idCompra DESC
            ";

            //Executa a query
            $res = mysqli_query($conn, $listarCompras)
                   or die("Erro ao tentar listar compras!");

            //Captura a quantidade de registros retornados
            $totalCompras = mysqli_num_rows($res);

            //Exibe mensagem com total de compras
            if($totalCompras > 0){
                if($totalCompras == 1){
                    echo "
                        <div class='alert alert-info text-center'>
                            Você possui <strong>$totalCompras</strong> compra no sistema!
                        </div>
                    ";
                }
                else{
                    echo "
                        <div class='alert alert-info text-center'>
                            Você possui <strong>$totalCompras</strong> compras no sistema!
                        </div>
                    ";
                }
            }
            else{
                echo "
                    <div class='alert alert-info text-center'>
                        Você ainda <strong>não possui</strong> compras no sistema!
                    </div>
                ";
            }

            //Cabeçalho da tabela
            echo "
                <table class='table table-hover align-middle'>
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
                    <tbody>
            ";

            //Enquanto houver registros
            while($registro = mysqli_fetch_assoc($res)){

                //Armazena os dados em variáveis
                $idCompra      = $registro['idCompra'];
                $fotoAnuncio   = $registro['fotoAnuncio'];
                $tituloAnuncio = $registro['tituloAnuncio'];
                $dataCompra    = $registro['dataCompra'];
                $diaCompra     = substr($dataCompra, 8, 2);
                $mesCompra     = substr($dataCompra, 5, 2);
                $anoCompra     = substr($dataCompra, 0, 4);
                $horaCompra    = substr($registro['horaCompra'], 0, 5);
                $valorCompra   = $registro['valorCompra'];

                //Exibe os registros na tabela
                echo "
                    <tr>
                        <td>$idCompra</td>
                        <td>
                            <img 
                                src='$fotoAnuncio'
                                title='Foto de $tituloAnuncio'
                                style='width:100px'
                                class='img-thumbnail'
                            >
                        </td>
                        <td>$tituloAnuncio</td>
                        <td>$diaCompra/$mesCompra/$anoCompra</td>
                        <td>$horaCompra</td>
                        <td>
                            R$ " . number_format($valorCompra, 2, ',', '.') . "
                        </td>
                        <td>
                            <a href='#avaliarCompra.php?idCompra=$idCompra' title='Avaliar esta Compra'>
                                <i class='bi bi-list-stars' style='font-size:30px'></i>
                            </a>
                        </td>
                    </tr>
                ";
            }

            //Fecha tabela
            echo "
                    </tbody>
                </table>
            ";

            //Fecha conexão com banco
            mysqli_close($conn);
        }
        else{
            //Redireciona caso usuário não esteja logado
            header('location:index.php');
        }

    ?>

</div>

<?php include "footer.php" ?>