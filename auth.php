<?php

use Psr\Http\Message\ServerRequestInterface;


/** CRUD de Categoria */
/** @var  $repository - injetando repository no controller */

/** ação para mostrar o formulário */
$app
    ->get('/login', function () use ($app) {
        $view = $app->service('view.renderer');
        return $view->render('auth/login.html.twig');
    },'auth.show_login_form')
    ->post('/login', function (ServerRequestInterface $request) use ($app) {
         /** ação para fazer o login */
         $view = $app->service('view.renderer');
         $auth = $app->service('auth');
         $data = $request->getParsedBody();
         /** @var  $result - retorna true ou false da autenticacao do usuario*/
         $result = $auth->login($data);
         if(!$result){
            return $view->render('auth/login.html.twig');
         }
         return $app->route('category-costs.list');

    }, 'auth.login');
