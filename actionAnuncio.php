<!-- Inclui o header.php -->
<?php include "header.php" ?>

    <?php
    
        //Verifica o método de requisição do servidor
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //Define o bloco de variáveis para armazenar as informações recebidas do formulário
            $fotoAnuncio = $tituloAnuncio = $categoriaAnuncio = $descricaoAnuncio = $valorAnuncio = $dataAnuncio = $horaAnuncio = "";

            //Variável booleana para controle de erros de preenchimento
            $erroPreenchimento = false;

            //Captura a data e a hora do servidor
            $dataAnuncio = date("Y-m-d");
            $horaAnuncio = date("H:i:s");

            //Validação do campo tituloAnuncio
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["tituloAnuncio"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>TÍTULO DO ANÚNCIO</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável
                $tituloAnuncio = filtrar_entrada($_POST["tituloAnuncio"]);
            }

            //Validação do campo categoriaAnuncio
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["categoriaAnuncio"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>CATEGORIA DO ANÚNCIO</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável
                $categoriaAnuncio = filtrar_entrada($_POST["categoriaAnuncio"]);
            }

            //Validação do campo descricaoAnuncio
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["descricaoAnuncio"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>DESCRIÇÃO DO ANÚNCIO</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável
                $descricaoAnuncio = filtrar_entrada($_POST["descricaoAnuncio"]);
            }

            //Validação do campo valorAnuncio
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["valorAnuncio"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>VALOR DO ANÚNCIO</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável
                $valorAnuncio = filtrar_entrada($_POST["valorAnuncio"]);
            }

            //Início da validação da fotoAnuncio
            $diretorio    = "assets/img/"; //Define para qual diretório as imagens serão movidas
            $fotoAnuncio  = $diretorio . basename($_FILES['fotoAnuncio']['name']); //Montar o nome a ser salvo no BD
            $tipoDaImagem = strtolower(pathinfo($fotoAnuncio, PATHINFO_EXTENSION)); //Pega o tipo do arquivo em letras minúsculas
            $erroUpload   = false; //Variável para controle de erros do upload da foto

            //Verifica se o tamanho do arquivo é diferente de ZERO
            if($_FILES["fotoAnuncio"]["size"] != 0){

                //Verifica se o tamanho do arquivo é maior do que 5 MegaBytes(MB) - Medida em bytes
                if($_FILES["fotoAnuncio"]["size"] > 5000000){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>FOTO</strong> deve ter tamanho máximo de 5MB!</div>";
                    $erroUpload = true;
                }

                //Verifica se a foto está nos formatos JPG, JPEG, PNG ou WEBP
                if($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png" && $tipoDaImagem != "webp"){
                    echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> deve estar no formatos JPG, JPEG, PNG ou WEBP!</div>";
                    $erroUpload = true;
                }

                //Verifica se a imagem foi movida para o diretório (assets/img), utilizando a função move_uploaded_file()
                if(!move_uploaded_file($_FILES["fotoAnuncio"]["tmp_name"], $fotoAnuncio)){
                    echo "<div class='alert alert-warning text-center'>Erro ao tentar mover a <strong>FOTO</strong> para o diretório $diretorio!</div>";
                    $erroUpload = true;
                }

            }
            else{
                echo "<div class='alert alert-warning text-center'>O campo <strong>FOTO</strong> é obrigatório!</div>";
                $erroUpload = true;
            }

            //Se NÃO houver erro de preenchimento e NÃO houver erro no upload da foto
            if(!$erroPreenchimento && !$erroUpload){

                //Criar uma variável para armazenar a QUERY que realiza a inserção de dados do Usuário na tabela Usuarios
                $inserirAnuncio = "INSERT INTO Anuncios (Usuarios_idUsuario, fotoAnuncio, tituloAnuncio, categoriaAnuncio, descricaoAnuncio, valorAnuncio, dataAnuncio, horaAnuncio, statusAnuncio) VALUES ('$idUsuario', '$fotoAnuncio', '$tituloAnuncio', '$categoriaAnuncio', '$descricaoAnuncio', $valorAnuncio, '$dataAnuncio', '$horaAnuncio', 'disponivel')";

                //Inclui o arquivo de conexão com o Banco de Dados
                include "conexaoBD.php";

                //Se conseguir executar a QUERY para inserção, exibe alerta de sucesso e a tabela com os dados informados
                //A funçao mysqli_query executa operações no Banco de Dados
                if(mysqli_query($conn, $inserirAnuncio)){

                    echo "<div class='container'>";
                        echo "<div class='alert alert-success text-center'><strong>ANÚNCIO</strong> cadastrado com sucesso!</div>";
                        echo "
                            <div class='container mt-3'>
                                <div class='container mt-3 mb-3 text-center'>
                                    <img src='$fotoAnuncio' style='width:150px' title='Foto de $fotoAnuncio' class='img-thumbnail'>
                                </div>
                                <table class='table'>
                                    <tr>
                                        <th>TÍTULO DO ANÚNCIO</th>
                                        <td>$tituloAnuncio</td>
                                    </tr>
                                    <tr>
                                        <th>CATEGORIA DO ANÚNCIO</th>
                                        <td>$categoriaAnuncio</td>
                                    </tr>
                                    <tr>
                                        <th>DESCRIÇÃO DO ANÚNCIO</th>
                                        <td>$descricaoAnuncio</td>
                                    </tr>
                                    <tr>
                                        <th>VALOR DO ANÚNCIO</th>
                                        <td>R$ $valorAnuncio</td>
                                    </tr>
                                    <tr>
                                        <th>DATA DO ANÚNCIO</th>
                                        <td>$dataAnuncio às $horaAnuncio</td>
                                    </tr>
                                </table>
                            </div>
                        ";
                    echo "</div>";
                }
                else{
                    echo "<div class='alert alert-danger text-center'>
                    Erro ao tentar inserir dados do<strong>ANÚNCIO</strong> no banco de dados $database!</div>" . mysqli_error($conn);
                }
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