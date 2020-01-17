# Configuring CORS Headers

## Available Configurations
We provide several configuration keys for you to configure. The configurations between REST and GraphQL are split to accomodate the "Security by Default" mentality.  

* `web/graphql/cors_allowed_origins` - A comma separated list of the origins allowed to the access the GraphQL API
* `web/graphql/cors_allowed_methods` - A comma separated list of the allowed request methods
* `web/graphql/cors_allowed_headers` - A comma separated list of the allowed response headers
* `web/graphql/cors_max_age` - The duration that the CORS policy should be cached for.

* `web/api_rest/cors_allowed_origins` - A comma separated list of the origins allowed to the access the REST API
* `web/api_rest/cors_allowed_methods` - A comma separated list of the allowed request methods
* `web/api_rest/cors_allowed_headers` - A comma separated list of the allowed response headers
* `web/api_rest/cors_max_age` - The duration that the CORS policy should be cached for.

You can add the following to your `app/etc/env.php` to configure the package.

```php
<?php
return [
    ...
    'system' => [
        'default' => [
            'web' => [
                'graphql' => [
                    'cors_allowed_origins' => 'https://www.graphql.com, https://www.myotherallowedorigin',
                    'cors_allowed_methods' => 'POST, OPTIONS',
                    'cors_allowed_headers' => '',
                    'cors_max_age' => '86400'
                ],
                'api_rest' => [
                    'cors_allowed_origins' => 'https://www.restapi.com, https://www.myotherallowedorigin',
                    'cors_allowed_methods' => 'GET, POST, OPTIONS',
                    'cors_allowed_headers' => '',
                    'cors_max_age' => '86400'
                ]
            ]
        ]
    ]
    ...
];
```

> You can also optionally set the `cors_allowed_origins` key to `*` if you want to allow ALL origins access to the resource, but we strongly suggest you [understand the ramifications of this before doing so.](/docs/stories/security.md)