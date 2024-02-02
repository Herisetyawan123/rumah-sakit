<?php

return [
    'cms' => [
        // icon can use themify icon or fontawesome
        // Menu for kasir

        [
            'title' => 'Dashboard',
            'url' => '/cms/dashboard',
            'icon' => 'icon-grid menu-icon',
            'permission' => 'cms.dashboard.viewAny',
            'childern' => []
        ],
        [
            'title' => 'Master Data',
            'url' => '',
            'icon' => 'fa-solid fa-people-group',
            'permission' => 'cms.admins.viewAny|cms.roles.viewAny|cms.pasien.viewAny|cms.dokter.viewAny|cms.banks.viewAny',
            'childern' => [
                [
                    'title' => 'Kasir',
                    'url' => '/cms/kasir',
                    'icon' => 'fa-solid fa-people-group',
                    'permission' => 'cms.admins.viewAny',
                    'childern' => []
                ],
                [

                    'title' => 'Pasien',
                    'url' => '/cms/pasien',
                    'icon' => 'fa-solid fa-people-group',
                    'permission' => 'cms.pasien.viewAny',
                    'childern' => []
                ],
                [
                    'title' => 'Dokter',
                    'url' => '/cms/dokter',
                    'icon' => 'fa-solid fa-people-group',
                    'permission' => 'cms.dokter.viewAny',
                    'childern' => []
                ],
                [
                    'title' => 'Bank',
                    'url' => '/cms/bank',
                    'icon' => 'fa-solid fa-money-check-dollar',
                    'permission' => 'cms.banks.viewAny',
                    'childern' => []
                ],
                // [
                //     'title' => 'Role',
                //     'url' => '/cms/roles',
                //     'icon' => 'fa-solid fa-people-group',
                //     'permission' => 'cms.roles.viewAny',
                //     'childern' => []

                // ]
            ],
        ],

        // [
        //     'title' => 'Obat',
        //     'url' => '',
        //     'icon' => 'fa-solid fa-pills',
        //     'permission' => 'cms.kategori_obat.viewAny|cms.obat.viewAny',
        //     'childern' => [
        //         [
        //             'title' => 'Kategori Obat',
        //             'url' => '/cms/kategori-obat',
        //             'icon' => 'fa-solid fa-people-group',
        //             'permission' => 'cms.kategori_obat.viewAny',
        //             'childern' => []
        //         ],
        //         [
        //             'title' => 'Obat',
        //             'url' => '/cms/obat',
        //             'icon' => 'fa-solid fa-people-group',
        //             'permission' => 'cms.obat.viewAny',
        //             'childern' => []
        //         ],
        //     ]
        // ],
        [
            'title' => 'Pesan masuk',
            'url' => '/cms/chat',
            'icon' => 'fa-solid fa-comments',
            'permission' => 'cms.konsultasi.viewAny',
            'childern' => [
                // [
                //     'title' => 'List Pembayaran',
                //     'url' => '/cms/konsultasi',
                //     'icon' => 'fa-solid fa-comments',
                //     'permission' => 'cms.konsultasi.viewAny',
                //     'childern' => []
                // ],
                // [
                //     'title' => 'Riwayat Transaksi',
                //     'url' => '/cms/riwayat-konsultasi',
                //     'icon' => 'fa-solid fa-comments',
                //     'permission' => 'cms.konsultasi.viewAny',
                //     'childern' => []
                // ],
                ]
            ],
            [
                'title' => 'Resep & Diagnosa',
                'url' => '/cms/resep-n-diagnosa',
                'icon' => 'fa-solid fa-file-signature',
                'permission' => 'cms.resep_n_diagnosa.viewAny',
                'childern' => []
            ],
            [
                'title' => 'Transaksi Obat',
                'url' => '',
                'icon' => 'fa-solid fa-file-invoice-dollar',
                'permission' => 'cms.transaksi_obat.viewAny',
                'childern' => [
                    [
                        'title' => 'Daftar Transaksi',
                        'url' => '/cms/transaksi-obat',
                        'icon' => 'fa-solid fa-file-invoice-dollar',
                        'permission' => 'cms.transaksi_obat.viewAny',
                        'childern' => []
                    ],
                    [
                        'title' => 'Riwayat Transaksi',
                        'url' => '/cms/riwayat-transaksi-obat',
                        'icon' => 'fa-solid fa-file-invoice-dollar',
                        'permission' => 'cms.transaksi_obat.viewAny',
                        'childern' => []
                    ],
                ]
            ],


        // Menu for dokter
        [
            'title' => 'Dashboard',
            'url' => '/dokter/dashboard',
            'icon' => 'icon-grid fa-solid fa-house',
            'permission' => 'dokter.dashboard.viewAny',
            'childern' => []
        ],
        [
            'title' => 'Resep & Diagnosa',
            'url' => '/dokter/resep-n-diagnosa',
            'icon' => 'icon-grid fa-solid fa-file-signature',
            'permission' => 'dokter.dashboard.viewAny',
            'childern' => []
        ],
        // [
        //     'title' => 'Konsultasi',
        //     'url' => '/dokter/resep-n-diagnosa',
        //     'icon' => 'fa-solid fa-comments',
        //     'permission' => 'dokter.konsultasi.viewAny',
        //     'childern' => [
        //         [
        //             'title' => 'Konsultasi',
        //             'url' => '/dokter/konsultasi',
        //             'icon' => 'icon-grid fa-solid fa-file-signature',
        //             'permission' => 'dokter.konsultasi.viewAny',
        //             'childern' => []
        //         ],
        //         [
        //             'title' => 'Riwat Konsultasi',
        //             'url' => '/dokter/riwayat-konsultasi',
        //             'icon' => 'icon-grid fa-solid fa-file-signature',
        //             'permission' => 'dokter.riwayat-konsultasi.viewAny',
        //             'childern' => []
        //         ],
        //     ]
        // ],


    ]
];
