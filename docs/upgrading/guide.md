# Upgrade Guide

When we make breaking changes, we will post the breaking changes here.

## v1.* to v2.0

The layer in which we compute whether or not an incoming preflight request receives CORS headers has changed in v2.0.0. Previously, we leveraged a plugin around the relevant native Magento 2 Controller (webapi_rest/graphql) and as a result, we incurred significant overhead from Magento code when computing CORS headers. 

In v2.0, we no longer incur this overhead by adding a plugin around application launch and creating our own custom controller. It is **very possible** that we broke expectations of anything that plugs-in around this plugin or adds additional CORS headers other than our own. 

For 99.99% of GraphQl/Rest API deployments, the API is used sessionlessly. As such, we can take the opportunity to improve performance for the majority at the expense of the minority. If this breaks your codebase, please submit an issue and we will see what can be done to remedy your specific use-case.

In theory, most dependents simply need to upgrade to v2.0 and there are no breaking changes. 

**However,** if you were expecting to use the native GraphQl/REST controller when computing CORS headers (and everything else that entails - like having a Magento session, for example) that guarantee is no-longer provided.

