<?php

    include "header.php";
    include "conexaoBD.php";

    if(isset($_GET['idAnuncio'])){
        $idAnuncio = $_GET['idAnuncio'];

        //QUERY para buscar o anúncio e o nome do anunciante
        $buscarAnuncio = "SELECT anuncios.*, usuarios.nomeUsuario
                          FROM anuncios
                          INNER JOIN usuarios
                            ON anuncios.Usuarios_idUsuario = usuarios.idUsuario
                          WHERE anuncios.idAnuncio = $idAnuncio
                          ";

        //Executa a QUERY
        $resAnuncio = mysqli_query($conn, $buscarAnuncio);

        //Verifica se encontrou o anúncio
        if(mysqli_num_rows($resAnuncio) > 0){
            //Converte o resultado em array associativo
            $anuncio = mysqli_fetch_assoc($resAnuncio);
            //Guarda a categoria para buscar os produtos relacionados
            $categoriaAnuncio = $anuncio['categoriaAnuncio'];
            $idAnuncio        = $anuncio['idAnuncio'];
            $fotoAnuncio      = $anuncio['fotoAnuncio'];
            $tituloAnuncio    = $anuncio['tituloAnuncio'];
            $descricaoAnuncio = $anuncio['descricaoAnuncio'];
            $valorAnuncio     = $anuncio['valorAnuncio'];
            $dataAnuncio      = $anuncio['dataAnuncio'];
            $horaAnuncio      = $anuncio['horaAnuncio'];
            $statusAnuncio    = $anuncio['statusAnuncio'];
        }
        else{
            echo "<div class='alert alert-danger text-center'>Anúncio não encontrado!</div>";
            include "footer.php";
            exit();
        }
                
    }
    else{
        echo "<div class='alert alert-danger text-center'>ID do Anúncio não informado!</div>";
        include "footer.php";
        exit();
    }

?>

<style>
    .img-produto-principal {
        width: 100%;
        max-height: 600px;
        object-fit: contain;
    }

    .img-produto-relacionado {
        width: 100%;
        height: 180px;
        object-fit: contain;
        background-color: #f8f9fa;
        padding: 10px;
    }

    .titulo-relacionado {
        min-height:55px;
        overflow-wrap: break-word;
    }

    .card-relacionado {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-relacionado:hover {
        transform: translateY(-5px);
        box-shadow 0 8px 20px rgba(0,0,0,0.15);
    }

</style>

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="img-produto-principal mb-5 mb-md-0 <?php if($statusAnuncio == 'finalizado'){ echo 'imagem-finalizada'; } ?>"
                     src="<?php echo htmlspecialchars($fotoAnuncio); ?>"
                     alt="<?php echo htmlspecialchars($tituloAnuncio); ?>"
                     title="<?php echo htmlspecialchars($tituloAnuncio); ?>"
                />
            </div>
            <div class="col-md-6">
                <div class="small mb-1">
                    Categoria: <?php echo htmlspecialchars($categoriaAnuncio) ?>
                </div>
                <h1 class="display-5 fw-bolder">
                    <?php echo htmlspecialchars($tituloAnuncio) ?>
                </h1>
                <div class="fs-5 mb-5">
                    R$ <?php echo number_format($valorAnuncio, 2, ',', '.'); ?>
                </div>
                <p class="lead">
                    <?php echo htmlspecialchars($descricaoAnuncio); ?>
                </p>
                <p class="text-muted">
                    Anunciado por <strong><?php echo htmlspecialchars($anuncio['nomeUsuario']); ?></strong><br>
                    Publicado em <?php echo date('d/m/Y', strtotime($dataAnuncio)); ?>
                    às <?php echo date('H:i', strtotime($horaAnuncio)); ?>
                </p>

                <?php
                    if($anuncio['statusAnuncio'] == 'disponivel'){ //Verifica se o anúncio está disponível
                        if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){ //Verifica se há sessão ativa
                            if($_SESSION['idUsuario'] == $anuncio['Usuarios_idUsuario']){ //Verifica se o Anúncio pertence ao usuário logado
                                echo "
                                    <a href='formEditarAnuncio.php?idAnuncio=$idAnuncio' class='btn btn-outline-dark btn-lg mt-3'>
                                        <i class='bi bi-gear me-1'></i>
                                        Editar Anúncio
                                    </a>
                                ";
                            }
                            else{
                                echo "
                                    <a href='efetuarCompra.php?idAnuncio=$idAnuncio' class='btn btn-outline-dark btn-lg mt-3'>
                                        <i class='bi bi-cart-fill me-1'></i>
                                        Comprar
                                    </a>
                                ";
                            }
                        }
                        else{
                            echo "
                                <a href='formLogin.php' class='btn btn-outline-dark btn-lg mt-3'>
                                    <i class='bi bi-person me-1'></i>
                                    Acesse o sistema para efetuar a compra
                                </a>
                            ";
                        }
                    }
                    else{
                        echo "
                            <button class='btn btn-secondary btn-lg mt-3' disabled>
                                Anúncio Finalizado
                            </button>
                        ";
                    }
                    
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Seção de Anúncios Relacionados -->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="f2-bolder mb-4">Produtos Relacionados</h2>
        <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-5 row-cols-xl-4 justify-content-center">
            <?php
                $listarRelacionados = "
                    SELECT * FROM anuncios
                    WHERE categoriaAnuncio = '$categoriaAnuncio'
                    AND idAnuncio != $idAnuncio
                    AND statusAnuncio = 'disponivel'
                ";

                $resRelacionados = mysqli_query($conn, $listarRelacionados);

                if(mysqli_num_rows($resRelacionados) > 0){
                    while($relacionado = mysqli_fetch_assoc($resRelacionados)){
            ?>

            <div class="col mb-5">
                <a class="text-decoration-none text-dark" href="visualizarAnuncio.php?idAnuncio=<?php echo $relacionado['idAnuncio'] ?>" >
                    <div class="card h-100 card-relacionado">
                        <img class="card-img-top img-produto-relacionado"
                             src="<?php echo htmlspecialchars($relacionado['fotoAnuncio']); ?>"
                             alt="<?php echo htmlspecialchars($relacionado['tituloAnuncio']); ?>"
                             title="<?php echo htmlspecialchars($relacionado['tituloAnuncio']); ?>"
                        />
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder titulo-relacionado"><?php echo htmlspecialchars($relacionado['tituloAnuncio']); ?></h5>
                                <p class="text-muted-small"><?php echo htmlspecialchars($relacionado['categoriaAnuncio']) ?></p>
                                <p>R$ <?php echo number_format($relacionado['valorAnuncio'], 2, ',', '.'); ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                    }
                }
                else{
                    echo "<p class='text-center'>Nenhum produto relacionado encontrado.</p>";
                }
            ?>
        </div>
    </div>
</section>


<?php include "footer.php" ?>