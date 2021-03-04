# CORS Support with Varnish

In order to work with Varish and have Varnish served the cache response to an OPTIONS request, you'll need to make some minor adjustments to your `.vcl`.

## Varnish 6
```VCL
sub vcl_recv {
    ...
    # We only deal with GET, HEAD and OPTIONS by default
    if (req.method != "GET" && req.method != "HEAD" && req.method != "OPTIONS") {
        return (pass);
    }

    # Since "OPTIONS" are cached differently, we need to store a special "x-method" for later
    # swapping otherwise, varnish will turn our "OPTIONS" into a "GET".
    # REF: CORS-OPTIONS
    if (req.method ~ "OPTIONS") {
        set req.http.x-method = req.method;
    }
    ...
}

sub vcl_backend_fetch {
    # Since "OPTIONS" are cached differently, we need to store a special "x-method" for later
    # swapping otherwise, varnish will turn our "OPTIONS" into a "GET".
    # REF: CORS-OPTIONS
    if (bereq.http.x-method ~ "OPTIONS") {
        set bereq.method = bereq.http.x-method;
    }
}

sub vcl_hash {
    ...

    # Ensure that Varnish caches per method type.
    if (req.method ~ "OPTIONS") {
        hash_data(req.method);
    }
    ...
}

sub vcl_backend_response {
    ...

    # validate if we need to cache it and prevent from setting cookie
    if (beresp.ttl > 0s && (bereq.method == "GET" || bereq.method == "HEAD" || bereq.method == "OPTIONS")) {
        unset beresp.http.set-cookie;
    }

    ...
}
```