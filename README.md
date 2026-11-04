
# Barbearia Studio Visual

Site institucional demonstrativo para uma barbearia, desenvolvido em PHP, HTML, CSS e JavaScript. O projeto foi pensado para apresentar os serviços com clareza, facilitar o contato pelo WhatsApp e permitir que os serviços sejam administrados diretamente no banco de dados.

> **Importante antes de publicar:** este é um projeto de demonstração. Atualize nome, telefone, endereço, horários, Instagram, preços, descrições e imagens para os dados reais da barbearia. Não divulgue informações fictícias como se fossem verdadeiras.


## Prévia visual do projeto

Conheça a identidade visual e as principais páginas do Barbearia Studio Visual. O projeto foi desenvolvido para apresentar os serviços da barbearia de forma profissional, facilitar a navegação e incentivar o contato e as solicitações de agendamento.

### Página inicial

<!-- PRINT 1: CAPTURA GRANDE DA PÁGINA INICIAL NO COMPUTADOR -->
<p align="center">
<img src="assets/images/portfolio/home-desktop.png"
       alt="Página inicial do Barbearia Studio Visual"
       width="100%">
</p>

<p align="center">
  <em>Apresentação da barbearia, identidade visual e destaques dos serviços.</em>
</p>

### Conheça as páginas do site

<table>
  <tr>
    <td align="center" width="50%">
      <strong>Página de serviços</strong><br><br>
      <!-- PRINT 2: PÁGINA DE SERVIÇOS -->
      <img src="assets/images/portfolio/servicos-desktop.png"
           alt="Página de serviços"
           width="100%">
      <br>
      <em>Serviços, descrições, preços e duração estimada.</em>
    </td>
    <td align="center" width="50%">
      <strong>Agendamento</strong><br><br>
      <!-- PRINT 3: FORMULÁRIO DE AGENDAMENTO -->
      <img src="assets/images/portfolio/agendamento-desktop.png"
           alt="Formulário de agendamento"
           width="100%">
      <br>
      <em>Solicitação de horário com encaminhamento para o WhatsApp.</em>
    </td>
  </tr>
  <tr>
    <td align="center" width="50%">
      <strong>Página de contato</strong><br><br>
      <!-- PRINT 4: PÁGINA DE CONTATO -->
      <img src="assets/images/portfolio/contato-desktop.png"
           alt="Página de contato"
           width="100%">
      <br>
      <em>Informações e canais de contato da barbearia.</em>
    </td>
    <td align="center" width="50%">
      <strong>Versão para celular</strong><br><br>
      <!-- PRINT 5: CAPTURA DO SITE NO CELULAR -->
      <img src="assets/images/portfolio/home-mobile.png"
           alt="Versão mobile do site"
           width="55%">
      <br>
      <em>Layout adaptado para dispositivos móveis.</em>
    </td>
  </tr>
</table>

> As imagens acima devem ser substituídas por capturas reais do projeto em funcionamento.


## Funcionalidades

- Navegação entre Início, Serviços e Contato.
- Exibição de serviços, descrições, preços e duração estimada.
- Leitura de serviços ativos no MySQL/MariaDB usando PDO.
- Dados de demonstração quando o banco ainda não estiver configurado, com aviso visível no site.
- Seção "Agende seu horário" com formulário de solicitação pelo WhatsApp (nome, serviço, data e horário desejados).
- Pré-seleção do serviço ao acessar o agendamento a partir da página de serviços.
- Formulário de contato com validação no navegador; os dados são organizados em uma mensagem e não são armazenados pelo site.
- Links para endereço, mapa e Instagram configuráveis.
- Menu adaptado para dispositivos móveis e cuidados básicos de acessibilidade.

## Tecnologias

- PHP 8.0 ou superior
- MySQL 5.7+ ou MariaDB 10.4+
- PDO para conexão com o banco de dados
- HTML5
- CSS3
- JavaScript puro
- XAMPP para ambiente local (Apache, PHP e MySQL/MariaDB)
- Git e GitHub para versionamento

## Estrutura do projeto

```text
barbearia-studio-visual/
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── script.js
│   └── images/
├── config/
│   ├── database.example.php
│   └── site.php
├── database/
│   └── schema.sql
├── includes/
│   ├── functions.php
│   ├── header.php
│   └── footer.php
├── index.php
├── servicos.php
├── contato.php
├── .gitignore
└── README.md
```

## Como executar localmente

### 1. Preparar o ambiente

1. Instale e abra o XAMPP.
2. Inicie os módulos **Apache** e **MySQL**.
3. Copie a pasta `barbearia-studio-visual` para dentro de `htdocs`.

### 2. Criar o banco de dados

1. Acesse `http://localhost/phpmyadmin`.
2. Crie um banco chamado `barbearia_studio_visual`, usando `utf8mb4`.
3. Selecione o banco criado e abra a aba **Importar**.
4. Importe o arquivo `database/schema.sql`.

O script cria a tabela `servicos` e insere serviços de exemplo. Os preços são demonstrativos e devem ser revisados antes da publicação.

### 3. Configurar a conexão

1. Dentro de `config`, faça uma cópia de `database.example.php`.
2. Renomeie a cópia para `database.php`.
3. Abra `database.php` e informe host, banco, usuário e senha do seu MySQL.

Exemplo para uma instalação local padrão do XAMPP:

```php
return [
    'host' => 'localhost',
    'dbname' => 'barbearia_studio_visual',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
];
```

O arquivo `config/database.php` está no `.gitignore` porque pode conter credenciais. **Não envie esse arquivo ao GitHub.** Em hospedagem, use as credenciais fornecidas pelo provedor.

### 4. Personalizar os dados do negócio

Edite `config/site.php` e substitua:

- `business_name` e `brand_prefix`: nome exibido no site.
- `tagline`: frase de apresentação.
- `whatsapp_number`: telefone com código do país e DDD, somente números (ex.: `5511999999999`).
- `whatsapp_display`: telefone formatado para exibição.
- `address` e `maps_url`: endereço real e link correto do mapa.
- `instagram_url` e `email`: canais oficiais.
- `hours`: horários reais de funcionamento.

Revise também os serviços e preços na tabela `servicos`. Você pode editar os registros pelo phpMyAdmin.

### 5. Abrir o projeto

Acesse no navegador:

```text
http://localhost/barbearia-studio-visual/
```

Se o arquivo `config/database.php` ainda não existir ou a conexão falhar, o site exibirá serviços de demonstração e um aviso para configuração. Isso permite visualizar o layout, mas não substitui a configuração correta para produção.

## Personalização visual

- Cores, tipografia, espaçamentos e responsividade: `assets/css/style.css`.
- Menu mobile e formulário de contato: `assets/js/script.js`.
- Textos e seções da página inicial: `index.php`.
- Lista de serviços: `servicos.php` e tabela `servicos`.
- Informações de contato: `contato.php` e `config/site.php`.

A imagem principal usa uma foto remota do Unsplash como referência visual. Para produção, prefira fotos próprias ou imagens cuja licença de uso comercial tenha sido verificada. Para trocar a imagem, altere a URL em `.hero__visual` no arquivo `assets/css/style.css` ou use um arquivo local em `assets/images/`.

## Segurança e cuidados

- Consultas ao banco utilizam PDO; mantenha esse padrão e use parâmetros preparados em novas consultas que recebam dados externos.
- Valores dinâmicos são escapados com `htmlspecialchars` por meio da função `e()` antes de serem exibidos no HTML.
- Credenciais locais ficam em `config/database.php`, que é ignorado pelo Git.
- O formulário de contato não grava dados no servidor: ele apenas abre uma conversa do WhatsApp para o visitante revisar e enviar.
- Antes de publicar, configure HTTPS, mantenha PHP e banco atualizados e remova avisos e dados de demonstração.
- Não adicione dados pessoais de clientes ao repositório. Defina com o responsável pelo negócio como serão tratados contatos e informações recebidas.

## Como funciona o agendamento

A seção **Agende seu horário** permite que a pessoa informe nome, serviço, dia e horário desejados. O JavaScript organiza essas informações em uma mensagem e abre o WhatsApp configurado em `config/site.php`. A equipe da barbearia confere a agenda e confirma a disponibilidade diretamente na conversa. O formulário não grava os dados no banco e não bloqueia horários.

**Importante:** a data e o horário informados são apenas uma preferência. A solicitação só se torna um agendamento confirmado depois da resposta da barbearia.

## Limitações atuais

- Não há confirmação automática, calendário sincronizado nem bloqueio de horários.
- Não há painel administrativo; a edição dos serviços é feita diretamente no banco de dados.
- Não há login, pagamento online, envio de e-mail nem armazenamento de mensagens.
- O agendamento depende de um número real configurado em `config/site.php`; o projeto vem sem número preenchido para evitar direcionar visitantes a um telefone fictício.

Essas funcionalidades podem ser desenvolvidas em etapas futuras, conforme a necessidade real do negócio.

## Melhorias futuras

- Painel administrativo protegido para gerenciar serviços e preços.
- Agendamento com consulta de disponibilidade e confirmação automática, caso a barbearia precise dessa evolução.
- Galeria de fotos reais do espaço e dos trabalhos, com autorização das pessoas retratadas.
- Página de perguntas frequentes e política de privacidade.
- Testes automatizados e melhorias adicionais de SEO.

## Autor

**Lucas Braga** — estudante de Desenvolvimento de Sistemas.

Projeto de portfólio desenvolvido para demonstrar conhecimentos em desenvolvimento web front-end e back-end.
