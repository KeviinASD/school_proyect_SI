<?php

return [

    'default' => 'tailwind',

    'connections' => [

        'tailwind' => [
            'view' => 'vendor.pagination.tailwind',
            'options' => [],
        ],

    ],

    'views' => [
        'simple' => 'pagination::simple-tailwind',
        'default' => 'pagination::tailwind',
    ],

];