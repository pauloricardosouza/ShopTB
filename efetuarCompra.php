<?php include "header.php" ?>

<div class="container mt-3 mb-3">

    <?php
        if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){ //Verifica se há sessão ativa
            if(isset($_GET['idAnuncio'])){ //Verifica se há algum parâmetro idAnuncio sendo recebido por GET
                $idUsuario = $_SESSION['idUsuario']; //Captura o id do usuário logado
                $idAnuncio = $_GET['idAnuncio']; //Armazena o id do anúncio que foi recebido por GET

                include "conexaoBD.php"; //Inclui a conexão com o banco de dados
                //Cria a query para buscar os dados do anúncio através do ID
                $buscarAnuncio = "SELECT * FROM Anuncios WHERE idAnuncio = $idAnuncio";
                $resultado     = mysqli_query($conn, $buscarAnuncio);

                if(mysqli_num_rows($resultado) > 0){ //Verifica se encontrou o anúncio
                    $anuncio = mysqli_fetch_assoc($resultado); //Converte o resultado em um array associativo

                    //Armazena os dados do array associativo em variáveis
                    $fotoAnuncio   = $anuncio['fotoAnuncio'];
                    $tituloAnuncio = $anuncio['tituloAnuncio'];
                    $valorCompra   = $anuncio['valorAnuncio'];

                    //Captura a data e hora atuais
                    $dataCompra    = date('Y-m-d');
                    $horaCompra    = date('H:i:s');

                    //Cria a QUERY para inserir a compra
                    $inserirCompra = "INSERT INTO Compras (Usuarios_idUsuario, Anuncios_idAnuncio, dataCompra, horaCompra, valorCompra)
                                      VALUES ($idUsuario, $idAnuncio, '$dataCompra', '$horaCompra', $valorCompra)";

                    //Cria a QUERY que atualiza o status do Anúncio
                    $atualizarStatusAnuncio = "
                        UPDATE Anuncios
                        SET statusAnuncio = 'finalizado'
                        WHERE idAnuncio = $idAnuncio
                    ";

                    //Executa o INSERT
                    if(mysqli_query($conn, $inserirCompra)){
                        //Executa UPDATE no statusAnuncio
                        if(mysqli_query($conn, $atualizarStatusAnuncio)){
                            echo "
                                <div class='alert alert-success text-center'>
                                    Você comprou $tituloAnuncio! <i class='bi bi-emoji-smile'></i>
                                </div>

                                <div class='container mt-3 mb-5'>
                                    <div class='mt-3 text-center'>
                                        <img src='$fotoAnuncio' style='width:300px' title='Foto de $tituloAnuncio'>
                                    </div>
                                </div>
                            ";
                        }
                        else{
                            echo "
                                <div class='alert alert-danger text-center'>
                                    Erro ao tentar atualizar o status do anúncio!<i class='bi bi-emoji-frown'></i>
                                </div>
                            ";
                        }
                    }
                    else{
                        echo "
                            <div class='alert alert-danger text-center'>
                                Erro ao tentar efetuar a compra!<i class='bi bi-emoji-frown'></i>
                            </div>
                        ";
                    }
                }
                else{
                    echo "
                        <div class='alert alert-warning text-center'>
                            Anúncio não encontrado!<i class='bi bi-emoji-frown'></i>
                        </div>
                    ";
                }
            }
            else{
                header("location:index.php");
            }
        }
        else{
            header("location:index.php");
        }
    ?>

</div>

<?php include "footer.php" ?>