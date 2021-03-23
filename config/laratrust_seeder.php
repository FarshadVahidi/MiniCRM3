<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'companies' => 'c,r,u,d',
            'profile' => 'c,r,u,d',
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'companies' => 'c,r,u',
            'profile' => 'c,r,u',
        ],
        'user' => [
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
