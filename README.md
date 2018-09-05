# Slim 3 Skeleton

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/554d9517ccec49278df87e21764ecc58)](https://www.codacy.com/app/andrewdyer/slim3-restful-api-web-seed?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=andrewdyer/slim3-restful-api-web-seed&amp;utm_campaign=Badge_Grade)
[![Latest Stable Version](https://poser.pugx.org/andrewdyer/slim3-restful-api-web-seed/version)](https://packagist.org/packages/andrewdyer/slim3-restful-api-web-seed)
[![Latest Unstable Version](https://poser.pugx.org/andrewdyer/slim3-restful-api-web-seed/v/unstable)](//packagist.org/packages/andrewdyer/slim3-restful-api-web-seed)
[![License](https://poser.pugx.org/andrewdyer/slim3-restful-api-web-seed/license)](https://packagist.org/packages/andrewdyer/slim3-restful-api-web-seed)
[![Total Downloads](https://poser.pugx.org/andrewdyer/slim3-restful-api-web-seed/downloads)](https://packagist.org/packages/andrewdyer/slim3-restful-api-web-seed)
[![Daily Downloads](https://poser.pugx.org/andrewdyer/slim3-restful-api-web-seed/d/daily)](https://packagist.org/packages/andrewdyer/slim3-restful-api-web-seed)
[![Monthly Downloads](https://poser.pugx.org/andrewdyer/slim3-restful-api-web-seed/d/monthly)](https://packagist.org/packages/andrewdyer/slim3-restful-api-web-seed)
[![composer.lock available](https://poser.pugx.org/andrewdyer/slim3-restful-api-web-seed/composerlock)](https://packagist.org/packages/andrewdyer/slim3-restful-api-web-seed)

A basic starter structure which can be used to develop RESTful APIs and web applications, 
built with the Slim 3 framework.

## Index

* [License](#license)
* [Requirements](#requirements)
* [Installation](#installation)
    * [Configuration](#configuration)
* [Documentation](#documentation)
    * [Controllers](#controllers)
    * [Models](#models)
    * [Presenters](#presenters)
    * [Middleware](#middleware)
    * [Commands](#commands)
    * [Migrations](#migrations)
        * [Create Command](#create-command)
        * [Migrate Command](#migrate-command)
        * [Rollback Command](#rollback-command)
        * [Seeding](#seeding)
* [Useful Links](#useful-links)
* [See Also](#see-also)

## License

Licensed under MIT. Totally free for private or commercial projects.

## Requirements

* PHP 7.1.14+
* MySQL 5.7.20+
* Composer

## Installation

```
composer create-project andrewdyer/slim3-skeleton project_name
```

### Configuration
* Activate mod_rewrite, route all traffic to application's `/public` directory.
* Set up the project environment by updating the .env file in the application's root directory.
* Run all available migrations.

## Documentation

### Controllers

This project provides controller functionality to Slim. Controllers are typically 
stored in the `app/Controllers` directory, however they can technically live in any 
directory or any sub-directory. All controllers should  extend the `App\Controllers\AbstractController` 
class, which is used as a place to put shared controller logic.

Here's a basic usage example of a controller:

**app/Controllers/ArticlesController.php**

```php
namespace App\Controllers;

use App\Models\Article;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ArticlesController extends AbstractController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function createView(Request $request, Response $response): Response
    {
        return $this->renderView($response, 'articles/create.html.twig');
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function postAction(Request $request, Response $response): Response
    {
        $article = new Article();
        $article->title = $request->getParam('input');
        $article->content = $request->getParam('content');
        $article->save();

        return $response->withRedirect($this->getPathFor('articles.create'));
    }
}
```

For most web application controllers, you will want to render a view. Here is a 
basic example of a twig view. For how to handle API responses see the 
[presenters documentation](#presenters):

**views/articles/create.html.twig**

```twig
{% extends 'base.html.twig' %}
    
{% block content %}
    <form method="post">
        <div class="form-group {{errors.title ? "has-error" : ""}}">
            <label for="title-input" class="control-label">Title</label>
            <input type="text" id="title-input" class="form-control" name="title" value="{{input.title}}" />
            {% if errors.title %}
                <span class="help-block">{{errors.title | first}}</span>
            {% endif %}
        </div>
        <div class="form-group {{errors.content ? "has-error" : ""}}">
            <label for="content-input" class="control-label">Content</label>
            <textarea id="content-input" class="form-control" name="content">{{input.content}}</textarea>
            {% if errors.content %}
                <span class="help-block">{{errors.content | first}}</span>
            {% endif %}
        </div>
        <button type="submit" class="btn btn-default">Create Post</button>
    </form>
{% endblock %}
```

Don't forget to define your routes, passing the controller class name and method as the callable:

**routes/web.php**

```php
$app->get('/articles', App\Controllers\ArticlesController::class.':createView')->setName('articles.create');
$app->post('/articles', App\Controllers\ArticlesController::class.':postAction')->setName('articles.create');
```

In summary, the above example will see all GET requests made to the */articles* 
endpoint call the `getAction()` method of the class ArticlesController, which 
will simply render a twig view. When the submit button is clicked on the view, 
a POST request will be made to the same endpoint, which is handled by the `postAction()` 
of the ArticlesController class. This method will create a new model and redirect 
the user back the same page.

[[Back to Top]](#documentation)

### Models

This project makes use of Eloquent ORM, a simple ActiveRecord implementation for 
working with databases. Each database table has a corresponding "Model" which is 
used to interact with that table. Models allow you to query for data in tables, as 
well as insert new records into the table. Models are typically stored in the `app/Models` 
directory, but you are free to place them anywhere that can be auto-loaded. All models 
are required to extend the `App\Models\AbstractModel` class.

Here's a basic usage example of a model:

**app/Models/Article.php**

```php
namespace App\Models;

class Article extends AbstractModel
{
    /** @var string */
    protected $table = 'articles';

    /**
     * @return string
     */
    public function getExcerptAttribute()
    {
        return substr($this->content, 0, 145);
    }
}
```

[[Back to Top]](#documentation)

### Presenters

Presenters are used to generate the view data. They are basically a class that 
accepts a model and wraps it in some specific logic to alter the returned values 
without having to modify the original object. A presenter should not do any data 
manipulation, but can contain model calls and any other retrieval or preparation 
operations needed to generate the view data. Presenters are typically stored in the 
`app/Presenters` directory, although can be placed anywhere that can be auto-loaded, 
and are required to extend the `App\Presenters\AbstractPresenter` class.

Here's a basic usage example of a presenter:

**app/Presenters/ArticlePresenter.php**

```php
namespace App\Presenters;

class ArticlePresenter extends AbstractPresenter
{
    /**
     * @param object $data
     *
     * @return array
     */
    public function format($data): array
    {
        return [
            'id' => $data->id,
            'title' => $data->title,
            'excerpt' => $data->excerpt,
            'content' => $data->content,
        ];
    }
}
```

In the controller, instead of rendering a twig view, you can pass into `$response->withJson()` 
a new instance of the presenter - calling the `->present()` method on it:

**app/Controllers/ArticlesController.php**

```php
namespace App\Controllers;

use App\Models\Article;
use App\Presenters\ArticlePresenter;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ArticlesController extends AbstractController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function getAction(Request $request, Response $response)
    {
        $article = Article::find(1);

        return $response->withJson((new ArticlePresenter($article))->present());
    }
}
```

[[Back to Top]](#documentation)

### Middleware

Middleware is code that is run before and after your application to manipulate the 
Request and Response objects as you see fit. Although Middleware can be placed anywhere 
that can be auto-loaded, it is typically stored in `app/Middleware` and should extend the 
`App\Middleware\AbstractMiddleware` class. 

Here's a basic usage example of middleware:

**app/Middleware/ExampleMiddleware.php**

```php
namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ExampleMiddleware extends AbstractMiddleware
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param callable $next
     *
     * @return Response
     */
    public function handle(Request $request, Response $response, callable $next): Response
    {
        $response->getBody()->write('BEFORE');
        $response = $next($request, $response);
        $response->getBody()->write('AFTER');

        return $response;
    }
}
```

To register middleware, you need to use the  `->add()` function chain in **bootstrap/middleware.php** 
or against specific routes in *routes/* directory.

**bootstrap/middleware.php**

```php
$container = $app->getContainer();
$app->add(new App\Middleware\ExampleMiddleware($container));
```

[[Back to Top]](#documentation)

### Commands

Commands are typically stored in the `app/Commands` directory and are defined in 
classes extending the `App\Commands\AbstractCommand` class.

Here's a basic usage example of a command:

**app/Commands/SayHelloCommand.php**

```php
namespace App\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SayHelloCommand extends AbstractCommand
{
    /**
     * @return array
     */
    public function arguments(): array
    {
        return [
            ['name', InputArgument::OPTIONAL, 'Your name'],
        ];
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return '';
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return mixed
     */
    public function handle(InputInterface $input, OutputInterface $output)
    {
        for ($i = 0; $i < $input->getOption('repeat'); ++$i ) {
            $output->writeln('<comment>'.'Hello '.$input->getArgument('name').'</comment>');
        }
    }

    /**
     * @return string
     */
    public function help(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return 'say:hello';
    }

    /**
     * @return array
     */
    public function options(): array
    {
        return [
            ['repeat', 'r', InputOption::VALUE_OPTIONAL, 'Times to repeat output', 1],
        ];
    }
}
```

Commands are registered by using the `->add();` function chain in **bootstrap/commands.php**.

**config/commands.php**

```php
$console->add(new App\Commands\SayHelloCommand($container));
```

[[Back to Top]](#documentation)

### Migrations

Phinx is a database migration tool. You can tell Phinx that you want to create a 
new database table, add a column or edit the properties of a column by writing 
“migrations”. Each migration is represented by a PHP class in a unique file.

Phinx is run using a number of commands in the projects root directory;

#### Create Command 

The create command is used to create a new migration file. The file will be located 
in the `app/Migrations` directory and will contain a skeleton migration class. The command 
requires one argument: the name of the migration. The migration name should be specified in 
CamelCase format. 

```
php bin/phinx create MyNewMigration
```

#### Migrate Command

The migrate command runs all of the available migrations, optionally up to a specific version.

```
php bin/phinx migrate
```

To migrate to a specific version then use the `--target` parameter or `-t` for short.

```
php bin/phinx  migrate -e development -t 20110103081132
```

Use `--dry-run` to print the queries to standard output without executing them

```
php bin/phinx  migrate --dry-run
```

#### Rollback Command

The Rollback command is used to undo previous migrations executed by Phinx. It is 
the opposite of the migrate command. You can rollback to the previous migration by 
using the rollback command with no arguments.

```
php bin/phinx rollback -e development
```

To rollback all migrations to a specific version then use the `--target` parameter or `-t` for short.

```
php bin/phinx rollback -e development -t 20120103083322
```

Specifying 0 as the target version will revert all migrations.

```
php bin/phinx rollback -e development -t 0
```

To rollback all migrations to a specific date then use the `--date parameter` or `-d` for short.

```
php bin/phinx rollback -e development -d 2012
php bin/phinx rollback -e development -d 201201
php bin/phinx rollback -e development -d 20120103
php bin/phinx rollback -e development -d 2012010312
php bin/phinx rollback -e development -d 201201031205
php bin/phinx rollback -e development -d 20120103120530
```

If a breakpoint is set, blocking further rollbacks, you can override the breakpoint 
using the `--force parameter` or `-f` for short.

```
php bin/phinx rollback -e development -t 0 -f
```

Use `--dry-run` to print the queries to standard output without executing them

```
php bin/phinx rollback --dry-run
```

#### Seeding

Seed classes are a great way to easily fill your database with data after it’s created. 
By default they are stored in `app/Seeds`.

```php
use App\Models\Article;
use Phinx\Seed\AbstractSeed;

class ArticleSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        Article::insert([
            [
                'title' => 'Article #1',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eros nibh, fringilla pharetra scelerisque sed, rhoncus eget neque. Nunc sodales, eros sit amet fermentum interdum.',
            ],
            [
                'title' => 'Article #2',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque condimentum, justo eget suscipit euismod, nisi velit luctus mauris, non posuere orci ex sit amet lorem.',
            ],
            [
                'title' => 'Article #3',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris arcu leo, molestie at congue nec, vestibulum aliquet sapien. Orci varius natoque penatibus et magnis dis.',
            ],
        ]);
    }
}
```

Phinx includes a command to easily generate a new seed class:

```
php bin/phinx seed:create ArticleSeeder
```

[[Back to Top]](#documentation)

## Useful Links
* [Slim Framework](https://www.slimframework.com)
* [Slim Framework Twig View](https://github.com/slimphp/Twig-View)
* [Illuminate Database](https://github.com/illuminate/database)
* [Phinx Migrations](https://book.cakephp.org/3.0/en/phinx.html)
* [Phinx - Writing Migrations](http://docs.phinx.org/en/latest/migrations.html)
* [Phinx - Commands](http://docs.phinx.org/en/latest/commands.html)
* [Database migrations in PHP with Phinx](https://helgesverre.com/blog/database-migrations-in-php-with-phinx)
* [Monolog](https://github.com/Seldaek/monolog)
* [The Console Component](https://symfony.com/doc/current/components/console.html)
* [The Dotenv Component](https://symfony.com/doc/current/components/dotenv.html)
* [The VarDumper Component](https://symfony.com/doc/current/components/var_dumper.html)

## See Also
* [Slim3 Cache](https://github.com/andrewdyer/slim3-cache)
* [Slim3 Mailer](https://github.com/andrewdyer/slim3-mailer)
* [Slim3 Session Middleware](https://github.com/andrewdyer/slim3-session-middleware)
* [Slim3 Validator](https://github.com/andrewdyer/slim3-validator)
