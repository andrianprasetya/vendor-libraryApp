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
        'web/karyawan' => [
            'index' => 'index',
            'action' => ['index', 'detail', 'create', 'edit'],
        ],
        'web/dashboard' => [
            'index' => 'index',
            'action' => ['index'],
        ],
        'web/sirkulasi/peminjaman' => [
            'index' => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'delete'],
        ],
        'web/sirkulasi/pengembalian' => [
            'index' => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'delete'],
        ],
        'web/sirkulasi/perpanjangan' => [
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
        ]

    ]
];
