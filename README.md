# Biblioteca - Laravel MVC (Blade) Skeleton

Projeto Laravel (MVC com Blade) para sistema de gestão de biblioteca.

**Conteúdo**
- migrations (autores, categorias, livros, locacoes, users extras)
- Models
- Controllers MVC (retornando views Blade)
- Views Blade com Bootstrap 5 (layout, index/create/edit/show)
- Simple Auth (Login/Register controllers + views)
- `routes/web.php`
- `.env.example`

Como usar:
1. Crie um projeto Laravel 10+ ou copie os arquivos para a estrutura do seu projeto.
2. Ajuste `.env` com as credenciais do banco.
3. Rode `composer install` (se necessário) e `php artisan migrate`.
4. Acesse a aplicação no navegador (por padrão `http://localhost:8000`) após `php artisan serve`.
