<?php
/*
 * PREGAÇÕES: cole o ID do vídeo do YouTube (trecho depois de "v=").
 * FOTOS DA OBRA: coloque as imagens em public/assets/img/obra/ (jpg, png, webp),
 * de preferência com nomes simples, sem espaços (ex.: obra-18.jpg).
 * Depois rode `php build.php`: o carrossel inclui todas, em ordem alfabética.
 */

const PREGACOES = [
    // ['id' => 'COLE_O_ID_AQUI', 'titulo' => 'Título da mensagem'],
];

function fotos_obra(): array {
    $f = glob(__DIR__ . '/../../public/assets/img/obra/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE) ?: [];
    sort($f);
    return array_map(fn($p) => 'assets/img/obra/' . basename($p), $f);
}
