<?php include "header.php" ?>

    <!-- Seção para conteúdo da página -->
    <section class="py-5">

        <div class="d-flex justify-content-center mb-3">

            <div class="row">
                <div class="col">
                    
                    <h2>Cadastro de Usuário:</h2>

                    <form action="actionUsuario.php" method="POST" class="was-validated">

                        <div class="form-floating mt-3 mb-3">
                            <input type="file" class="form-control" id="fotoUsuario" placeholder="Foto" name="fotoUsuario">
                            <label for="fotoUsuario">Foto</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" id="nomeUsuario" placeholder="Nome" name="nomeUsuario">
                            <label for="nomeUsuario">Nome Completo</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="date" class="form-control" id="dataNascimentoUsuario" placeholder="dataNascimentoUsuario" name="dataNascimentoUsuario">
                            <label for="dataNascimentoUsuario">Data de Nascimento</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <select class="form-select" id="cidadeUsuario" name="cidadeUsuario" placeholder="Cidade">
                                <option value="curiuva">Curiúva</option>
                                <option value="imbau">Imbaú</option>
                                <option value="ortigueira">Ortigueira</option>
                                <option value="reserva">Reserva</option>
                                <option value="telemaco" selected>Telêmaco Borba</option>
                                <option value="tibagi">Tibagi</option>
                            </select>
                            <label for="cidadeUsuario">Cidade</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="email" class="form-control" id="emailUsuario" placeholder="Email" name="emailUsuario">
                            <label for="emailUsuario">Email</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="password" class="form-control" id="senhaUsuario" placeholder="Email" name="senhaUsuario">
                            <label for="senhaUsuario">Senha</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="password" class="form-control" id="confirmarSenhaUsuario" placeholder="Confirmar Senha" name="confirmarSenhaUsuario">
                            <label for="confirmarSenhaUsuario">Confirmar Senha</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </form>

                </div>
            </div>

        </div>

    </section>

<?php include "footer.php" ?>