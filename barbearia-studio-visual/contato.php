<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Contato e localização | Barbearia Studio Visual';
$currentPage = 'contato';
$site = site_config();
require __DIR__ . '/includes/header.php';
?>
<main id="conteudo">
    <section class="page-hero"><div class="container"><p class="eyebrow"><span class="eyebrow__line"></span> CONTATO</p><h1>Seu próximo horário começa <em>por aqui.</em></h1><p>Envie uma mensagem, conte o que você procura e consulte a disponibilidade.</p></div></section>
    <section class="section"><div class="container contact-grid">
        <div class="contact-panel">
            <p class="eyebrow"><span class="eyebrow__line"></span> FALE COM A BARBEARIA</p>
            <h2>Vamos conversar?</h2>
            <p class="contact-panel__intro">Preencha os campos e vamos abrir uma conversa no WhatsApp com sua mensagem pronta. Você poderá revisar e enviar quando estiver tudo certo.</p>
            <form class="contact-form" id="contact-form" data-whatsapp-number="<?= e($site['whatsapp_number'] ?? '') ?>">
                <div class="form-field"><label for="nome">Seu nome</label><input type="text" id="nome" name="nome" autocomplete="name" maxlength="80" placeholder="Como podemos chamar você?" required></div>
                <div class="form-field"><label for="servico">Serviço de interesse</label><select id="servico" name="servico" required><option value="">Selecione uma opção</option><option>Corte de cabelo</option><option>Barba</option><option>Corte + barba</option><option>Outro / Ainda tenho dúvida</option></select></div>
                <div class="form-field"><label for="mensagem">Mensagem <span>(opcional)</span></label><textarea id="mensagem" name="mensagem" rows="4" maxlength="500" placeholder="Conte um pouco do que você precisa..."></textarea></div>
                <button class="button form-submit" type="submit">Continuar no WhatsApp <span aria-hidden="true">↗</span></button>
                <p class="form-privacy">Este formulário não armazena seus dados. A mensagem será preparada no WhatsApp e só será enviada quando você confirmar por lá.</p>
                <p class="form-feedback" id="form-feedback" role="status" aria-live="polite"></p>
            </form>
        </div>
        <aside class="contact-details">
            <div class="contact-detail"><span class="contact-detail__icon" aria-hidden="true">⌖</span><div><h3>Onde estamos</h3><p><?= e($site['address'] ?? 'Endereço a definir') ?></p><a href="<?= e($site['maps_url'] ?? '#') ?>" target="_blank" rel="noopener noreferrer">Ver no mapa <span aria-hidden="true">↗</span></a></div></div>
            <div class="contact-detail"><span class="contact-detail__icon" aria-hidden="true">◷</span><div><h3>Horários</h3><div class="hours-list"><?php foreach (($site['hours'] ?? []) as $day => $hours): ?><p><span><?= e($day) ?></span><strong><?= e($hours) ?></strong></p><?php endforeach; ?></div></div></div>
            <div class="contact-detail"><span class="contact-detail__icon" aria-hidden="true">✆</span><div><h3>WhatsApp</h3><p><?= e($site['whatsapp_display'] ?? 'Telefone a configurar') ?></p><a href="<?= e(whatsapp_url('Olá! Gostaria de falar com a barbearia.')) ?>" target="_blank" rel="noopener noreferrer">Iniciar conversa <span aria-hidden="true">↗</span></a></div></div>
            <div class="contact-note"><strong>Antes de sair de casa</strong><p>Confirme o endereço e o horário pelo WhatsApp. Assim, você evita imprevistos e recebe as informações atualizadas.</p></div>
        </aside>
    </div></section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
