<?php include "header.php" ?>

<?php include "conexaoBD.php" ?>

<?php

    //Recebe o valor do filtro via método GET
    $filtroAnuncio = $_GET['statusAnuncio'] ?? 'todos';
    
    //Query para para consulta SQL a ser realizada
    if($filtroAnuncio == 'todos'){
        $listarAnuncios = "SELECT * FROM Anuncios";
    }
    else{
        $listarAnuncios = "SELECT * FROM Anuncios WHERE statusAnuncio = '$filtroAnuncio' ";
    }

    //Executa a query para consulta no BD
    $res = mysqli_query($conn, $listarAnuncios);
    
?>

<style>

    /* Remove sublinhado dos links e manter a cor padrão */
    .card-link {
        text-decoration: none;
        color: inherit;
    }

    /* Aplica um efeito suave no hover do card */
    .card-hover {
        position: relative;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
    }

    /* Efeito ao passar o mouse */
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    /* Camada escura que aparece no hover (overlay) */
    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    /* Torna o overlay visível no hover */
    .card-hover:hover .card-overlay {
        opacity: 1;
    }

</style>


<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">

        <!-- Formulário para Filtrar os Anúncios -->
        <form method="get" class="mb-5" action="index.php">
            <div class="row justify-content-center">
                <div class="col-md-4">

                    <select name="statusAnuncio" class="form-select">

                        <option value="todos" <?php if($filtroAnuncio == 'todos'){echo "selected";} ?> >Exibir todos os anúncios</option>
                        <option value="disponivel" <?php if($filtroAnuncio == 'disponivel'){echo "selected";} ?> >Exibir apenas anúncios disponíveis</option>
                        <option value="finalizado" <?php if($filtroAnuncio == 'finalizado'){echo "selected";} ?> >Exibir apenas anúncios finalizados</option>

                    </select>
                    
                    <button type="submit" class="btn btn-outline-dark mt-3" style="float:right"><i class="bi bi-funnel"></i>
                        Filtrar Anúncios
                    </button>

                </div>
            </div>
        </form>

        <?php
            $totalAnuncios = mysqli_num_rows($res);
            echo "<div class='alert alert-info text-center'>Há <strong>$totalAnuncios</strong> anúncios em nosso sistema!</div>";
        ?>

        
    
        <!-- GRID DE CARDS -->
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <?php

                //Verifica se a consulta retornou resultados
                if (mysqli_num_rows($res) > 0){

                    //Enquanto houver anúncios, exibirá os cards
                    while($anuncio = mysqli_fetch_assoc($res)){
                        
            ?>

            <div class="col mb-5">

                <!-- Link que torna todo o card clicável -->
                <a class="card-link" href="visualizarAnuncio.php">
                    <div class="card h-100 card-hover">

                        <!-- Overlay exibido ao passar o mouse -->
                        <div class="card-overlay">
                            <i class="bi bi-eye me-2"></i> Visualizar Anúncio
                        </div>

                        <!-- Imagem do Anúncio -->
                        <img class="card-img-top"
                             src="<?php echo htmlspecialchars($anuncio['fotoAnuncio']) ?>"
                             alt="<?php echo htmlspecialchars($anuncio['tituloAnuncio']) ?>" />

                        <!-- Conteúdo do card -->
                        <div class="card-body p-4">
                            <div class="text-center">

                                <!-- Título do Anúncio -->
                                <h5 class="fw-bolder">
                                    <?php echo htmlspecialchars($anuncio['tituloAnuncio']) ?>
                                </h5>

                                <!-- Valor Formatado -->
                                <p>
                                    R$ <?php echo number_format($anuncio['valorAnuncio'], 2, ',', '.') ?>
                                </p>

                            </div>
                        </div>


                    </div>
                </a>

            </div>

            <?php
                    } //Fechamento do while que varre o array de Anúncios

                } //Fechamento do if
                else{
                    //Caso não existam anúncios
                    echo "<div class='alert alert-info text-center'>Nenhum anúncio encontrado.</div>";
                }
            ?>
        </div>

    </div>

</section>
        
<?php include "footer.php" ?>