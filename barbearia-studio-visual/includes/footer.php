<?php
$site = site_config();
?>
<footer class="site-footer">
    <div class="container footer__main">
        <div class="footer__brand">
            <a class="brand brand--footer" href="index.php">
                <span class="brand__mark" aria-hidden="true">SV</span>
                <span class="brand__text"><span><?= e($site['brand_prefix'] ?? 'BARBEARIA') ?></span><strong><?= e($site['business_name'] ?? 'Studio Visual') ?></strong></span>
            </a>
            <p><?= e($site['tagline'] ?? 'Seu estilo, do seu jeito.') ?> Um atendimento pensado para valorizar seu estilo.</p>
        </div>
        <div class="footer__column">
            <h2>Explore</h2>
            <a href="index.php">Início</a>
            <a href="servicos.php">Serviços e valores</a>
            <a href="contato.php">Contato e localização</a>
        </div>
        <div class="footer__column">
            <h2>Fale com a gente</h2>
            <a href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener noreferrer">WhatsApp: <?= e($site['whatsapp_display'] ?? 'Configure o telefone') ?></a>
            <a href="<?= e($site['instagram_url'] ?? 'https://www.instagram.com/') ?>" target="_blank" rel="noopener noreferrer">Instagram <span aria-hidden="true">↗</span></a>
            <span><?= e($site['address'] ?? 'Configure o endereço') ?></span>
        </div>
    </div>
    <div class="container footer__bottom">
        <span>© <span id="current-year">2026</span> <?= e($site['business_name'] ?? 'Studio Visual') ?>. Todos os direitos reservados.</span>
        <span>Feito com cuidado para você.</span>
    </div>
</footer>
</body>
</html>
