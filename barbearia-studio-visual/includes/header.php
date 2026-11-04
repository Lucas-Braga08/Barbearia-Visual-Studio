<?php
require_once __DIR__ . '/functions.php';
$site = site_config();
$pageTitle = $pageTitle ?? 'Barbearia Studio Visual';
$currentPage = $currentPage ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#171716">
    <meta name="description" content="<?= e($site['business_name'] ?? 'Studio Visual') ?> — <?= e($site['tagline'] ?? 'Seu estilo, do seu jeito.') ?> Conheça os serviços e entre em contato.">
    <title><?= e($pageTitle) ?></title>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js" defer></script>
</head>
<body>
<a class="skip-link" href="#conteudo">Pular para o conteúdo</a>
<div class="topbar">
    <div class="container topbar__inner">
        <span>Atendimento com horário combinado</span>
        <a href="index.php#agendamento">Solicite um horário pelo WhatsApp <span aria-hidden="true">↗</span></a>
    </div>
</div>
<header class="site-header">
    <div class="container header__inner">
        <a class="brand" href="index.php" aria-label="Página inicial — <?= e($site['business_name'] ?? 'Studio Visual') ?>">
            <span class="brand__mark" aria-hidden="true">SV</span>
            <span class="brand__text"><span><?= e($site['brand_prefix'] ?? 'BARBEARIA') ?></span><strong><?= e($site['business_name'] ?? 'Studio Visual') ?></strong></span>
        </a>

        <button class="menu-toggle" type="button" aria-label="Abrir menu" aria-expanded="false" aria-controls="menu-principal">
            <span></span><span></span><span></span>
        </button>

        <nav class="main-nav" id="menu-principal" aria-label="Menu principal">
            <a class="<?= $currentPage === 'inicio' ? 'is-active' : '' ?>" href="index.php" <?= $currentPage === 'inicio' ? 'aria-current="page"' : '' ?>>Início</a>
            <a class="<?= $currentPage === 'servicos' ? 'is-active' : '' ?>" href="servicos.php" <?= $currentPage === 'servicos' ? 'aria-current="page"' : '' ?>>Serviços</a>
            <a class="<?= $currentPage === 'contato' ? 'is-active' : '' ?>" href="contato.php" <?= $currentPage === 'contato' ? 'aria-current="page"' : '' ?>>Contato</a>
            <a class="button button--small button--nav" href="index.php#agendamento">Agendar horário <span aria-hidden="true">↗</span></a>
        </nav>
    </div>
</header>
