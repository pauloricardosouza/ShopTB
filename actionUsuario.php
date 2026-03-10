<!-- Inclui o header.php -->
<?php include "header.php" ?>

    <?php
    
        //Verifica o método de requisição do servidor
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //Define o bloco de variáveis para armazenar as informações recebidas do formulário
            $fotoUsuario = $nomeUsuario = $dataNascimentoUsuario = $cidadeUsuario = $emailUsuario = $senhaUsuario = $confirmarSenhaUsuario = "";

            //Variável booleana para controle de erros de preenchimento
            $erroPreenchimento = false;

            //Validação do campo nomeUsuario
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["nomeUsuario"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>NOME</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável
                $nomeUsuario = filtrar_entrada($_POST["nomeUsuario"]);

                //Utiliza a função preg_match() para verificar se há apenas letras no nome
                if(!preg_match('/^[\p{L} ]+$/u', $nomeUsuario)){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>NOME</strong>
                    deve conter APENAS LETRAS!</div>";
                    $erroPreenchimento = true;
                }
            }

            //Validação do campo dataNascimentoUsuario
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["dataNascimentoUsuario"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>DATA DE NASCIMENTO</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável
                $dataNascimentoUsuario = filtrar_entrada($_POST["dataNascimentoUsuario"]);

                //Usa a função srtlen() para verificar o comprimento da string dataNascimentoUsuario
                if(strlen($dataNascimentoUsuario) == 10){
                    //Aplicar a função substr() para gerar substrings e armazenar dia, mês e ano de nascimento
                    $diaNascimentoUsuario = substr($dataNascimentoUsuario, 8, 2);
                    $mesNascimentoUsuario = substr($dataNascimentoUsuario, 5, 2);
                    $anoNascimentoUsuario = substr($dataNascimentoUsuario, 0, 4);

                    //Usa a função checkdate() para verificar se a data é válida
                    if(!checkdate($mesNascimentoUsuario, $diaNascimentoUsuario, $anoNascimentoUsuario)){
                        echo "<div class='alert alert-warning text-center'><strong>DATA INVÁLIDA!</strong></div>";
                        $erroPreenchimento = true;
                    }

                }
                else{
                    echo "<div class='alert alert-warning text-center'><strong>DATA INVÁLIDA!</strong></div>";
                    $erroPreenchimento = true;
                }
            }

            //Validação do campo cidadeUsuario
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["cidadeUsuario"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>CIDADE</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável
                $cidadeUsuario = filtrar_entrada($_POST["cidadeUsuario"]);
            }

            //Validação do campo emailUsuario
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["emailUsuario"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>EMAIL</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável
                $emailUsuario = filtrar_entrada($_POST["emailUsuario"]);
            }

            //Validação do campo senhaUsuario
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["senhaUsuario"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>SENHA</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável || Aplica a função md5 para criptografar a senha
                $senhaUsuario = md5(filtrar_entrada($_POST["senhaUsuario"]));
            }

            //Validação do campo confirmarSenhaUsuario
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["confirmarSenhaUsuario"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>CONFIRMAR SENHA</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável || Aplica a função md5 para criptografar a senha
                $confirmarSenhaUsuario = md5(filtrar_entrada($_POST["confirmarSenhaUsuario"]));

                //Compara se as senhas são diferentes
                if($senhaUsuario != $confirmarSenhaUsuario){
                    echo "<div class='alert alert-warning text-center'>As <strong>SENHAS</strong> informadas são diferentes!</div>";
                    $erroPreenchimento = true;
                }
            }

            if(!$erroPreenchimento){
                echo "<div class='container'>";
                    echo "<div class='alert alert-success text-center'><strong>USUÁRIO</strong> cadastrado com sucesso!</div>";
                    echo "
                        <div class='container mt-3'>
                            <table class='table'>
                                <tr>
                                    <th>NOME</th>
                                    <td>$nomeUsuario</td>
                                </tr>
                                <tr>
                                    <th>DATA DE NASCIMENTO</th>
                                    <td>$diaNascimentoUsuario/$mesNascimentoUsuario/$anoNascimentoUsuario</td>
                                </tr>
                                <tr>
                                    <th>CIDADE</th>
                                    <td>$cidadeUsuario</td>
                                </tr>
                                <tr>
                                    <th>EMAIL</th>
                                    <td>$emailUsuario</td>
                                </tr>
                                <tr>
                                    <th>SENHA</th>
                                    <td>$senhaUsuario</td>
                                </tr>
                                <tr>
                                    <th>CONFIRMAÇÃO DE SENHA</th>
                                    <td>$confirmarSenhaUsuario</td>
                                </tr>
                            </table>
                        </div>
                    ";
                echo "</div>";
            }

        }
        else{
            //Usa a função "header()" para redirecionar o usuário para o formUsuario.php
            header("location:formUsuario.php");
        }

        //Função para filtrar entrada de dados
        function filtrar_entrada($dado){
            $dado = trim($dado); //Remove espaços desnecessários
            $dado = stripslashes($dado); //Remove barras invertidas
            $dado = htmlspecialchars($dado); //Converte caracteres especiais em entidades HTML

            //Retorna o dado após filtrado
            return($dado);
        }
    
    ?>

<!-- Inclui o footer.php -->
<?php include "footer.php" ?>