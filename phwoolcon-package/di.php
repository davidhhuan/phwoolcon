<?php

use Phwoolcon\Aliases;
use Phwoolcon\Cache;
use Phwoolcon\Config;
use Phwoolcon\Cookies;
use Phwoolcon\Db;
use Phwoolcon\DiFix;
use Phwoolcon\Events;
use Phwoolcon\I18n;
use Phwoolcon\Log;
use Phwoolcon\Router;
use Phwoolcon\Session;
use Phwoolcon\View;
use Phwoolcon\Queue;

Events::register($di);
DiFix::register($di);
Db::register($di);
Cache::register($di);
Log::register($di);
Config::register($di);
Aliases::register($di);
Router::register($di);
I18n::register($di);
Cookies::register($di);
Session::register($di);
View::register($di);
Queue::register($di);

$loader->registerNamespaces(Config::get('app.autoload.namespaces', []), true);