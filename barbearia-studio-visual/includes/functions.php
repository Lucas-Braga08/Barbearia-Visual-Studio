<?php

declare(strict_types=1);

/** Escapa valores antes de exibi-los no HTML. */
function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Carrega as configurações públicas do negócio. */
function site_config(): array
{
    static $config = null;

    if ($config === null) {
        $configFile = __DIR__ . '/../config/site.php';
        $config = is_file($configFile) ? require $configFile : [];
    }

    return $config;
}

/** Cria uma conexão PDO. Retorna null quando o banco ainda não foi configurado. */
function database_connection(): ?PDO
{
    static $connection = false;

    if ($connection !== false) {
        return $connection;
    }

    $configFile = __DIR__ . '/../config/database.php';
    if (!is_file($configFile)) {
        $connection = null;
        return null;
    }

    try {
        $config = require $configFile;
        $host = $config['host'] ?? 'localhost';
        $dbname = $config['dbname'] ?? '';
        $charset = $config['charset'] ?? 'utf8mb4';
        $username = $config['username'] ?? '';
        $password = $config['password'] ?? '';

        if ($dbname === '') {
            $connection = null;
            return null;
        }

        $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";
        $connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (Throwable $exception) {
        error_log('Falha ao conectar ao banco da Barbearia Studio Visual: ' . $exception->getMessage());
        $connection = null;
    }

    return $connection;
}

/** Serviços de demonstração exibidos até o banco de dados ser configurado. */
function demo_services(): array
{
    return [
        [
            'nome' => 'Corte clássico',
            'descricao' => 'Corte tradicional com acabamento cuidadoso e alinhado ao seu estilo.',
            'preco' => '45.00',
            'duracao_minutos' => 40,
            'destaque' => 1,
        ],
        [
            'nome' => 'Barba',
            'descricao' => 'Aparar, desenhar e finalizar a barba com atenção aos detalhes.',
            'preco' => '35.00',
            'duracao_minutos' => 30,
            'destaque' => 1,
        ],
        [
            'nome' => 'Corte + barba',
            'descricao' => 'Uma combinação prática para renovar o visual por completo.',
            'preco' => '70.00',
            'duracao_minutos' => 65,
            'destaque' => 1,
        ],
    ];
}

/** Busca serviços ativos. Usa os exemplos quando o banco não estiver disponível. */
function get_services(?int $limit = null): array
{
    $pdo = database_connection();

    if ($pdo === null) {
        return $limit === null ? demo_services() : array_slice(demo_services(), 0, $limit);
    }

    try {
        $sql = 'SELECT nome, descricao, preco, duracao_minutos, destaque
                FROM servicos
                WHERE ativo = 1
                ORDER BY destaque DESC, ordem ASC, nome ASC';

        if ($limit !== null) {
            $sql .= ' LIMIT ' . max(1, (int) $limit);
        }

        return $pdo->query($sql)->fetchAll();
    } catch (Throwable $exception) {
        error_log('Falha ao consultar serviços da Barbearia Studio Visual: ' . $exception->getMessage());
        return $limit === null ? demo_services() : array_slice(demo_services(), 0, $limit);
    }
}

/** Formata um preço em reais. */
function format_price(string|int|float $price): string
{
    return 'R$ ' . number_format((float) $price, 2, ',', '.');
}

/** Monta o link de conversa do WhatsApp com uma mensagem opcional. */
function whatsapp_url(string $message = ''): string
{
    $config = site_config();
    $number = preg_replace('/\D+/', '', (string) ($config['whatsapp_number'] ?? ''));

    if ($number === '') {
        return '#contato';
    }

    $url = 'https://wa.me/' . $number;
    return $message !== '' ? $url . '?text=' . rawurlencode($message) : $url;
}
