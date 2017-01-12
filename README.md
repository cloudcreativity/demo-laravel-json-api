# Laravel JSON API Demo

This application demonstrates how to use the 
[cloudcreativity/laravel-json-api](https://github.com/cloudcreativity/laravel-json-api)
package to create a [JSON API](http://jsonapi.org) compliant API. This is demonstrated using Eloquent models as
the domain records that are serialized in the API, but the package is not Eloquent specific.

## Setup

The application uses [Homestead](https://laravel.com/docs/homestead), so you'll need Vagrant installed on your
local machine.

Once you've cloned this repository, change into the project folder then:

``` bash
composer install
cp .env.example .env
php vendor/bin/homestead make
vagrant up
```

> Remember you'll need to add an entry for `homestead.app` in your `/etc/hosts` file.

Once it is up and running, go to the following address in your browser:

```
http://homestead.app/api/v1/posts
```

## Explanation

As an example, this API exposes a `posts` resource. To do this:

1. The resource is registered with the router in `app/Http/routes.php`
2. A controller exists: `app/Http/Controllers/Api/PostsController`. This is composed of units that each have a single
concern, and can be found in the `app/JsonApi/Posts` folder:
  - A `request`, that handles the incoming request from the client and validates it.
  - A `validators` provider, that provides the rules for validating the HTTP content for a create or update request,
  as well as validating any filters for a search (find-many) request.
  - A `hydrator`, that contains the logic for transferring data from the client's request into the domain record (the
  `Post` model).
  - A `schema` that handles converting the `Post` model into its API representation.
  - A `search` class, that handles converting a find-many request into an Eloquent query.
 
### Eloquent vs Not-Eloquent

This package can handle both Eloquent and non-Eloquent records. You get a lot more functionality out of the box if
you are using Eloquent, but it's possible to integrate non-Eloquent records as needed.

This demo includes the following JSON-API resources:

| Resource | Record | Eloquent? |
| --- | --- | --- |
| comments | App\Comment | Yes |
| people | App\People | Yes |
| posts | App\Post | Yes |
| sites | App\Site | No |
| tags | App\Tag | Yes |

You'll notice that the `sites` resource also has an additional unit: an `adapter`. This tells the store how to check 
whether a specific resource exists, and how to load it. The store is used when parsing an incoming JSON API request.

## Tests

We're big on testing, and the `cloudcreativity/laravel-json-api` package comes with test helpers to make integration 
testing a JSON API a breeze. You can see this in action in the `tests/Integration` folder, where there's a test case
for the `posts` resource.

To run the tests:

``` bash
vagrant ssh
cd /vagrant
vendor/bin/phpunit
```
