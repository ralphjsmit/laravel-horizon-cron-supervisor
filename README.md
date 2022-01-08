![laravel-horizon-cron-supervisor@2x](https://github.com/ralphjsmit/laravel-horizon-cron-supervisor/blob/main/docs/images/laravel-horizon-cron-supervisor.jpg)

# A modern solution for running Laravel Horizon with a cron-based supervisor

**Run Laravel Horizon on cheap hosting environments without Supervisor🤑**

This Laravel package automatically checks every three minutes if your [Laravel Horizon](https://laravel.com/docs/8.x/horizon) instance is still running. In that way, it is the perfect replacement for the normally recommended [Supervisor Process Control System](http://supervisord.org), for which you need your own server.

This package allows running Laravel Horizon on shared hosting instances and servers where you don't have to option to install Supervisor.

Under the hood, the package automatically schedules a simple Artisan command to run every three minutes that checks whether Horizon is still running. If not, it'll restart the Horizon queues.

## Installation

Run the following command to install the package:

```shell
composer require ralphjsmit/laravel-horizon-cron-supervisor
```

The package works without any configuration. **Note that you need to have the Laravel Scheduler configured correctly.**

## How does this work with new deployments?

When you deploy a new version of your app, you usually shut down your queues and Horizon instances in order let them use the files. The Laravel Scheduler doesn't run any commands when your application is in **maintenance mode** (`php artisan down`). Thus as long as your application is in maintenance mode, you don't need to worry about this package restarting your queues when you don't want that.

A typical deployment workflow could look something like this:
```shell
# Prepare deployment 

php artisan down
php artisan horizon:terminate

# Do deployment logic
# Horizon will not be restarted until you put the application out of maintenance mode

php artisan horizon
php artisan up

# Finish up deployment
```

Note that this workflow is greatly simplified and doesn't take into account anything specific to your server or running commands like your migrations. 

## About the package

This package was created by [Ralph J. Smit](https://ralphjsmit.com/). Checkout my website [ralphjsmit.com](https://ralphjsmit.com/) for [Laravel and development-related tutorials](https://ralphjsmit.com/).

The package was inspired by [this StackOverflow question](https://stackoverflow.com/questions/66930824/running-laravel-horizon-on-shared-hosting-via-cron/67784583) and my need for this as well. Special thanks to [ahoffman](https://stackoverflow.com/users/952994/ahofmann) for his code on running and checking whether Horizon is active.
