# SCA · Sistema de Controle de Arquivos

Sistema web desenvolvido para o gerenciamento, rastreamento físico e controle de empréstimos de documentos do **Setor de Estágios e Convênios da UniAtenas**.

O projeto centraliza o inventário documental dos alunos, vinculando cada registro digitalizado (PDF) à sua exata localização física (Armário e Gaveta), além de auditar as movimentações de retirada e devolução realizadas pelos operadores do setor.

---

## Principais Funcionalidades

- **Painel Geral (Dashboard):** Indicadores operacionais em tempo real e gráficos interativos (ocupação das gavetas mais cheias e fluxo mensal de empréstimos).
- **Gestão de Documentos:** Arquivamento com anexo em PDF, leitor de documentos embutido na tela, edição de registros e consulta com filtros combinados (texto, curso, assunto e armário).
- **Controle de Empréstimos:** Busca unificada por matrícula, nome do aluno ou documento, vínculo automático do operador logado, bloqueio de retirada duplicada para itens já emprestados e registro de devolução.
- **Estrutura Física:** Controle de armários e gavetas com cálculo automático de ocupação e alerta visual de lotação.
- **Cadastros Base e Operadores:** Gerenciamento de alunos, cursos, assuntos (com validação de duplicidade e pesquisa rápida) e controle interno de contas de acesso.

---

## Tecnologias Utilizadas

- **Back-end:** PHP 8.2+ · Laravel
- **Banco de Dados:** MySQL
- **Front-end:** Blade · Bootstrap 5 · Bootstrap Icons · Select2 · Chart.js

---

## Como Executar o Projeto Localmente

### Pré-requisitos
- PHP 8.2 ou superior
- Composer
- MySQL ou MariaDB
- Node.js & NPM (opcional, caso deseje compilar assets localmente)

### Passo a passo

1. **Clone o repositório:**
   ```bash
   git clone [https://github.com/ThurPjh/Gestao-de-Estagios-e-Convenios.git](https://github.com/ThurPjh/Gestao-de-Estagios-e-Convenios.git)
   cd Gestao-de-Estagios-e-Convenios
   ```

2. **Instale as dependências do PHP:**
   ```bash
   composer install
   ```

3. **Configure o arquivo de ambiente:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Abra o arquivo `.env` e ajuste as credenciais de conexão com o seu banco de dados MySQL (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4. **Execute as migrations e popule os dados iniciais:**
   ```bash
   php artisan migrate --seed
   ```

5. **Crie o link simbólico para armazenamento dos arquivos PDF:**
   ```bash
   php artisan storage:link
   ```

6. **Inicie o servidor local:**
   ```bash
   php artisan serve
   ```
   Acesse `http://127.0.0.1:8000` no navegador.

---

## Estrutura de Pastas Relevante

```text
├── app/
│   ├── Http/Controllers/   # Regras de negócio (Documentos, Empréstimos, Alunos, etc.)
│   └── Models/             # Relacionamentos Eloquent
├── database/
│   ├── migrations/         # Estrutura das tabelas do banco de dados
│   └── seeders/            # Dados iniciais de cursos, assuntos, estrutura e usuário padrão
├── resources/views/        # Interfaces Blade organizadas por módulo
└── routes/web.php          # Definição das rotas protegidas por autenticação
```

---

## Licença

Projeto desenvolvido no âmbito de extensão acadêmica e estágio supervisionado — **UniAtenas**.
