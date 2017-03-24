<?php
return [
    'inbox' => [
        'statuses' => [
            'approve' => 'Diluluskan',
            'new' => 'Baru',
            'rejected' => 'Ditolak'
        ]
    ],

    'document' => 'Lihat Lampiran',

    'application' => [
        'title' => 'Permohonan',
        'info' => [
            'tabs' => [
                'company' => 'Maklumat Syarikat',
                'project' => 'Maklumat Projek',
                'report'  => 'Laporan Pemeriksaan Tapak',
                'results' => 'Status Mesyuarat Dalaman',
                'kkr'     => 'Status Kelulusan KKR',
                'documents' => 'eDokumen (Rujukan Lampiran Projek)'
            ],

            'company' => [
                // first step
                'applicant_info' => 'Butiran Pemohon',
                'applicant_category' => 'Kategori Pemohon',
                'name' => 'Nama Syarikat',
                'number_registration' => 'No. Pendaftaran Syarikat',
                'address' => 'Alamat Syarikat',
                'phone_office' => 'No. Telefon',
                'phone_fax' => 'No. Faks',

                // second step
                'owner' => 'Pemilik Akaun',
                'name_account' => 'Nama Pegawai',
                'email' => 'E-mel',
                'cell_phone' => 'No. H/P'
            ],

            'project' => [
                'highway' => 'Lebuhraya',
                'concession' => 'Syarikat Konsesi Terlibat',
                'location' => 'Lokasi',
                'direction' => 'Arah',
                'from_city' => 'Dari Bandar',
                'to_city' => 'Ke Bandar',
                'coordinates' => 'Koordinat',
                'documents' => 'Dokumen Berkaitan'

            ],

            'documents' => [
                'new_document' => 'Muatnaik Fail',
                'exiting' => 'Dokumen Rujukan'
            ],
            'kkr' => [
                'status_result' => 'Status Keputusan'
            ],
            'meeting' => [
                ''
            ]
        ],
        
        'modal' => [
            'application_details' => 'Butiran Permohonan',
            'confirmation_bkpa' => 'Pengesahan'
        ]
    ],

    'project' => [
        'title' => 'Projek',
        'modal' => [
            'status' => 'Hantar Fail Projek ke Pejabat Wilayah / Syarikat Konsesi yang dilantik'
        ],
        'info' => [
            'meeting' => [
                'title' => 'Mesyuarat Dalaman Bahagian',
                'meeting_no' => 'Mesyuarat Bilangan',
                'summary' => 'Keputusan',
                'statuses' => ['Disokong', 'Tidak Disokong', 'Ditangguh']
            ]
        ]
    ],
    'modal' => [
        'title' => 'Penghantaran Pejabat Wilayah / Konsesi',
        'verification' => 'Pengesahan Bahagian',
        'act' => [
            'first' => 'Jana Nombor Fail Projek'
        ],

    ]
];