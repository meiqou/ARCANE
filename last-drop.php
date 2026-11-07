<?php
$place = [
    'city' => 'zaun',
    'hero_image' => 'images/zaunbar.jpg',
    'title' => 'The Last Drop',
    'eyebrow' => 'Undercity · Zaun landmark',
    'heading' => 'The <span class="hl"><i>Last Drop</i></span>',
    'lead' => 'A neighborhood bar and refuge where Zaun’s families and fighters find shelter, community, and a place to regroup.',
    'article_eyebrow' => 'A closer look · Zaun',
    'article_title' => 'A refuge in the Undercity',
    'article_lead' => 'In a city that asks its people to endure, the Last Drop offers more than a drink. It is a gathering place, a safe harbor, and a home shaped by the people who depend on it.',
    'sections' => [
        [
            'heading' => 'More than a neighborhood bar',
            'paragraphs' => [
                'The Last Drop stands at the heart of its neighborhood. People come through its doors to meet, exchange news, find a moment of warmth, or escape the pressures of the streets outside.',
                'Its importance comes from those relationships. For Zaun’s residents, a familiar room and a trusted face can mean safety and belonging in a city where both are hard won.',
            ],
        ],
        [
            'heading' => 'Vander’s hard-won peace',
            'paragraphs' => [
                'Under Vander’s care, the Last Drop became a gathering point for the community and a reflection of his effort to protect its people. His influence rests not just on strength, but on the trust he has earned.',
                'Keeping the peace is never simple. Old conflicts and the pressure from above threaten the fragile balance he tries to preserve, especially for the young people who look to him for shelter.',
            ],
        ],
        [
            'heading' => 'A home shaped by family',
            'paragraphs' => [
                'For Vi and Jinx, the Last Drop is tied to memories of family, loss, and the life they shared in Zaun. It is a place that carries the warmth of community as well as the weight of everything that can change.',
                'That combination makes the bar feel like a crossroads: a place where people gather to hold on to one another, even as the city around them pulls in different directions.',
            ],
        ],
    ],
    'quote' => 'You’ve got a good heart. Don’t ever lose it. No matter how the world tries to break you. Protect the family',
    'quote_by' => '- Vander',
    'spotlight_title' => 'Meet the Last Drop’s family',
    'spotlight_lead' => 'Vander, Vi, and Jinx are bound to the bar by the fragile ties of home, protection, and family.',
    'characters' => [
        [
            'id' => 'vander',
            'image' => 'images/vander.webp',
            'name' => 'Vander',
            'eyebrow' => 'The Hound of the Underground',
            'description' => 'A former revolutionary who becomes a guardian to Zaun’s children and works to keep the peace.',
        ],
        [
            'id' => 'vi',
            'image' => 'images/vi.jpg',
            'name' => 'Vi',
            'eyebrow' => 'The brawler',
            'description' => 'A streetwise fighter driven by loyalty, grit, and a determination to protect the people she loves.',
        ],
        [
            'id' => 'jinx',
            'image' => 'images/jinx.jpg',
            'name' => 'Jinx',
            'eyebrow' => 'The loose cannon',
            'description' => 'A gifted inventor whose turbulent past and unpredictable choices make her impossible to ignore.',
        ],
    ],
];
require __DIR__ . '/includes/landmark-page.php';
