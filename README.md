# Site – Assembleia de Deus Ministério Moreira (Mairiporã)

Site estático pronto para a Vercel. A Vercel não executa PHP, então o PHP virou **fonte**: ele gera o `public/index.html`.

## Estrutura
```
public/        → o que vai ao ar (index.html, assets/, 404.html, robots.txt)
src/           → fonte em PHP (index.php, includes/config.php, includes/conteudo.php)
build.php      → gera public/index.html a partir de src/
vercel.json    → configuração da Vercel (pasta de saída: public)
```

## Publicar na Vercel (grátis)
**Opção A – GitHub (recomendada, atualiza sozinha a cada commit)**
1. Crie um repositório no GitHub e envie esta pasta inteira.
2. Em vercel.com → *Add New… → Project* → importe o repositório.
3. Não mude nada (Framework: Other). Clique em *Deploy*.

**Opção B – Arrastar pasta (CLI)**
```
npm i -g vercel
vercel --prod
```

## Como atualizar o conteúdo
- **Textos, cultos, ministérios, contatos:** edite `src/index.php` e `src/includes/config.php`.
- **Pregações:** cole os IDs do YouTube em `src/includes/conteudo.php`.
- **Fotos da obra:** coloque as imagens em `public/assets/img/obra/` (nomes sem espaços, ex.: `obra-18.jpg`).
- Depois rode `php build.php` e envie as mudanças. (Sem PHP instalado? Edite direto o `public/index.html`.)

## O que mudou para a Vercel
- Próximo culto e ano do rodapé agora são calculados no navegador (fuso de São Paulo), pois não há servidor PHP.
- Carrossel da obra gerado no build; fotos renomeadas (`obra-01.jpg`…), sem espaços, e redimensionadas.
- Removidos `.htaccess` (Apache) e imagens duplicadas/não usadas.
- Adicionados `vercel.json`, `404.html` e `robots.txt`.
