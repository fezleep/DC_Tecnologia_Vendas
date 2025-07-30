# 📦 Sistema de Registro de Vendas - DC Tecnologia

Este projeto foi desenvolvido como parte do processo seletivo para a vaga de desenvolvedor PHP na **DC Tecnologia**.

O sistema permite o registro de vendas com cliente (opcional), itens, forma de pagamento, geração de parcelas, autenticação de usuários, listagem com filtros e exportação da venda em PDF.

---

##  Tecnologias Utilizadas

- Laravel 10+
- PHP 8.2+
- MySQL
- Bootstrap
- JavaScript / jQuery
- DomPDF

---

##  Como Rodar o Projeto

### 1. Clonar o repositório
```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio

2. Instalar dependências PHP
bash
Copiar
Editar
composer install

3. Instalar dependências front-end
bash
Copiar
Editar
npm install && npm run dev

4. Criar arquivo .env
bash
Copiar
Editar
cp .env.example .env

5. Configurar variáveis do banco de dados no .env
dotenv
Copiar
Editar

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dc_tecnologia_vendas
DB_USERNAME=root
DB_PASSWORD=

6. Gerar chave da aplicação e rodar as migrations
bash
Copiar
Editar
php artisan key:generate
php artisan migrate

7. Iniciar o servidor de desenvolvimento
bash
Copiar
Editar
php artisan serve


🔐 Login
O projeto já vem com sistema de autenticação (Laravel UI + Bootstrap).

Após rodar o projeto, você pode registrar um novo usuário via /register e usá-lo para criar e gerenciar vendas.

Funcionalidades

Login e autenticação

Cadastro de vendas (cliente opcional)

Itens da venda e parcelas

Forma de pagamento

Listagem com filtros

Edição e exclusão de vendas

Download de resumo em PDF

📁 Estrutura Padrão (Models e Views)
swift
Copiar
Editar
app/Models/
├── Client.php
├── Sale.php
├── SaleItem.php
└── Installment.php

resources/views/sales/
├── index.blade.php
├── create.blade.php
├── edit.blade.php
└── pdf.blade.php
✅ Status
🚧 Em desenvolvimento para entrega do teste. Algumas melhorias e validações ainda estão sendo implementadas.

📬 Contato
Felipe Virginio da Silva Bessa
📧 virginio.9001@gmail.com
🔗 linkedin.com/in/fezleep
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
