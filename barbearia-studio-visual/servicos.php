<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Serviços e valores | Barbearia Studio Visual';
$currentPage = 'servicos';
$services = get_services();
$databaseReady = database_connection() !== null;
require __DIR__ . '/includes/header.php';
?>
<main id="conteudo">
    <section class="page-hero"><div class="container"><p class="eyebrow"><span class="eyebrow__line"></span> SERVIÇOS E VALORES</p><h1>Encontre o cuidado <em>ideal para você.</em></h1><p>Conheça as opções, consulte os valores e escolha o serviço que combina com seu momento.</p></div></section>
    <section class="section"><div class="container">
        <?php if (!$databaseReady): ?>
            <div class="demo-notice demo-notice--inline" role="status"><strong>Dados de demonstração:</strong> os serviços e preços abaixo são exemplos. Configure o MySQL e atualize os valores antes de divulgar o site.</div>
        <?php endif; ?>
        <?php if ($services === []): ?>
            <div class="empty-state"><h2>Estamos atualizando nossos serviços.</h2><p>Entre em contato pelo WhatsApp para consultar as opções disponíveis.</p></div>
        <?php else: ?>
            <div class="service-list">
                <?php foreach ($services as $index => $service): ?>
                    <article class="service-row"><div class="service-row__index"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></div><div class="service-row__content"><h2><?= e($service['nome']) ?></h2><p><?= e($service['descricao']) ?></p><span class="service-row__duration">Tempo estimado: <?= (int) $service['duracao_minutos'] ?> minutos</span></div><div class="service-row__price"><span>A partir de</span><strong><?= e(format_price($service['preco'])) ?></strong><a href="index.php?servico=<?= rawurlencode((string) $service['nome']) ?>#agendamento">Solicitar horário <span aria-hidden="true">↗</span></a></div></article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <p class="section-footnote">Preços e duração são referências. Serviços adicionais, cabelo mais longo ou outros detalhes podem alterar o valor. Confirme o orçamento antes do atendimento.</p>
    </div></section>
    <section class="cta-section"><div class="container cta-section__inner"><div><p class="eyebrow"><span class="eyebrow__line"></span> FICOU COM DÚVIDA?</p><h2>A gente conversa e encontra <em>a melhor opção.</em></h2><p>Explique o que procura e consulte horários disponíveis.</p></div><a class="button button--light" href="index.php#agendamento">Solicitar um horário <span aria-hidden="true">↗</span></a></div></section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
