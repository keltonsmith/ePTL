<?php

return [
    'steps' => [
        'title' => 'Permohonan Baru',
        'first' => 'Kategori Permohonan',
        'second' => 'Maklumat permohonan',
        'third' => 'Maklumat Pembayaran Pemprosesan',
        'fourth' => 'Mesej Penghantaran'
    ],

    'statuses' => [
        'pending' => 'Dalam Proses',
        'approved' => 'Diluluskan',
        'rejected' => 'Ditolak'
    ],

    'files' => [
        'columns' => [
            'first' => 'No',
            'second' => 'Penerangan',
            'third' => 'Kedudukan Fail'
        ],
        'buttons' => [
            'select' => 'Pilih Fail',
            'change' => 'Tukar',
            'preview' => 'Preview',
            'remove' => 'Buang',
            'add'    => 'Click here to add more file'
        ],

        'rows' => [
            [
                'name' => 'design_concept',
                'title' => 'Pelan Rekabentuk Konsep',
                'subTitle' => "'Format PDF'",
                'sub' => false
            ],
            /*[
                'name' => 'Pelan_Lokasi',
                'title' => 'Pelan Lokasi (Google Earth)',
                'subTitle' => false,
                'sub' => false
            ],*/
            [
                'name' => 'image_location',
                'title' => 'Gambar',
                'subTitle' => 'Sekurangnya 1 gambar',
                'sub' => false,
                /*'sub' => [
                    [
                        'name' => 'Gambar_Lokasi-2'
                    ],
                    [
                        'name' => 'Gambar_Lokasi-3'
                    ]
                ]*/
            ],
            [
                'name' => 'review_letter',
                'title' => 'Surat Ulasan Pihak Ketiga',
                'subTitle' => 'Jika Berkaitan',
                'sub' => false
            ],
            [
                'name' => 'structure',
                'title' => 'Pengesahan Struktur Jejantas',
                'subTitle' => 'Jika Berkaitan',
                'sub' => false
            ]
        ],
        'attachment_label' => [
            'design_concept' => 'Pelan Lakaran Struktur',
            'image_location' => 'Gambar Lokasi',
            'image_location-2' => 'Gambar Lokasi 2',
            'image_location-3' => 'Gambar Lokasi 3',
            'image_location-4' => 'Gambar Lokasi 4',
            'image_location-5' => 'Gambar Lokasi 5',
            'image_location-6' => 'Gambar Lokasi 6',
            'image_location-7' => 'Gambar Lokasi 7',
            'review_letter' => 'Surat Ulasan Pihak Ketiga',
            'structure' => 'Pengesahan Struktur Jejantas',
        ]
    ],


    'first' => [
        'hint' => 'Sila pilih jenis permohonan',
        'types' => [
            'highway' => 'Pembangunan Tepi Lebuhraya',
            'billboard' => 'Paparan Iklan'
        ]
    ],

    'second' => [
        'hint' => 'Jenis Lokasi',
        'highway' => [
            'title' => 'Butiran Maklumat Pembangunan Tepi Lebuhraya'
        ],
        'ad' => [
            'location_type' => [
                'title' => 'Jenis Lokasi Paparan Iklan'
            ]
        ],
        'coordinates' => 'Koordinat',
        'map' => 'Peta Interaktif',
        'fields' => [
            'category' => [
                'title' => 'Kategori',
                'first' => 'Permohonan Baru',
                'second' => 'Permohonan Sedia Ada'
            ],
            'highway' => 'Lebuhraya',
            'location' => 'Lokasi (km)',
            'area' => 'Daerah',
            'direction' => [
                'title' => 'Arah',
                'items' => [
                    'Northbound' => 'Northbound',
                    'Southbound' => 'Southbound',
                    'Eastbound' => 'Eastbound',
                    'Westbound' => 'Westbound'
                ]
            ],
            'from_city' => 'Dari Bandar',
            'to_city' => 'Ke Bandar',
            'coordinates' => 'Koordinat',
            'zone' => [
                'title' => 'Zon',
                'items' => [
                    0 => 'Pilih Zon',
                    1 => 'Zon 1',
                    2 => 'Zon 2',
                    3 => 'Zon 3'
                ]
            ],
            'authority' => [
                'title' => 'PBT',
                'items' => [
                    'dbkl' => 'DBKL',
                    'mbpj' => 'MBPJ',
                    'mbsj' => 'MPSJ',
                    'mbaj' => 'MBAJ',
                    'mbsa' => 'MBSA',
                    'mbjb' => 'MBJB',
                    'mbi' => 'MBI',
                    'mppp' => 'MPPP',
                    'mbmb' => 'MBMB',
                ]
            ],
            'verify-1' => 'Kesemua maklumat yang diberikan adalah benar. Sekiranya terdapat maklumat yang tidak benar, pihak Lembaga Lebuhraya Malaysia berhak untuk membatalkan permohonan ini tanpa sebarang gantirugi terhadap sebarang bayaran/kos yang telah dikeluarkan.',
            'verify-2' => 'Telah membaca dan memahami Garis Panduan Pembangunan Tepi Lebuhraya / Paparan Iklan di kawasan rizab Lebuhraya di bawah bidang kuasa Lembaga Lebuhraya Malaysia sebelum membuat permohonan ini.',
            'verify-3' => 'Akan mematuhi garis panduan yang telah ditetapkan untuk Pembangunan Tepi Lebuhraya / Paparan Iklan di bawah bidang kuasa penyeliaan rizab lebuhraya Lembaga Lebuhraya Malaysia termasuk sebarang syarat, peraturan dan undang-undang yang telah ditetapkan. '
        ],
        'file_limit' => 'Saiz maksima setiap fail adalah 5MB',
        'declaration' => 'Deklarasi'
    ],

    'third' => [
        'title' => 'Jenis Pembangunan - Yuran Pemprosesan',
        'development_type' => 'Jenis Pembangunan',
        'processing_fee' => 'Pembangunan / Yuran Pemprosesan',
        'height' => 'Tinggi (t)',
        'width' => 'Lebar (l)',
        'quantity' => [
            'title' => 'Kuantiti',
            'button' => 'Daftar Maklumat Tiang'
        ],
        'payment' => [
            'title' => 'Kaedah Pembayaran',
            'method' => [
                'check' => 'Deposit Tunai / Deposit Cek',
                'bank' => 'Pemindahan Bank'
            ],
            'slip_attachment' => 'Lampiran Slip Deposit/Pembayaran',
            'date' => 'Tarikh Pembayaran',
            'note' => '* Bayaran menggunakan cek hanya boleh dibuat untuk Permohonan Paparan Iklan'
        ],
        'picker' => 'Buang',
        'slip_num' => 'No. Rujukan Slip Deposit/ Pembayaran',
        'total' => 'Jumlah (RM)',
        'bank' => 'Bank',
        'banks' => [
            0 => 'Pilih Bank Pengeluar',
            1 => 'Bank Islam',
            2 => 'Bank Muamalat',
            3 => 'CIMB Bank',
            4 => 'Maybank',
            5 => 'RHB Bank',
            6 => 'BSN',
            7 => 'Affin Bank',
            8 => 'Bank Rakyat',
            9 => 'Hong Leong Bank',
            10 => 'Public Bank'
        ],
        'structure_size' => [
            'title' => 'Saiz Struktur (meter)'
        ]

    ],

    'fourth' => [
        'title' => 'Butiran Permohonan',
        'subtitle' => 'Sila buat semakan jadual fi pemprosesan sebelum dihantar kepada pihak LLM',
        'payment_details' => 'Butiran Pembayaran',
        'payment_type' => 'Jenis Bayaran',
        'total_payments' => 'Jumlah Bayaran',
        'notice' => 'Notis: Pembayaran ini adalah untuk tujuan pemprosesan permohonan . Pembayaran ini tidak akan dipulangkan sekiranya permohonan ini tidak berjaya . ',
        'button' => 'Hantar Borang Permohonan'
    ],

    'please_select' => 'Sila Pilih',

];