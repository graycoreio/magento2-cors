<?php

return [
    'system' => [
        'default' => [
            'web' => [
                'graphql' => [
                    'cors_max_age' => 86400,
                    'cors_allow_credentials' => 1,
                    'cors_allowed_methods' => 'POST, OPTIONS, GET',
                    'cors_allowed_headers' =>
                        'Content-Currency, Store, X-Magento-Cache-Id, X-Captcha, Content-Type, Authorization, DNT, TE',
                    // Angular
                    'cors_allowed_origins' =>
                        'http://localhost:4200, https://localhost:4200',
                    // Angular + Universal
                    'cors_allowed_origins' =>
                        'http://localhost:4200, https://localhost:4200, http://localhost:4000, https://localhost:4000',
                    // Express
                    'cors_allowed_origins' =>
                        'https://frontend.example.com, http://localhost:3000, https://localhost:3000',
                    // PWA Studio (PWA Studio Generates a random port, so we can't provide a configuration)
                ]
            ]
        ]
    ]
];
