<?php
$place = [
    'city' => 'zaun',
    'hero_image' => 'images/firelights.jpg',
    'title' => 'Firelight Hideout',
    'eyebrow' => 'Undercity · Zaun landmark',
    'heading' => 'Firelight <span class="hl"><i>Hideout</i></span>',
    'lead' => 'Hidden among the Undercity’s industrial ruins, this refuge protects a community determined to build a better future.',
    'article_eyebrow' => 'A closer look · Zaun',
    'article_title' => 'A green refuge among the ruins',
    'article_lead' => 'The Firelights’ hidden home stands apart from the smoke and machinery around it. It is a shelter, a community, and a glimpse of what Zaun might become.',
    'sections' => [
        [
            'heading' => 'A sanctuary out of sight',
            'paragraphs' => [
                'Tucked away from the busiest streets, the hideout gives the Firelights room to protect their people and plan their next move. Its concealed location helps shield the community from the dangers that surround them.',
                'The refuge is not simply somewhere to hide. It is a place where people can live, recover, and work together beyond the reach of those who would exploit the Undercity.',
            ],
        ],
        [
            'heading' => 'Building another future',
            'paragraphs' => [
                'The Firelights resist the idea that Zaun must accept pollution, violence, and control as its only future. Their home reflects a different kind of ingenuity: one directed toward sustaining a community rather than extracting from it.',
                'Plants and shared spaces set the hideout apart from the industrial landscape. That contrast makes the refuge a quiet but powerful statement about what its residents are trying to preserve.',
            ],
        ],
        [
            'heading' => 'Ekko and the Firelights',
            'paragraphs' => [
                'Ekko leads with creativity, speed, and a deep commitment to the people around him. His inventions and the Firelights’ teamwork turn their knowledge of the Undercity into a way to defend their home.',
                'Their struggle is not only against a particular enemy; it is for the chance to choose their own direction. The hideout keeps that possibility alive.',
            ],
        ],
    ],
    'quote' => 'If your people had your way, it’d rubble and ash',
    'quote_by' => '- Ekko',
    'spotlight_title' => 'Meet the Firelights',
    'spotlight_lead' => 'Ekko, Scar, and Eve help lead and protect the Firelights and their refuge in Zaun.',
    'characters' => [
        [
            'id' => 'ekko',
            'image' => 'images/ekko.webp',
            'name' => 'Ekko',
            'eyebrow' => 'The Firelight',
            'description' => 'A resourceful inventor who leads his people with imagination and a belief in a better future for Zaun.',
        ],
        [
            'id' => 'scar',
            'image' => 'images/scar.webp',
            'name' => 'Scar',
            'eyebrow' => 'The Firelight warrior',
            'description' => 'A steadfast Firelight who fights to protect his community and the people who call the hideout home.',
        ],
        [
            'id' => 'eve',
            'image' => 'images/eve.webp',
            'name' => 'Eve',
            'eyebrow' => 'The Firelight scout',
            'description' => 'A resourceful member of the Firelights, helping defend their refuge and build a safer future for Zaun.',
        ],
    ],
];
require __DIR__ . '/includes/landmark-page.php';
