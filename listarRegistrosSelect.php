<?php include "header.php" ?>

<section class="py-5">

    <div class="d-flex justify-content mt-3 mb-3">

        <div class="row">
            <div class="col">

                <h3>Exibir Registros em um campo SELECT</h3>

                <div class='form-floating mt-3 mb-3'>

                    <select class='form-select' name='nomeUsuario'>
                        <?php
                            include "conexaoBD.php";
                            $listarUsuarios = "SELECT * FROM Usuarios";
                            $res = mysqli_query($conn, $listarUsuarios) or die("Erro ao tentar carregar Usuários");
                            while($registro = mysqli_fetch_assoc($res)){
                                $idUsuario   = $registro['idUsuario'];
                                $nomeUsuario = $registro['nomeUsuario'];
                                echo "<option value='$idUsuario'>$nomeUsuario</option>";
                            }
                        ?>
                    </select>
                    <label for='nomeUsuario'>Selecione um Usuário</label>
                </div>

            </div>
        </div>

    </div>

</section>

<?php include "footer.php" ?>