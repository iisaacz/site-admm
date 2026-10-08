<?php
// Gera public/index.html a partir de src/index.php.
// Uso: php build.php
date_default_timezone_set('America/Sao_Paulo');
ob_start();
require __DIR__ . '/src/index.php';
$html = ob_get_clean();
file_put_contents(__DIR__ . '/public/index.html', $html);
echo "public/index.html gerado (" . strlen($html) . " bytes)\n";
