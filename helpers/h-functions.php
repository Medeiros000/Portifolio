<?php
require_once 'helpers/Globais.php';
function h_head()
{
    return '
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Jr Medeiros</title>
    <meta name="description"
        content="Jr is a computer scientist who likes to learn and use his knowledge in projects in the most diverse areas.">
    <meta property="og:locale" content="pt-BR">
    <meta property="og:site_name" content="Jr Medeiros">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Jr Medeiros">
    <meta property="og:description"
        content="Jr is a computer scientist who likes to learn and use his knowledge in projects in the most diverse areas.">
    <meta name="theme-color" content="#0f172a">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
    ';
}

function h_pill($fora, $dentro)
{
    echo "<span class='pill fora'>$fora<span class='pill dentro'>$dentro</span></span>";
}

function debug_jr($conteudo)
{
    if (!EXIBE_DEBUG) return;
    $backtrace = debug_backtrace();
    $linha = $backtrace[0]['line'];
    $arquivo = $backtrace[0]['file'];

    echo '<pre style="text-align: start;">';
    print('<p style="text-decoration:underline; margin-bottom: 0;">' . $linha . ' -> ' . basename($arquivo) . '</p>');
    print_r($conteudo);
    echo "</pre>";
}


function error(string $number, string $string)
{
    echo "
        <h1>$number</h1>
        <hr>
        <p>$string</p>
    ";
}
