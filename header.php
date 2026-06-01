<?php

    error_reporting(0); //Desabilita alertas de erros de execução
    session_start();

    if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){ //Verifica se há sessão ativa
        $idUsuario    = $_SESSION['idUsuario']; //Armazenar as variáveis de sessão em variáveis PHP
        $nomeUsuario  = $_SESSION['nomeUsuario'];
        $emailUsuario = $_SESSION['emailUsuario'];
        $nivelUsuario = $_SESSION['nivelUsuario'];

        $nomeCompleto = explode(' ', $nomeUsuario); //Usa a função explode para fragmentar o nome do usuário
        $primeiroNome = $nomeCompleto[0]; //Armazena na variável o primeiro [0] fragmento do nome do usuário
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <?php
        //Configura o fuso horário para America/São Paulo
        date_default_timezone_set('America/Sao_Paulo');
    ?>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ShopTB</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- CND para ícones do Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <!-- Fonte Rancho do Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">

        <style>
            .rancho-regular {
                font-family: "Rancho", cursive;
                font-weight: 400;
                font-style: normal;
                font-size: 2rem;
            }

            /* Faixa diagonal de anúncio finalizado */
            .faixa-finalizado {
                position: absolute;
                top: 0%;
                right: 0;
                width: 50%;
                background: #dc3545;
                color: white;
                text-align: center;
                font-weight: bold;
                font-size: 0.7rem;
                padding: 5px 0;
                z-index: 10;
                box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            }

            /* Deixa a imagem em preto e branco */
            .imagem-finalizada {
                filter: grayscale(100%);
                opacity: 0.8;
            }
        </style>

    </head>
    <body>
        <!-- Barra de Navegação-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">ShopTB</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Página Inicial</a></li>
                        <li class="nav-item"><a class="nav-link" href="#sobre.php">Sobre</a></li>
                    </ul>
                   
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4">
                        <?php
                            if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){ //Verifica se há sessão ativa
                                if($nivelUsuario == 'administrador'){
                                    echo "
                                        <li class='nav-item dropdown'>
                                            <a class='nav-link dropdown-toggle' id='navbarDropdown' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'><i class='bi bi-person-circle'></i>&nbsp$primeiroNome</a>
                                            <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                <li><a class='dropdown-item' href='formAnuncio.php'>Criar Anúncio</a></li>
                                                <li><hr class='dropdown-divider' /></li>
                                                <li><a class='dropdown-item' href='#!'>Gerenciar Anúncios</a></li>
                                                <li><a class='dropdown-item' href='#!'>Gerenciar Usuários</a></li>
                                                <li><hr class='dropdown-divider' /></li>
                                                <li><a class='dropdown-item' href='logout.php'>Sair</a></li>
                                            </ul>
                                        </li>
                                    ";
                                }
                                else{
                                    echo "
                                        <li class='nav-item dropdown'>
                                            <a class='nav-link dropdown-toggle' id='navbarDropdown' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'><i class='bi bi-person-circle'></i>&nbsp$primeiroNome</a>
                                            <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                <li><a class='dropdown-item' href='formAnuncio.php'>Criar Anúncio</a></li>
                                                <li><hr class='dropdown-divider' /></li>
                                                <li><a class='dropdown-item' href='meusAnuncios.php'>Meus Anúncios</a></li>
                                                <li><a class='dropdown-item' href='minhasCompras.php'>Minhas Compras</a></li>
                                                <li><hr class='dropdown-divider' /></li>
                                                <li><a class='dropdown-item' href='logout.php'>Sair</a></li>
                                            </ul>
                                        </li>
                                    ";
                                }
                            }
                            else{
                                echo "<li class='nav-item'><a class='nav-link' aria-current='page' href='formLogin.php' title='Acessar o Sistema'>Login</a></li>";
                            }

                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-3">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <a href="index.php">
                        <img src="assets/img/ShopTB_Logo.png" style="width:200px">
                    </a>
                    <p class="lead fw-normal text-white mb-0 rancho-regular">O melhor da capital do papel a um clique!</p>
                </div>
            </div>
        </header>