<?php
return [
    'namespace' => 'ui',
    'prefix' => 'ui-',
    'components' => [
        'avatar' => [
            'variants' => [],
        ],
        'button' => [
            'variants' => [
                // 'normal' => 'bg-primary text-white',
                'outlined' => 'border-2 border-current font-bold text-primary',
                'primary'  => 'bg-primary text-white [&>.svg-border]:stroke-white',
                'primary-300' => 'bg-primary-300 hover:bg-primary-300/90 text-white [&>.svg-border]:stroke-white',

                // 'rounded-sm'   => 'rounded-xl'
            ],
        ],
        'card' => [
            'variants' => [
                'normal' => 'bg-white text-neutral-700',
                'rounded-r' => 'px-7 py-12 rounded-2xl lg:rounded-tr-[10rem] rounded-tr-[6rem]',
                'rounded'   => 'rounded-lg'
            ],
        ],
        'checkbox' => [
            'variants' => [],
        ],
        'container' => [
            'variants' => [
                'compact' => ['max-w-2xl']
            ],
        ],
        'h1' => [
            'variants' => [
                'bold' => 'font-bold',
            ],
        ],
        'h2' => [
            'variants' => [
                'normal' => [],
                'bold' => 'font-bold',
            ],
        ],
        'h3' => [
            'variants' => [
                'normal' => [],
                'bold' => 'font-bold',
            ],
        ],
        'h4' => [
            'variants' => [
                'normal' => 'font-normal',
                'bold' => 'font-bold',
            ],
        ],
        'h5' => [
            'variants' => [
                'normal' => 'font-normal',
                'bold' => 'font-bold',
            ],
        ],
        'h6' => [
            'variants' => [
                'normal' => 'font-normal',
                'bold' => 'font-bold',
            ],
        ],
        'input' => [
            'variants' => [
                'none'     => ['bg-transparent border-0'],
                'normal'   => ['bg-white'],
                'outlined' => ['bg-transparent border border-white placeholder:text-white']
            ],
        ],
        'label' => [
            'variants' => [
                'normal' => 'block',
                'checkbox' => 'inline-flex items-center space-x-2 cursor-pointer select-none',
            ],
        ],
        'radio' => [
            'variants' => [],
        ],
        'section' => [
            'variants' => [
                'primary-300' => 'bg-primary-300 text-white'
            ],
        ],
        'select' => [
            'variants' => [],
        ],
        'textarea' => [
            'variants' => [],
        ],
    ],
];
