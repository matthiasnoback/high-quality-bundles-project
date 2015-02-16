# Getting started

1. Create a new project:

```
composer create-project matthiasnoback/high-quality-bundles-project [project-directory] dev-master
```

2. When asked, supply the requested information concerning the MySQL database (make sure you run a MySQL server).

3. Do whatever is needed to get your file permissions right (see also [Setting up Permissions](http://symfony.com/doc/current/book/installation.html)).

4. Then see if everything works:

```
app/console
```

5. Create the database and the database schema:

```
app/console doctrine:database:create
app/console doctrine:schema:create
```

6. Configure the web server to serve the `/web` directory of this project.

> If you run PHP 5.4 or higher, you don't need to configure the web server for this project, because you can use the
> Symfony command:
>
> ```
> app/console server:run
> ```
>
> Check if everything works. When you request `http://127.0.0.1:8000/` in the browser you should see a list of existing
> users.
