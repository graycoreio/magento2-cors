# FAQ

## Can I configure this package from the admin panel?
No. We will never merge a PR that allows an administrator to modify CORS headers from the admin panel. CORS Headers
should only be configured by qualified developers and security administrators. CORS is fundamentally a security relaxation protocol with significant ramifications when misconfigured. Allowing access from the admin panel circumvents the **critical** knowledge pathway and will put user information at risk, which we will not allow under any circumstances.
