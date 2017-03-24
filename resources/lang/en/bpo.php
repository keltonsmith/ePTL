<?php
return [
    'inbox' => [
        'statuses' => [
            'approve' => 'Approved',
            'new' => 'New',
            'rejected' => 'Rejected'
        ]
    ],

    'document' => 'View Attachment',

    'application' => [
        'title' => 'Application',
        'info' => [
            'tabs' => [
                'company'   => 'Company Details',
                'project'   => 'Project Details',
                'report'    => 'Site Inspection Report',
                'results'   => 'Internal Meeting Status',
                'kkr'       => 'KKR Approval Status',
                'documents' => 'eDocument (Reference)'
            ],

            'company' => [
                // first step
                'applicant_info' => 'Applicant Information',
                'applicant_category' => 'Applicant Category',
                'name' => 'Company Name',
                'number_registration' => 'Company Reg Number',
                'address' => 'Company Address',
                'phone_office' => 'Phone number',
                'phone_fax' => 'Fax number',

                // second step
                'owner' => 'Account Representative',
                'name_account' => 'Officer Name',
                'email' => 'Email',
                'cell_phone' => 'Mobile Phone No.',
				'post_address'=>'Post Address',
				'postcode_country'=>'Post Code & Country'
            ],

            'project' => [
                'highway' => 'Highway',
                'concession' => 'Concession Company Involved',
                'location' => 'Location',
                'direction' => 'Direction',
                'from_city' => 'From City',
                'to_city' => 'To City',
                'coordinates' => 'Coordinates',
                'documents' => 'Related Documents'

            ],
            'documents' => [
                'new_document' => 'New File Upload',
                'exiting' => 'Document References'
            ],
            'kkr' => [
                'status_result' => 'Status Result'
            ],
            'meeting' => [
                ''
            ]
        ],

        'modal' => [
            'application_details' => 'Application Details',
            'confirmation_bkpa' => 'Confirmation'
        ]
    ],
    'project' => [
        'title' => 'Projects',
        'modal' => [
            'status' => 'Project file submission to the appointed Regional Office and Concessionaires'
        ],
        'info' => [
            'meeting' => [
                'title' => 'Internal Department Meeting',
                'meeting_no' => 'Meeting No',
                'summary' => 'Decision',
                'statuses' => ['Supported', 'Unsupported', 'Postponed']
            ]
        ]
    ],
    'modal' => [
        'title' => 'Regional Office / Concessionaires Submission',
        'verification' => 'Department Verification',
        'act' => [
            'first' => 'Generate Project File No.'
        ],

    ]
];