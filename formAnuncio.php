<?php include "header.php" ?>

    <!-- Seção para conteúdo da página -->
    <section class="py-5">

        <div class="d-flex justify-content-center mb-3">

            <div class="row">
                <div class="col">
                    
                    <h2>Cadastro de Anúncio:</h2>

                    <form action="actionAnuncio.php" method="POST" class="was-validated" enctype="multipart/form-data">

                        <div class="form-floating mt-3 mb-3">
                            <input type="file" class="form-control" id="fotoAnuncio" placeholder="Foto" name="fotoAnuncio">
                            <label for="fotoAnuncio">Foto do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" id="tituloAnuncio" placeholder="Título do Anúncio" name="tituloAnuncio">
                            <label for="tituloAnuncio">Título do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <select class="form-select" id="categoriaAnuncio" name="categoriaAnuncio" placeholder="Selecione uma Categoria">
                                <option value="Alimentos" selected>Alimentos</option>
                                <option value="Games">Games</option>
                                <option value="Imóveis">Imóveis</option>
                                <option value="Veículos">Veículos</option>
                                <option value="Vestuário">Vestuário</option>
                                <option value="Outra">Outra</option>
                            </select>
                            <label for="categoriaAnuncio">Categoria do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <textarea class="form-control" id="descricaoAnuncio" 
                            placeholder="Informe uma breve descrição sobre o seu anúncio" name="descricaoAnuncio"></textarea>
                            <label for="descricaoAnuncio">Descrição do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" id="valorAnuncio" placeholder="Valor do Anúncio" name="valorAnuncio">
                            <label for="valorAnuncio">Valor do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Criar Anúncio</button>
                    </form>

                </div>
            </div>

        </div>

    </section>

<?php include "footer.php" ?>