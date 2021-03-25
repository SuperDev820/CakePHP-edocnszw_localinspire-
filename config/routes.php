<?php

/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Http\Middleware\CsrfProtectionMiddleware;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 */

/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {

    /*
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, templates/Pages/home.php)...
     */
    // $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    
    $builder->connect('/about', array('controller' => 'Pages', 'action' => 'display', 'about'));
    
    $builder->connect('/terms-of-use', array('controller' => 'Pages', 'action' => 'display', 'terms'));
     
      $builder->connect('/privacy-policy', array('controller' => 'Pages', 'action' => 'display', 'privacy'));
      
    $builder->connect('/', ['controller' => 'Home', 'action' => 'index']);
    
    // $builder->connect('/', ['controller' => 'Api', 'action' => 'userLogin']);
    $builder->connect('/logout', ['prefix' => 'Api', 'controller' => 'Api', 'action' => 'logout']);
    
    // $routes->connect('/business/*', ['controller' => 'Businesses', 'action' => 'view']); //double astericks means ignore params
    $builder->connect('/v/:slug-:city-:statecode-:id', ['controller' => 'Businesses', 'action' => 'view'])
        ->setPass(['slug', 'city', 'statecode', 'id']);
    $builder->connect('/upgrade/:slug-:city-:statecode-:id', ['controller' => 'Businesses', 'action' => 'upgrade'])->setPass(['slug', 'city', 'statecode', 'id']);
    $builder->connect('/checkout/:slug-:city-:statecode-:id', ['controller' => 'Businesses', 'action' => 'checkout'])->setPass(['slug', 'city', 'statecode', 'id']);
    $builder->connect('/user-review-:slug-:city-:statecode-:id', ['controller' => 'Businesses', 'action' => 'userReview'])
        ->setPass(['slug', 'city', 'statecode', 'id']);
    // $routes->connect('/user-review/*', ['controller' => 'Businesses', 'action' => 'userReview']);
    $builder->connect('/user-review-history/*', ['controller' => 'Businesses', 'action' => 'userReviewHistory']);
    $builder->connect('/write-a-review/:slug-:city-:statecode-:id', ['controller' => 'Businesses', 'action' => 'addReview'])
        ->setPass(['slug', 'city', 'statecode', 'id']);
    // $routes->connect('/add-review/*', ['controller' => 'Businesses', 'action' => 'addReview']);
    $builder->connect('/edit-review/*', ['controller' => 'Businesses', 'action' => 'editReview']);
    $builder->connect('/gallery/*', ['controller' => 'Businesses', 'action' => 'gallery']);
    $builder->connect('/claim/:slug-:city-:statecode-:id', ['controller' => 'Businesses', 'action' => 'claim'])
        ->setPass(['slug', 'city', 'statecode', 'id']);
    $builder->connect('/seadot/*', ['controller' => 'Businesses', 'action' => 'setseadot']);
    $builder->connect('/claim/success/*', ['controller' => 'Businesses', 'action' => 'claimSuccess']);
    // $routes->connect('/questions/*', ['controller' => 'Businesses', 'action' => 'questions']);
    $builder->connect('/questions/:slug-:city-:statecode-:id', ['controller' => 'Businesses', 'action' => 'questions'])
        ->setPass(['slug', 'city', 'statecode', 'id']);
    // $routes->connect('/question/*', ['controller' => 'Businesses', 'action' => 'singleQuestion']);
    $builder->connect('/question/:slug-:city-:statecode-:question_slug-:id', ['controller' => 'Businesses', 'action' => 'singleQuestion'])->setPass(['slug', 'city', 'statecode', 'question_slug', 'id']);
    $builder->connect('/user/:arg1/followers', ['controller' => 'User', 'action' => 'followers'])
        ->setPass(['arg1']);
    $builder->connect('/user/:arg1/following', ['controller' => 'User', 'action' => 'following'])
        ->setPass(['arg1']);
    $builder->connect('/user/:arg1/collections', ['controller' => 'User', 'action' => 'collections'])
        ->setPass(['arg1']);
    $builder->connect('/join/:arg1', ['controller' => 'User', 'action' => 'join'])
        ->setPass(['arg1']);
    $builder->connect('/user/:arg1/collections/view/:arg2', ['controller' => 'User', 'action' => 'collectionView'])
        ->setPass(['arg1', 'arg2']);
    $builder->connect('/claim-city/:arg1/:arg2', ['controller' => 'ClaimCity', 'action' => 'index'])
        ->setPass(['arg1', 'arg2']);
    $builder->connect('/user/:arg1/business-photos', ['controller' => 'User', 'action' => 'businessPhotos'])
        ->setPass(['arg1']);
    $builder->connect('/user/:arg1/reviews', ['controller' => 'User', 'action' => 'reviews'])->setPass(['arg1']);
    $builder->connect('/stories/:arg1', ['controller' => 'Stories', 'action' => 'index'])->setPass(['arg1']);
    // $builder->connect('/local_talk/:arg1', ['controller' => 'Stories', 'action' => 'view'])->setPass(['arg1']);
    $builder->connect('/local_talk/*', ['controller' => 'Stories', 'action' => 'view']);
    $builder->connect('/user/*', ['controller' => 'User', 'action' => 'index']);
    $builder->connect('/assets/**', ['controller' => 'assets', 'action' => 'index']);
    $builder->connect('/img/**', ['controller' => 'assets', 'action' => 'img']);
    $builder->connect('/plugins/**', ['controller' => 'assets', 'action' => 'plugins']);
    /*
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $builder->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
     $builder->connect('/pages/*', ['controller' => 'Pages', 'action' => 'about']);

    /*
     * Connect catchall routes for all controllers.
     *
     * The `fallbacks` method is a shortcut for
     *
     * ```
     * $builder->connect('/:controller', ['action' => 'index']);
     * $builder->connect('/:controller/:action/*', []);
     * ```
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $builder->fallbacks();
});


// $routes->prefix('api', ['_namePrefix' => 'api:'], function (RouteBuilder $builder) {
//     $builder->fallbacks();
// });


$routes->prefix('admin', ['_namePrefix' => 'admin:'], function (RouteBuilder $builder) {
    // scopres($builder);
    $builder->fallbacks();
});


/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * $routes->scope('/api', function (RouteBuilder $builder) {
 *     // No $builder->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
