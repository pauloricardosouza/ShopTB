<?php 
    include "header.php";
    include "conexaoBD.php";

    //Verifica se o usuário está logado
    if(!isset($_SESSION['idUsuario'])){
        echo "
            <div class='container-mt-5'>
                <div class='alert alert-danger text-center'>Você precisa estar logado para editar um anúncio!</div>
            </div>
        ";

        include "footer.php";
        exit;
    }

    //Verifica se o idAnuncio foi enviado pela URL
    if(isset($_GET['idAnuncio'])){
        $idAnuncio = $_GET['idAnuncio'];
        $idUsuario = $_SESSION['idUsuario'];

        //QUERY para buscar o anúncio pelo idAnuncio somente se ele pertencer ao usuário logado
        $buscarAnuncio = "
            SELECT *
            FROM Anuncios
            WHERE idAnuncio = $idAnuncio
            AND Usuarios_idUsuario = $idUsuario
        ";

        //Executar a QUERY
        $res = mysqli_query($conn, $buscarAnuncio) or die("Erro ao tentar buscar o anúncio!");

        //Verifica se encontrou algum anúncio com os dados informados
        if(mysqli_num_rows($res) > 0){
            $anuncio = mysqli_fetch_assoc($res); //Cria um array associativo ($anuncio[]) para armazenar dados do anúncio

            $fotoAnuncio      = $anuncio['fotoAnuncio'];
            $tituloAnuncio    = $anuncio['tituloAnuncio'];
            $categoriaAnuncio = $anuncio['categoriaAnuncio'];
            $descricaoAnuncio = $anuncio['descricaoAnuncio'];
            $valorAnuncio     = $anuncio['valorAnuncio'];
        }
        else{
            echo "
                <div class='container-mt-5'>
                    <div class='alert alert-danger text-center'>Anúncio não encontrado ou você não possui permissão para editá-lo!</div>
                </div>
            ";
            include "footer.php";
            exit;
        }
    }
    else{
        echo "
            <div class='container-mt-5'>
                <div class='alert alert-danger text-center'>Nenhum anúncio foi selecionado!</div>
            </div>
        ";
        include "footer.php";
        exit;
    }
    
?>

    <!-- Seção para conteúdo da página -->
    <section class="py-5">

        <div class="d-flex justify-content-center mb-3">

            <div class="row">
                <div class="col">
                    
                    <h2>Editar Anúncio:</h2>

                    <form action="actionEditarAnuncio.php" method="POST" class="was-validated" enctype="multipart/form-data">

                        <input type="hidden" name="idAnuncio" value="<?php echo $idAnuncio; ?>">
                        <input type="hidden" name="fotoAtual" value="<?php echo $fotoAnuncio; ?>">

                        <div class="form-floating mt-3 mb-3">
                            <?php
                                if(!empty($fotoAnuncio)){
                                    echo "
                                        <div class='mb-3 text-center'>
                                            <img src='$fotoAnuncio' class='img-thumbnail' style='max-width: 200px;'>
                                            <p class='mt-2'>Foto atual do Anúncio</p>
                                        </div>
                                    ";
                                }
                            ?>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="file" class="form-control" id="fotoAnuncio" placeholder="Foto" name="fotoAnuncio">
                            <label for="fotoAnuncio">Nova foto do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" id="tituloAnuncio" placeholder="Título do Anúncio" name="tituloAnuncio" value="<?php echo $tituloAnuncio ?>" required>
                            <label for="tituloAnuncio">Título do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <select class="form-select" id="categoriaAnuncio" name="categoriaAnuncio" placeholder="Selecione uma Categoria" required>
                                <option value="Alimentos" <?php if($categoriaAnuncio == "Alimentos") echo "selected"; ?> >Alimentos</option>
                                <option value="Eletrônicos" <?php if($categoriaAnuncio == "Eletrônicos") echo "selected"; ?>>Eletrônicos</option>
                                <option value="Imóveis" <?php if($categoriaAnuncio == "Imóveis") echo "selected"; ?>>Imóveis</option>
                                <option value="Veículos" <?php if($categoriaAnuncio == "Veículos") echo "selected"; ?>>Veículos</option>
                                <option value="Vestuário" <?php if($categoriaAnuncio == "Vestuário") echo "selected"; ?>>Vestuário</option>
                                <option value="Outra" <?php if($categoriaAnuncio == "Outra") echo "selected"; ?>>Outra</option>
                            </select>
                            <label for="categoriaAnuncio">Categoria do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <textarea class="form-control" id="descricaoAnuncio" 
                            placeholder="Informe uma breve descrição sobre o seu anúncio" name="descricaoAnuncio" required><?php echo $descricaoAnuncio?></textarea>
                            <label for="descricaoAnuncio">Descrição do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" id="valorAnuncio" placeholder="Valor do Anúncio" name="valorAnuncio" value="<?php echo $valorAnuncio ?>" required>
                            <label for="valorAnuncio">Valor do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-outline-dark">Salvar Alterações</button>
                    </form>

                </div>
            </div>

        </div>

    </section>

<?php include "footer.php" ?>