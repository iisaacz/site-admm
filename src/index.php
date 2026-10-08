<?php
date_default_timezone_set('America/Sao_Paulo');
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/conteudo.php';

$menu = [
    'inicio'      => 'Início',
    'igreja'      => 'A Igreja',
    'cultos'      => 'Cultos',
    'ministerios' => 'Ministérios',
    'pregacoes'   => 'Pregações',
    'obra'        => 'Obra',
    'contato'     => 'Contato',
];

// Próximo culto
$mapa = ['Domingo' => 0, 'Segunda' => 1, 'Quarta' => 3, 'Sexta' => 5];
$agora = new DateTime('now');
$proximo = null;
foreach (CULTOS as $c) {
    $hora = (int) $c['hora'];
    $dif = ($mapa[$c['dia']] - (int) $agora->format('w') + 7) % 7;
    $d = (clone $agora)->modify("+$dif day")->setTime($hora, 0);
    if ($d < $agora) { $d->modify('+7 day'); }
    if ($proximo === null || $d < $proximo['data']) { $proximo = ['data' => $d, 'culto' => $c]; }
}
$semana = (int) ceil((int) $proximo['data']->format('j') / 7);
$tipo = '';
foreach ($proximo['culto']['semanas'] as $rot => $nome) {
    if ((int) $rot === $semana) { $tipo = $nome; }
}
$dias = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
$fotos = fotos_obra();
$mapaUrl = 'https://www.google.com/maps?q=' . rawurlencode(SITE['endereco'] . ', ' . SITE['cidade_uf'] . ', ' . SITE['cep']) . '&output=embed';
?><!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e(SITE['nome_longo']) ?></title>
<meta name="description" content="Assembleia de Deus Ministério Moreira em Mairiporã. Horários de cultos, ministérios, pregações e como contribuir com a obra.">
<meta name="theme-color" content="#0b2447">
<meta property="og:title" content="<?= e(SITE['nome_longo']) ?>">
<meta property="og:type" content="website">
<meta property="og:locale" content="pt_BR">
<link rel="icon" href="<?= img('logo.png') ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="header">
  <div class="wrap header-in">
    <a class="brand" href="#inicio">
      <img src="<?= img('logo.png') ?>" alt="Logo da igreja">
      <span><strong>Assembleia de Deus</strong><small>Ministério Moreira · Mairiporã</small></span>
    </a>
    <button class="menu-btn" aria-label="Abrir menu" aria-expanded="false" id="menuBtn">☰</button>
    <nav class="nav" aria-label="Principal">
      <?php foreach ($menu as $id => $rotulo): ?>
        <a href="#<?= $id ?>"><?= e($rotulo) ?></a>
      <?php endforeach; ?>
    </nav>
  </div>
</header>

<main>

<section class="hero" id="inicio">
  <div class="wrap hero-in">
    <div class="hero-txt">
      <p class="eyebrow">Mairiporã · SP</p>
      <h1>Assembleia de Deus<br>Ministério Moreira</h1>
      <p class="lead">Uma casa de oração aberta para você e sua família. Venha adorar conosco.</p>
      <div class="hero-btns">
        <a class="btn btn-claro" href="#cultos">Horários dos cultos</a>
        <a class="btn btn-borda" href="#contato">Como chegar</a>
        <br><a class="btn btn-claro" href="#pix" style="margin-top: 12px;">Doe!</a>
      </div>
    </div>
    <div class="hero-prox">
      <p class="eyebrow">Próximo culto</p>
      <p class="prox-dia" id="prox-dia"><?= e($dias[(int) $proximo['data']->format('w')]) ?> · <?= e($proximo['culto']['hora']) ?></p>
      <p class="prox-nome" id="prox-nome"><?= e($proximo['culto']['titulo']) ?></p>
      <p class="prox-tipo" id="prox-tipo"<?= $tipo ? '' : ' hidden' ?>><?= e($tipo) ?></p>
      <p class="prox-data" id="prox-data"><?= $proximo['data']->format('d/m/Y') ?></p>
    </div>
  </div>
</section>

<section class="sec" id="igreja">
  <div class="wrap">
    <h2 class="titulo">A Igreja</h2>
    <div class="estreito texto">
      <p>A Assembléia de Deus chegou ao Brasil por intermédio dos missionários suecos Gunnar Vingren e Daniel Berg, que aportaram em Belém, capital do Estado do Pará, em 19 de novembro de 1910, vindos dos Estados Unidos.</p>
<p>Movidos pelo Espírito Santo e pelo desejo de realizar a grande obra em nosso país, famílias deixavam suas localidades para cumprir o propósito definido pelo Mestre: “Ide por todo o mundo, pregai o Evangelho a toda criatura” (Marcos 16.15). Para estes pioneiros, o mundo era o nosso Brasil.</p>
<p>Ainda hoje, a mesma chama que ardia naqueles corações permanece acesa em tantos outros que, com essa mesma missão, rompeu até mesmo as fronteiras nacionais.</p>
<p>A Assembleia de Deus Ministério Moreira – Mairiporã é uma igreja que se reúne para adorar à Deus, estudar a Palavra e Pregar o Evangelho à toda criatura.</p>
<p>Aqui você encontra cultos durante a semana, ministérios para todas as idades e uma liderança pastoral próxima da igreja. Venha adorar conosco!</p>
    </div>
    <h3 class="subtitulo">Nossa Liderança</h3>
    <div class="grid3">
      <?php foreach (LIDERANCA as $l): ?>
        <article class="lider">
          <img src="<?= img(str_replace('.jpg','-redondo.jpg',$l['foto'])) ?>" alt="<?= e($l['nome']) ?>" loading="lazy">
          <h3><?= e($l['cargo']) ?></h3>
          <p><?= e($l['nome']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec sec-alt" id="cultos">
  <div class="wrap">
    <h2 class="titulo">Cultos e Horários</h2>
    <div class="lista-cultos">
      <?php foreach (CULTOS as $c): ?>
        <details class="culto-item">
          <summary><span class="cd"><?= e($c['dia']) ?></span><span class="hora"><?= e($c['hora']) ?></span></summary>
          <div class="culto-corpo">
            <p class="culto-titulo"><?= e($c['titulo']) ?></p>
            <?php if ($c['semanas']): ?>
              <ul class="semanas">
                <?php foreach ($c['semanas'] as $sem => $nome): ?>
                  <li><span><?= e($sem) ?></span><?= e($nome) ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
        </details>
      <?php endforeach; ?>
    <details class="culto-item">
        <summary><span class="cd">Oração da Manhã</span><span class="hora">8h às 9h</span></summary>
        <div class="culto-corpo"><p>Domingo, Segunda, Quarta e Sexta das 8h às 9h da manhã</p></div>
      </details>
    <details class="culto-item">
        <summary><span class="cd">Escola Bíblica Dominical</span><span class="hora">9h às 11h</span></summary>
        <div class="culto-corpo"><p>Escola Bíblica Dominical todo Domingo das 9h ás 11h</p></div>
      </details>
    </div>
    <div class="aviso">
      <h3>Assista online</h3>
      <p>Acompanhe os cultos pelo YouTube e Instagram.</p>
      <a class="btn" href="<?= e(SITE['youtube']) ?>" target="_blank" rel="noopener">YouTube</a>
      <a class="btn btn-borda-esc" href="<?= e(SITE['instagram']) ?>" target="_blank" rel="noopener">Instagram</a>
    </div>
  </div>
</section>

<section class="sec" id="ministerios">
  <div class="wrap">
    <h2 class="titulo">Ministérios</h2>
    <div class="grid3">
      <?php foreach (MINISTERIOS as $m): ?>
        <article class="min">
          <span class="ico"><?= icone($m['icone']) ?></span>
          <h3><?= e($m['nome']) ?></h3>
          <p><?= e($m['desc']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec sec-alt" id="pregacoes">
  <div class="wrap">
    <h2 class="titulo">Pregações</h2>
    <?php if (PREGACOES): ?>
      <div class="player">
        <iframe id="player" src="https://www.youtube.com/embed/<?= e(PREGACOES[0]['id']) ?>" title="Pregação" loading="lazy" allowfullscreen
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
      </div>
      <div class="grid3">
        <?php foreach (PREGACOES as $p): ?>
          <a class="video" href="#pregacoes" data-id="<?= e($p['id']) ?>">
            <img src="https://i.ytimg.com/vi/<?= e($p['id']) ?>/hqdefault.jpg" alt="" loading="lazy">
            <span class="play">▶</span>
            <span class="video-t"><?= e($p['titulo']) ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="centro">Assista às pregações e cultos completos no nosso canal.</p>
    <?php endif; ?>
    <p class="centro"><a class="btn" href="<?= e(SITE['youtube']) ?>" target="_blank" rel="noopener">Abrir canal no YouTube</a></p>
  </div>
</section>

<section class="sec" id="obra">
  <div class="wrap">
    <h2 class="titulo">Obra</h2>

    <div class="carrossel" id="carrossel">
      <?php if ($fotos): ?>
        <div class="car-pista">
          <?php foreach ($fotos as $i => $f): ?>
            <figure class="car-slide"><img src="<?= e($f) ?>" alt="Foto da obra <?= $i + 1 ?>" loading="<?= $i ? 'lazy' : 'eager' ?>"></figure>
          <?php endforeach; ?>
        </div>
        <?php if (count($fotos) > 1): ?>
          <button class="car-btn car-prev" type="button" aria-label="Foto anterior">‹</button>
          <button class="car-btn car-next" type="button" aria-label="Próxima foto">›</button>
          <div class="car-pontos"></div>
        <?php endif; ?>
      <?php else: ?>
        <p class="car-vazio">Fotos da obra em breve.<br>Adicione as imagens em <code>assets/img/obra/</code>.</p>
      <?php endif; ?>
    </div>

    <div class="obra-msg">
      <p>Há aproximadamente 1 ano e 3 meses, no dia 16/07/2025, demos início a um grande projeto: a construção do nosso templo próprio da igreja de Mairiporã.</p>
      <p>Essa obra só foi possível graças à generosidade e ao coração de muitas pessoas, que contribuíram com aquilo que podiam e ajudaram a transformar essa promessa em realidade. Cada doação, independentemente do valor, foi e continua sendo muito importante para que possamos avançar.</p>
      <p>Hoje, ainda temos um longo caminho pela frente e precisamos da sua contribuição para dar continuidade a essa obra.</p>
      <p>Se você puder ajudar, seja com uma pequena ou grande contribuição, estará fazendo parte dessa construção e ajudando a preparar um espaço cada vez melhor para receber nossa comunidade, celebrar nossa fé e acolher muitas pessoas.</p>
      <p class="destaque">Toda contribuição faz a diferença!</p>
      <p>Ajude-nos a continuar essa obra.<br>Faça parte desse projeto.<br>Sua contribuição é muito importante para nós!</p>
    </div>

    <div class="pix-box" id="pix">
      <h3>DOE ATRAVÉS DO PIX</h3>
      <img class="qr" src="<?= img('qrcode-pix.png') ?>" alt="QR Code PIX" loading="lazy">
      <p>Chave Pix:</p>
      <p class="chave"><?= e(SITE['pix']) ?></p>
      <button class="btn" type="button" id="copiar" data-chave="<?= e(SITE['pix']) ?>">Copiar chave</button>
    </div>

    <div class="obra-msg obra-fim">
      <p>Que Deus abençoe grandemente cada pessoa que já contribuiu e todos aqueles que ainda poderão nos ajudar.</p>
      <p>Juntos, com fé e união, vamos concluir essa obra!</p>
      <blockquote>“Cada um dê conforme determinou em seu coração, não com pesar ou por obrigação, pois Deus ama quem dá com alegria.”<cite>2 Coríntios 9:7 </cite></blockquote>
    </div>
  </div>
</section>

<section class="sec sec-alt" id="contato">
  <div class="wrap">
    <h2 class="titulo">Contato</h2>
    <div class="grid2">
      <div class="contato-info">
        <h3>Endereço</h3>
        <p><?= e(SITE['endereco']) ?><br><?= e(SITE['cidade_uf']) ?><br>CEP <?= e(SITE['cep']) ?></p>
        <h3>E-mail</h3>
        <p><a href="mailto:<?= e(SITE['email']) ?>"><?= e(SITE['email']) ?></a></p>
        <h3>Redes sociais</h3>
        <p>
          <a href="<?= e(SITE['instagram']) ?>" target="_blank" rel="noopener">Instagram</a> ·
          <a href="<?= e(SITE['youtube']) ?>" target="_blank" rel="noopener">YouTube</a> ·
          <a href="<?= e(SITE['facebook']) ?>" target="_blank" rel="noopener">Facebook</a>
        </p>
      </div>
      <div class="mapa">
        <iframe title="Mapa da igreja" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="<?= $mapaUrl ?>"></iframe>
      </div>
    </div>
  </div>
</section>

</main>

<footer class="footer">
  <div class="wrap footer-grid">
    <div>
      <img class="footer-logo" src="<?= img('logo.png') ?>" alt="Logo da igreja">
      <p><strong><?= e(SITE['nome']) ?></strong><br>Mairiporã – SP</p>
    </div>
    <div>
      <h4>Visite-nos</h4>
      <p><?= e(SITE['endereco']) ?><br><?= e(SITE['cidade_uf']) ?> · CEP <?= e(SITE['cep']) ?></p>
      <p><a href="mailto:<?= e(SITE['email']) ?>"><?= e(SITE['email']) ?></a></p>
    </div>
    <div>
      <h4>Cultos</h4>
      <ul>
        <?php foreach (CULTOS as $c): ?>
          <li><?= e($c['dia']) ?> · <?= e($c['hora']) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h4>Siga-nos</h4>
      <ul>
        <li><a href="<?= e(SITE['instagram']) ?>" target="_blank" rel="noopener">Instagram</a></li>
        <li><a href="<?= e(SITE['youtube']) ?>" target="_blank" rel="noopener">YouTube</a></li>
        <li><a href="<?= e(SITE['facebook']) ?>" target="_blank" rel="noopener">Facebook</a></li>
      </ul>
    </div>
  </div>
  <div class="copy">© <span id="ano"><?= date('Y') ?></span> <?= e(SITE['nome_longo']) ?>. Todos os direitos reservados.</div>
</footer>

<script>
(function () {
  // Próximo culto (calculado no navegador, no fuso de São Paulo)
  var CULTOS = <?= json_encode(array_map(function ($c) use ($mapa) {
      return ['w' => $mapa[$c['dia']], 'h' => (int) $c['hora'], 'titulo' => $c['titulo'], 'semanas' => $c['semanas']];
  }, CULTOS), JSON_UNESCAPED_UNICODE) ?>;
  var DIAS = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
  function proximoCulto() {
    var p = {};
    new Intl.DateTimeFormat('en-US', {
      timeZone: 'America/Sao_Paulo', year: 'numeric', month: 'numeric', day: 'numeric',
      hour: 'numeric', minute: 'numeric', hourCycle: 'h23'
    }).formatToParts(new Date()).forEach(function (x) { p[x.type] = parseInt(x.value, 10); });
    var agora = Date.UTC(p.year, p.month - 1, p.day, p.hour, p.minute);
    var dow = new Date(Date.UTC(p.year, p.month - 1, p.day)).getUTCDay();
    var melhor = null;
    CULTOS.forEach(function (c) {
      var dif = (c.w - dow + 7) % 7;
      var t = Date.UTC(p.year, p.month - 1, p.day + dif, c.h, 0);
      if (t < agora) { t += 7 * 86400000; }
      if (!melhor || t < melhor.t) { melhor = { t: t, c: c }; }
    });
    return melhor;
  }
  (function () {
    var r = proximoCulto(), d = new Date(r.t);
    var semana = Math.ceil(d.getUTCDate() / 7), tipo = '';
    Object.keys(r.c.semanas).forEach(function (k) { if (parseInt(k, 10) === semana) { tipo = r.c.semanas[k]; } });
    function z(n) { return (n < 10 ? '0' : '') + n; }
    document.getElementById('prox-dia').textContent = DIAS[d.getUTCDay()] + ' · ' + r.c.h + 'h';
    document.getElementById('prox-nome').textContent = r.c.titulo;
    var t = document.getElementById('prox-tipo');
    t.textContent = tipo; t.hidden = !tipo;
    document.getElementById('prox-data').textContent = z(d.getUTCDate()) + '/' + z(d.getUTCMonth() + 1) + '/' + d.getUTCFullYear();
    document.getElementById('ano').textContent = new Date().getFullYear();
  })();

  var btn = document.getElementById('menuBtn');
  btn.addEventListener('click', function () {
    document.body.classList.toggle('menu-aberto');
    btn.setAttribute('aria-expanded', document.body.classList.contains('menu-aberto'));
  });
  document.querySelectorAll('.nav a').forEach(function (a) {
    a.addEventListener('click', function () {
      document.body.classList.remove('menu-aberto');
      btn.setAttribute('aria-expanded', 'false');
    });
  });

  // Item ativo no menu
  var links = {};
  document.querySelectorAll('.nav a').forEach(function (a) { links[a.getAttribute('href').slice(1)] = a; });
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (es) {
      es.forEach(function (en) {
        if (en.isIntersecting) {
          Object.keys(links).forEach(function (k) { links[k].classList.remove('ativo'); });
          if (links[en.target.id]) links[en.target.id].classList.add('ativo');
        }
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    document.querySelectorAll('main section[id]').forEach(function (s) { io.observe(s); });
  }

  // Copiar chave Pix
  var cp = document.getElementById('copiar');
  cp.addEventListener('click', function () {
    var t = cp.dataset.chave;
    var ok = function () { cp.textContent = 'Chave copiada!'; setTimeout(function () { cp.textContent = 'Copiar chave'; }, 2000); };
    if (navigator.clipboard) { navigator.clipboard.writeText(t).then(ok); }
    else { var i = document.createElement('input'); i.value = t; document.body.appendChild(i); i.select(); document.execCommand('copy'); i.remove(); ok(); }
  });

  // Player de pregações
  var pl = document.getElementById('player');
  if (pl) {
    document.querySelectorAll('.video[data-id]').forEach(function (v) {
      v.addEventListener('click', function (ev) {
        ev.preventDefault();
        pl.src = 'https://www.youtube.com/embed/' + v.dataset.id + '?autoplay=1';
        pl.scrollIntoView({ behavior: 'smooth', block: 'center' });
      });
    });
  }

  // Carrossel
  var car = document.getElementById('carrossel');
  var pista = car && car.querySelector('.car-pista');
  if (pista) {
    var slides = pista.children, n = slides.length, pontos = car.querySelector('.car-pontos'), atual = 0, timer;
    if (pontos) {
      for (var i = 0; i < n; i++) {
        (function (i) {
          var b = document.createElement('button');
          b.type = 'button'; b.setAttribute('aria-label', 'Foto ' + (i + 1));
          b.addEventListener('click', function () { ir(i); parar(); });
          pontos.appendChild(b);
        })(i);
      }
    }
    function marcar() {
      if (!pontos) return;
      Array.prototype.forEach.call(pontos.children, function (b, i) { b.classList.toggle('on', i === atual); });
    }
    function ir(i) {
      atual = (i + n) % n;
      pista.scrollTo({ left: slides[atual].offsetLeft - pista.offsetLeft, behavior: 'smooth' });
      marcar();
    }
    function parar() { clearInterval(timer); }
    pista.addEventListener('scroll', function () {
      var i = Math.round(pista.scrollLeft / pista.clientWidth);
      if (i !== atual) { atual = i; marcar(); }
    }, { passive: true });
    var p = car.querySelector('.car-prev'), nx = car.querySelector('.car-next');
    if (p) p.addEventListener('click', function () { ir(atual - 1); parar(); });
    if (nx) nx.addEventListener('click', function () { ir(atual + 1); parar(); });
    marcar();
    if (n > 1) timer = setInterval(function () { ir(atual + 1); }, 5000);
    pista.addEventListener('pointerdown', parar);
  }
})();
</script>
</body>
</html>
