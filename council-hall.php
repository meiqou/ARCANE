<?php
$place = [
    'city' => 'piltover',
    'hero_image' => 'images/council.jpg',
    'title' => 'Council Hall',
    'eyebrow' => 'Topside · Piltover landmark',
    'heading' => 'Council <span class="hl"><i>Hall</i></span>',
    'lead' => "From this chamber, Piltover's ruling council steers the city's future—and weighs the cost of progress.",
    'article_eyebrow' => 'A closer look · Piltover',
    'article_title' => 'Where the city decides what comes next',
    'article_lead' => 'Council Hall is the center of Piltover’s civic power: a place where invention, trade, security, and the lives of two cities meet in every decision.',
    'sections' => [
        [
            'heading' => 'The seat of Piltover’s council',
            'paragraphs' => [
                'Piltover is governed by a small circle of influential councilors. Their chamber is where policies are debated, alliances are made, and the city’s priorities are set.',
                'The council’s authority reaches beyond its polished streets. Decisions made here shape trade and law throughout the twin cities, even when the people most affected have little say in them.',
            ],
        ],
        [
            'heading' => 'Power, persuasion, and progress',
            'paragraphs' => [
                'A seat on the council brings influence, but governing Piltover means balancing competing interests. Wealthy families, inventors, merchants, and public safety all press for a place in the city’s future.',
                'Mel Medarda understands that power is often exercised through patient negotiation. Caitlyn Kiramman approaches it from another direction: following evidence and confronting the consequences of the system she was raised to serve.',
            ],
        ],
        [
            'heading' => 'The cost beyond the chamber',
            'paragraphs' => [
                'Council debates can sound distant from the streets below, but their effects are felt across the bridge. Questions of access, security, and whose voices count make each choice more than an administrative matter.',
                'Council Hall represents Piltover at its most ambitious—and its most divided. The city’s challenge is not simply to make progress, but to decide who gets to shape it and who benefits from it.',
            ],
        ],
    ],
    'quote' => 'Progress is not a straight line. It is a series of difficult choices.',
    'quote_by' => '- Mel Medarda',
    'spotlight_title' => 'Meet Piltover’s leaders',
    'spotlight_lead' => 'Meet the inventors, investigators, and councilors whose ambitions and decisions shape Piltover.',
    'characters' => [
        [
            'id' => 'mel',
            'image' => 'images/mel.webp',
            'name' => 'Mel Medarda',
            'eyebrow' => 'The councilor',
            'description' => 'A perceptive political leader who uses diplomacy and strategy to shape Piltover’s future.',
        ],
        [
            'id' => 'caitlyn',
            'image' => 'images/caitlyn.webp',
            'name' => 'Caitlyn Kiramman',
            'eyebrow' => 'The sharp-eyed investigator',
            'description' => 'A principled investigator who follows the evidence, even when it challenges the order she was raised to defend.',
        ],
        [
            'id' => 'jayce',
            'image' => 'images/jayce.webp',
            'name' => 'Jayce Talis',
            'eyebrow' => 'The councillor and inventor',
            'description' => 'A celebrated inventor whose hextech discoveries bring him into the council chamber and the center of Piltover’s political choices.',
        ],
        [
            'id' => 'heimerdinger',
            'image' => 'images/heimer.png',
            'name' => 'Heimerdinger',
            'eyebrow' => 'The Academy’s founder',
            'description' => 'A long-serving scientist and educator who urges caution as Piltover pushes the boundaries of technological progress.',
        ],
        [
            'id' => 'cassandra',
            'image' => 'images/cassandrakiramman.jfif',
            'name' => 'Cassandra Kiramman',
            'eyebrow' => 'The Kiramman matriarch',
            'description' => 'A prominent member of Piltover’s elite whose family standing and civic influence reach into the council’s affairs.',
        ],
        [
            'id' => 'allira',
            'image' => 'images/allirasalo.jfif',
            'name' => 'Allira Salo',
            'eyebrow' => 'The councilor',
            'description' => 'A councilor who represents Piltover’s established interests as the city debates its next steps.',
        ],
        [
            'id' => 'torman',
            'image' => 'images/tormanhoskel.jfif',
            'name' => 'Torman Hoskel',
            'eyebrow' => 'The councilor',
            'description' => 'A member of Piltover’s ruling council, navigating the political interests gathered in Council Hall.',
        ],
        [
            'id' => 'irius',
            'image' => 'images/bolbok.webp',
            'name' => 'Irius Bolbok',
            'eyebrow' => 'The councilor',
            'description' => 'A councilor whose perspective adds another voice to the debates shaping Piltover’s future.',
        ],
    ],
];
require __DIR__ . '/includes/landmark-page.php';
