<?php

return [
    'steps' => [
        'title' => 'New Application',
        'first' => 'Application Category',
        'second' => 'Application Details',
        'third' => 'Processing Fee',
        'fourth' => 'Feedback'
    ],

    'statuses' => [
        'pending' => 'In Process',
        'approved' => 'Approved',
        'rejected' => 'Rejected'
    ],

    'files' => [
        'columns' => [
            'first' => 'No',
            'second' => 'Description',
            'third' => 'File Path'
        ],
        'buttons' => [
            'select' => 'Select file',
            'change' => 'Change',
            'remove' => 'Remove',
            'add' => 'Add',
            'preview' => 'Preview'
        ],

        'rows' => [
            [
                'name' => 'design_concept',
                'title' => 'Conceptual Design Plan',
                'subTitle' => "'Preferably PDF format'",
                'sub' => false
            ],
            /*[
                'name' => 'location_plan',
                'title' => 'Pelan Lokasi (Google Earth)',
                'subTitle' => false,
                'sub' => false
            ],*/
            [
                'name' => 'image_location',
                'title' => 'Images',
                'subTitle' => 'At least 1 picture',
                'sub' => false,
                /*'sub' => [
                    [
                        'name' => 'image_location-2'
                    ],
                    [
                        'name' => 'image_location-3'
                    ]
                ]*/
            ],
            [
                'name' => 'review_letter',
                'title' => 'Third Party Feedback Letter',
                'subTitle' => 'optional',
                'sub' => false
            ],
            [
                'name' => 'structure',
                'title' => 'Overhead Structure Verification',
                'subTitle' => 'optional',
                'sub' => false
            ]
        ],
        'attachment_label' => [
            'design_concept' => 'Structural Sketch Plan',
            'image_location' => 'Location Image',
            'image_location-2' => 'Location Image 2',
            'image_location-3' => 'Location Image 3',
            'image_location-4' => 'Location Image 4',
            'image_location-5' => 'Location Image 5',
            'image_location-6' => 'Location Image 6',
            'image_location-7' => 'Location Image 7',
            'review_letter' => 'Third Party Feedback Letter',
            'structure' => 'Overhead Structure Verification',
			'designs' => 'Designs',
			'pays' => 'Pays'
        ]
    ],



    'first' => [
        'hint' => 'Please select application type',
        'types' => [
            'highway' => 'Roadside Development',
            'billboard' => 'Billboard'
        ]
    ],

    'second' => [
        'hint' => 'Location Type',
        'highway' => [
            'title' => 'Roadside Development Information Details'
        ],
        'ad' => [
            'location_type' => [
                'title' => 'Billboard Location Type'
            ]
        ],
        'coordinates' => 'Coordinates',
        'map' => 'Interactive Map',
        'fields' => [
            'category' => [
                'title' => 'Category',
                'first' => 'New Application',
                'second' => 'Existing Application'
            ],
            'highway' => 'Highway',
            'project_title' => 'Project Title',
            'location' => 'Location (km)',
            'area' => 'District',
            'direction' => [
                'title' => 'Direction',
                'items' => [
                    'Northbound' => 'Northbound',
                    'Southbound' => 'Southbound',
                    'Eastbound' => 'Eastbound',
                    'Westbound' => 'Westbound'
                ]
            ],
            'from_city' => 'From City',
            'to_city' => 'To City',
            'coordinates' => 'Coordinates',
            'zone' => [
                'title' => 'Zone',
                'items' => [
                    0 => 'Select Zone',
                    1 => 'Zone 1',
                    2 => 'Zone 2',
                    3 => 'Zone 3'
                ]
            ],
            'authority' => [
                'title' => 'Local Authority',
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
            'verify-1' => 'All information provided above is true. If the information is incorrect, the Malaysian Highway Authority reserves the right to cancel our application without reimbursement or costs have been paid.',
            'verify-2' => 'Have read and understand the Guidelines Establishing Roadside / Billboard Structure on the reserve Highway Supervision Malaysian Highway Authority before making this application.',
            'verify-3' => 'Will comply with the guidelines established in the Roadside Development / Billboard Structure on the Supervision of Expressway Reserve Malaysian Highway Authority and any rules, regulations or laws that set.'
        ],
        'file_limit' => 'File upload size limit is 5MB each.',
        'declaration' => 'Declaration'
    ],

    'third' => [
        'title' => 'Development Type - Processing Fee',
        'development_type' => 'Development Type',
        'processing_fee' => 'Average Development / Processing Fee',
        'height' => 'Height (h)',
        'width' => 'Width (w)',
        'total_square' => 'Total (m2)',
        'quantity' => [
            'title' => 'Quantity',
            'button' => 'Register Pillar/Stand'
        ],
        'payment' => [
            'title' => 'Payment Method',
            'method' => [
                'check' => 'Cash Deposit / Cheque Deposit',
                'bank' => 'Bank Transfer'
            ],
            'slip_attachment' => 'Payment Slip Attachment',
            'date' => 'Payment Date',
            'note' => '* Payment by cheque only will be accepted for Billboard Application'
        ],
        'picker' => 'Remove',
        'slip_num' => 'Payment Slip No.',
        'total' => 'Total Amount (RM)',
        'bank' => 'Bank',
        'banks' => [
            0 => 'Select Bank Provider',
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
            'title' => 'Structure Size (meter)'
        ]

    ],

    'fourth' => [
        'title' => 'Application Review',
        'subtitle' => 'Please refer to processing fee table before submitting this form',
        'payment_details' => 'Payment Details',
        'payment_type' => 'Payment Type',
        'total_payments' => 'Total Payment',
        'notice' => 'Disclaimer : This payment is for the application processing purposes. This payment is unrefundable if this application is unsuccessful.',
        'button' => 'Submit Application Form',
        'back_button' => 'Back to'
    ],

    'please_select' => 'Please Select',

];