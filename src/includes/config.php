<?php
// Dados centrais do site. Edite aqui para atualizar em todas as páginas.

const SITE = [
    'nome'        => 'Assembleia de Deus Ministério Moreira',
    'cidade'      => 'Mairiporã',
    'nome_longo'  => 'Assembleia de Deus Ministério Moreira – Mairiporã',
    'endereco'    => 'Rua do Verão, 588 – Parque Náutico',
    'cidade_uf'   => 'Mairiporã, SP',
    'cep'         => '07600-000',
    'email'       => 'admmoreira01@gmail.com',
    'pix'         => 'admmoreira01@gmail.com',
    'instagram'   => 'https://www.instagram.com/admmoreiramairipora/',
    'youtube'     => 'https://www.youtube.com/@ADMMoreira-Mairipor%C3%A3',
    'facebook'    => 'https://www.facebook.com/admoreirademairipora/',
    'youtube_channel_id' => 'UCSU_NQJPjWoNTinbo9dz6Rw',
];

const LIDERANCA = [
    [
        'cargo' => 'Pastor Presidente',
        'nome'  => 'Pastor Valdeni Fernandes e Missionária Teresinha',
        'foto'  => 'pastor-presidente.jpg',
    ],
    [
        'cargo' => 'Pastor Vice-Presidente',
        'nome'  => 'Pastor Camilo e Missionária Amparo',
        'foto'  => 'pastor-vice.jpg',
    ],
    [
        'cargo' => 'Pastor Local',
        'nome'  => 'Pastor Alexandre e Missionária Jacira',
        'foto'  => 'pastor-local.jpg',
    ],
];

// dia, hora, título, e as semanas do mês (tipo de culto)
const CULTOS = [
    [
        'dia' => 'Domingo', 'hora' => '18h', 'titulo' => 'Culto de Domingo',
        'semanas' => [
            '1º Domingo' => 'Santa Ceia',
            '2º Domingo' => 'Crianças',
            '3º Domingo' => 'Equipe de Louvor',
            '4º Domingo' => 'Adoração em Movimento',
        ],
    ],
    ['dia' => 'Segunda', 'hora' => '19h', 'titulo' => 'Culto com o Espírito Santo', 'semanas' => []],
    ['dia' => 'Quarta',  'hora' => '19h', 'titulo' => 'Culto de Doutrina', 'semanas' => []],
    [
        'dia' => 'Sexta', 'hora' => '19h', 'titulo' => 'Culto de Sexta',
        'semanas' => [
            '1ª Sexta' => 'Missões',
            '2ª Sexta' => 'Jovens',
            '3ª Sexta' => 'Varões',
            '4ª Sexta' => 'Círculo de Oração',
        ],
    ],
];

const MINISTERIOS = [
    ['nome' => 'Louvor',            'icone' => 'louvor', 'desc' => 'Ministério responsável por conduzir a igreja em momentos de adoração e louvor a Deus através da música.'],
    ['nome' => 'Crianças',          'icone' => 'criancas', 'desc' => 'Ministério dedicado às crianças, ensinando a Palavra de Deus de forma alegre, acolhedora e adequada para cada idade.'],
    ['nome' => 'Jovens',            'icone' => 'jovens', 'desc' => 'Ministério voltado para os jovens, promovendo comunhão, crescimento espiritual e fortalecimento da fé em Cristo.'],
    ['nome' => 'Círculo de Oração', 'icone' => 'oracao', 'desc' => 'Ministério dedicado à oração e intercessão, buscando a presença de Deus e apresentando a Ele as necessidades da igreja, famílias e comunidade.'],
    ['nome' => 'Dança',             'icone' => 'danca', 'desc' => 'Ministério que utiliza a dança e a expressão corporal como forma de adoração a Deus e de transmissão da mensagem do Evangelho.'],
    ['nome' => 'Varões',            'icone' => 'varoes', 'desc' => 'Ministério voltado aos homens da igreja, promovendo comunhão, fortalecimento espiritual e compromisso com Deus, a família e a obra do Senhor.'],
];

function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

function img(string $arquivo): string { return 'assets/img/' . $arquivo; }

function icone(string $k): string {
    $p = [
        'louvor'   => '<path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>',
        'criancas' => '<path d="M9 12h.01"/><path d="M15 12h.01"/><path d="M10 16c.5.3 1.2.5 2 .5s1.5-.2 2-.5"/><path d="M19 6.3a9 9 0 0 1 1.8 3.9 2 2 0 0 1 0 3.6 9 9 0 0 1-17.6 0 2 2 0 0 1 0-3.6A9 9 0 0 1 12 3c2 0 3.5 1.1 3.5 2.5s-.9 2.5-2 2.5c-.8 0-1.5-.4-1.5-1"/>',
        'jovens'   => '<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>',
        'oracao'   => '<path d="M12 22c-3-2-5-5-5-9l5-9 5 9c0 4-2 7-5 9z"/><path d="M12 4v18"/>',
        'danca'    => '<circle cx="12" cy="4" r="2"/><path d="M12 6v7"/><path d="M5 4l7 5 7-5"/><path d="M12 13l-4 8"/><path d="M12 13l4 8"/>',
        'varoes'   => '<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    ];
    return '<svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . ($p[$k] ?? '') . '</svg>';
}
