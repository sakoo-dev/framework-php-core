**HTTP Request Module**

As a Developer, I want a Packaged Classes for Handling Incoming HTTP Requests.
Request should get super global variables and give some fidelity to work with Query Params, URL Params or Body Params (POST Verb)
It will work like Symfony/http-foundation Package.

```php
// Example: https://virgol.io/articles?page=2
$request = new Request($_REQUEST);
$request->query->get('page'); 
```