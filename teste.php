<?php session_start(); ?>

<?php include "header.php" ?>

    <?php
        
        $idUsuario    = $_SESSION['idUsuario']; //Armazenar as variáveis de sessão em variáveis PHP
        $nomeUsuario  = $_SESSION['nomeUsuario'];
        $emailUsuario = $_SESSION['emailUsuario'];
        $nivelUsuario = $_SESSION['nivelUsuario'];

        echo "
            <table class='table'>
                <thead class='dark'>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>EMAIL</th>
                        <th>NÍVEL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$idUsuario</td>
                        <td>$nomeUsuario</td>
                        <td>$emailUsuario</td>
                        <td>$nivelUsuario</td>
                    </tr>
                </tbody>
            </table>
        ";
    ?>

<?php include "footer.php" ?>