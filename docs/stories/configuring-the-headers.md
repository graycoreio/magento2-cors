# Configuring CORS Headers

## Available Configurations
We provide several configuration keys for you to configure. The configurations between REST and GraphQL are split to accomodate the "Security by Default" mentality.  

* `web/graphql/cors_allowed_origins` - A comma separated list of the origins allowed to the access the GraphQL API
* `web/graphql/cors_allowed_methods` - A comma separated list of the allowed request methods
* `web/graphql/cors_allowed_headers` - A comma separated list of the allowed response headers
* `web/graphql/cors_max_age` - The duration that the CORS policy should be cached for.
* `web/graphql/cors_expose_headers` - A comma separated list that indicates which headers can be exposed as part of the response.
* `web/graphql/cors_allow_credentials` - Whether to allow credentials on CORS requests

* `web/api_rest/cors_allowed_origins` - A comma separated list of the origins allowed to the access the REST API
* `web/api_rest/cors_allowed_methods` - A comma separated list of the allowed request methods
* `web/api_rest/cors_allowed_headers` - A comma separated list of the allowed response headers
* `web/api_rest/cors_max_age` - The duration that the CORS policy should be cached for.
* `web/api_rest/cors_expose_headers` - A comma separated list that indicates which headers can be exposed as part of the response.
* `web/api_rest/cors_allow_credentials` - Whether to allow credentials on CORS requests

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
                    'cors_max_age' => '86400',
                    'cors_allow_credentials' => 1
                ],
                'api_rest' => [
                    'cors_allowed_origins' => 'https://www.restapi.com, https://www.myotherallowedorigin',
                    'cors_allowed_methods' => 'GET, POST, OPTIONS',
                    'cors_allowed_headers' => '',
                    'cors_max_age' => '86400',
                    'cors_allow_credentials' => 0
                ]
            ]
        ]
    ]
    ...
];
```

> You can also optionally set the `cors_allowed_origins` key to `*` if you want to allow ALL origins access to the resource, but we strongly suggest you [understand the ramifications of this before doing so.](/docs/stories/security.md)
Note also that the CORS specification disallows a wildcard for Allowed Origins if the `cors_allow_credentials` flag is enabled. If this is the case, the server will instead echo the request Origin back as the Allow-Origin value. 
