<?php 

require_once 'vendor/autoload.php'; //requisição do autoload do silex

$app = new \Silex\Application(); //instancia do objeto do silex

$app['debug']= true; //ativa o modo de debug

$app->register(new Silex\Provider\TwigServiceProvider(), array( //registra o serviço do twig
    'twig.path' => __DIR__.'/views',
));

$app->register(new Silex\Provider\RoutingServiceProvider()); //registra o serviço de geração de rotas

?>