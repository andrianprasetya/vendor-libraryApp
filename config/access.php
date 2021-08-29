<?php

return [

    'delimiter' => ',',

    /**
     * Menu action list that can be have.
     */
    'menu' => [
        'web/member' => [
            'index' => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'status'],
        ],
        'web/dashboard' => [
            'index' => 'index',
            'action' => ['index'],
        ],
        'web/sirkulasi/peminjaman' => [
            'index' => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'delete'],
        ],
        'web/sirkulasi/perpanjangan' => [
            'index' => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'delete'],
        ],
        'web/sirkulasi/denda' => [
            'index' => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'delete'],
        ],
        'web/opac' => [
            'index' => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'delete'],
        ],
        'web/book' => [
            'index' => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'delete'],
        ],
        'web/report/gmd' => [
            'index' => 'index',
            'action' => ['index', 'detail'],
        ],
        'web/report/member' => [
            'index' => 'index',
            'action' => ['index', 'detail'],
        ],
        'web/report/collection' => [
            'index' => 'index',
            'action' => ['index', 'detail'],
        ],
        'web/report/language' => [
            'index' => 'index',
            'action' => ['index', 'detail'],
        ]


    ]
];
