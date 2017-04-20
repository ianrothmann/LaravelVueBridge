# LaravelVueBridge
A bridge for exposing Laravel variables and routes inside vue components. It supports Vuex. For use with Multi Page Applications using multiple Vue components. The idea is to get the best of both, between what Laravel and Vue offers.

This package should be used with the VueBridge npm package (https://github.com/ianrothmann/VueBridgeJs).

# Installation
composer require ianrothmann/laravel-vue-bridge

In config/app.php

Service provider
IanRothmann\LaravelVueBridge\ServiceProviders\VueBridgeServiceProvider::class

Facade
'VueBridge' =>IanRothmann\LaravelVueBridge\Facades\VueBridge::class

In your main blade file, before <script src="{{ mix('js/app.js') }}"></script> you should add
{!! VueBridge::scripts(get_defined_vars()) !!}

# Exposing variables
In your controller:
VueBridge::exposeVariables([array of variable names to expose]);

VueBridge::hideVariables([array of variable names to hide, all others will be exposed]);

VueBridge::exposeAllVariables();

VueBridge::hideAllVariables();

# Exposing Routes
In web.php or in middleware. Routes are hidden by default:

VueBridge::exposeAllRoutes(); //exposes all named routes

VueBridge::exposeRoutes(([array of route names]);

VueBridge::hideRoutes([array of route names]);


More documentation to follow later
