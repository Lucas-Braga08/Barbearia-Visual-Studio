<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Barbearia Studio Visual | Seu estilo, do seu jeito';
$currentPage = 'inicio';
$services = get_services(3);
$allServices = get_services();
$requestedService = isset($_GET['servico']) && is_string($_GET['servico']) ? trim($_GET['servico']) : '';
$databaseReady = database_connection() !== null;
$site = site_config();
require __DIR__ . '/includes/header.php';
?>
<main id="conteudo">
    <?php if (!$databaseReady): ?>
        <div class="container demo-notice" role="status"><strong>Modo de demonstração:</strong> configure o banco de dados e revise telefone, endereço, redes sociais e valores antes de publicar este site para clientes.</div>
    <?php endif; ?>

    <section class="hero">
        <div class="container hero__grid">
            <div class="hero__content">
                <p class="eyebrow"><span class="eyebrow__line"></span> <?= e($site['brand_prefix'] ?? 'BARBEARIA') ?> <?= e($site['business_name'] ?? 'STUDIO VISUAL') ?></p>
                <h1>Seu estilo merece <em>atenção</em> aos detalhes.</h1>
                <p class="hero__description">Um bom corte vai além do visual. É sobre se sentir bem, ser ouvido e sair com a confiança renovada.</p>
                <div class="hero__actions">
                    <a class="button" href="#agendamento">Solicitar um horário <span aria-hidden="true">↗</span></a>
                    <a class="text-link" href="servicos.php">Conhecer serviços <span aria-hidden="true">→</span></a>
                </div>
                <div class="hero__note"><span class="hero__note-icon" aria-hidden="true">✦</span><span>Atendimento próximo, ambiente agradável e cuidado em cada etapa.</span></div>
            </div>
            <div class="hero__visual" role="img" aria-label="Ambiente de barbearia com cadeira e ferramentas de corte">
                <div class="hero__visual-overlay"></div>
                <div class="hero__visual-caption"><span>STUDIO VISUAL</span><strong>O cuidado está nos detalhes.</strong></div>
                <span class="hero__vertical-label" aria-hidden="true">ESTILO • CUIDADO • IDENTIDADE</span>
            </div>
        </div>
        <div class="hero__bottom-line" aria-hidden="true"></div>
    </section>

    <section class="section section--services">
        <div class="container">
            <div class="section-heading">
                <div><p class="eyebrow"><span class="eyebrow__line"></span> SERVIÇOS</p><h2>Cuidado na medida <em>certa.</em></h2></div>
                <a class="text-link section-heading__link" href="servicos.php">Ver todos os serviços <span aria-hidden="true">→</span></a>
            </div>
            <div class="service-grid">
                <?php foreach ($services as $index => $service): ?>
                    <article class="service-card">
                        <div class="service-card__top"><span class="service-card__number">0<?= $index + 1 ?></span><span class="service-card__symbol" aria-hidden="true"><?= $index === 0 ? '✂' : ($index === 1 ? '⌁' : '✦') ?></span></div>
                        <h3><?= e($service['nome']) ?></h3>
                        <p><?= e($service['descricao']) ?></p>
                        <div class="service-card__bottom"><span>A partir de <strong><?= e(format_price($service['preco'])) ?></strong></span><span><?= (int) $service['duracao_minutos'] ?> min</span></div>
                    </article>
                <?php endforeach; ?>
            </div>
            <p class="section-footnote">Os valores e tempos são referências e podem variar conforme o serviço. Confirme os detalhes pelo WhatsApp.</p>
        </div>
    </section>

    <section class="section appointment-section" id="agendamento">
        <div class="container appointment-layout">
            <div class="appointment-copy">
                <p class="eyebrow"><span class="eyebrow__line"></span> AGENDAMENTO PELO WHATSAPP</p>
                <h2>Seu próximo corte começa <em>com um pedido simples.</em></h2>
                <p>Escolha o serviço, indique o melhor dia e horário para você. Vamos abrir uma conversa no WhatsApp com os detalhes para a equipe confirmar a disponibilidade.</p>
                <div class="appointment-points">
                    <div class="appointment-point"><span aria-hidden="true">01</span><div><strong>Você escolhe</strong><p>Informe o serviço e sua preferência de data e horário.</p></div></div>
                    <div class="appointment-point"><span aria-hidden="true">02</span><div><strong>A gente confirma</strong><p>A barbearia verifica a agenda e responde pelo WhatsApp.</p></div></div>
                    <div class="appointment-point"><span aria-hidden="true">03</span><div><strong>Horário combinado</strong><p>Seu horário só fica confirmado depois da resposta da equipe.</p></div></div>
                </div>
                <p class="appointment-note">Sem cadastro e sem pagamento pelo site. Você revisa a mensagem antes de enviá-la.</p>
            </div>

            <div class="appointment-panel">
                <div class="appointment-panel__heading">
                    <span class="appointment-panel__icon" aria-hidden="true">✂</span>
                    <div><h3>Agende seu horário</h3><p>Preencha os campos abaixo</p></div>
                </div>
                <form class="appointment-form" id="appointment-form" data-whatsapp-number="<?= e($site['whatsapp_number'] ?? '') ?>">
                    <div class="form-field">
                        <label for="appointment-name">Seu nome</label>
                        <input type="text" id="appointment-name" name="nome" autocomplete="name" maxlength="80" placeholder="Como podemos chamar você?" required>
                    </div>
                    <div class="form-field">
                        <label for="appointment-service">Serviço desejado</label>
                        <select id="appointment-service" name="servico" required>
                            <option value="">Selecione um serviço</option>
                            <?php foreach ($allServices as $service): ?>
                                <option value="<?= e($service['nome']) ?>" <?= $requestedService === (string) $service['nome'] ? 'selected' : '' ?>><?= e($service['nome']) ?> — <?= e(format_price($service['preco'])) ?></option>
                            <?php endforeach; ?>
                            <option value="Outro / preciso de orientação" <?= $requestedService === 'Outro / preciso de orientação' ? 'selected' : '' ?>>Outro / preciso de orientação</option>
                        </select>
                    </div>
                    <div class="appointment-form__row">
                        <div class="form-field">
                            <label for="appointment-date">Dia desejado</label>
                            <input type="date" id="appointment-date" name="data" required>
                        </div>
                        <div class="form-field">
                            <label for="appointment-time">Horário desejado</label>
                            <input type="time" id="appointment-time" name="horario" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="appointment-message">Observação <span>(opcional)</span></label>
                        <textarea id="appointment-message" name="observacao" rows="3" maxlength="300" placeholder="Quer deixar alguma informação? (opcional)"></textarea>
                    </div>
                    <button class="button appointment-submit" type="submit">Continuar pelo WhatsApp <span aria-hidden="true">↗</span></button>
                    <p class="form-privacy">O envio será feito no WhatsApp, após sua revisão. A data e o horário são uma preferência, não uma reserva confirmada.</p>
                    <p class="form-feedback" id="appointment-feedback" role="status" aria-live="polite"></p>
                </form>
            </div>
        </div>
    </section>

    <section class="section section--dark">
        <div class="container promise-grid">
            <div class="promise-intro"><p class="eyebrow eyebrow--light"><span class="eyebrow__line"></span> NOSSO JEITO DE ATENDER</p><h2>Mais do que um corte. <em>Uma boa experiência.</em></h2><p>Queremos que você saiba o que esperar antes de sentar na cadeira: conversa clara, atenção ao seu pedido e cuidado no acabamento.</p></div>
            <div class="promise-item"><span class="promise-item__icon" aria-hidden="true">01</span><div><h3>Você é ouvido</h3><p>Entendemos o resultado que você procura antes de começar.</p></div></div>
            <div class="promise-item"><span class="promise-item__icon" aria-hidden="true">02</span><div><h3>Combinado claro</h3><p>Serviços, valores e horários são confirmados com transparência.</p></div></div>
            <div class="promise-item"><span class="promise-item__icon" aria-hidden="true">03</span><div><h3>Atenção aos detalhes</h3><p>O acabamento e o cuidado fazem parte de todo atendimento.</p></div></div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container cta-section__inner"><div><p class="eyebrow"><span class="eyebrow__line"></span> SEU PRÓXIMO HORÁRIO</p><h2>Vamos cuidar do seu <em>visual?</em></h2><p>Chame no WhatsApp para consultar disponibilidade e tirar suas dúvidas.</p></div><a class="button button--light" href="#agendamento">Escolher meu horário <span aria-hidden="true">↗</span></a></div>
    </section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
