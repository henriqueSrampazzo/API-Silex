<?php 

require_once 'vendor/autoload.php'; //requisição do autoload do silex

use Doctrine\ORM\Tools\Setup,  //usando doctrine
Doctrine\ORM\EntityManager,
Doctrine\Common\EventManager as EventManager,
Doctrine\ORM\Events,
Doctrine\ORM\Configuration,
Doctrine\Common\Cache\ArrayCache as Cache,
Doctrine\Common\Annotations\AnnotationRegistry,
Doctrine\Common\Annotations\AnnotationReader,
Doctrine\Common\ClassLoader;

$cache = new Doctrine\Common\Cache\ArrayCache; //configuração de cacheamento
$annotationReader = new Doctrine\Common\Annotations\AnnotationReader;

$cachedAnnotationReader = new Doctrine\Common\Annotations\CachedReader(
    $annotationReader, // use reader
    $cache // and a cache driver
);

$annotationDriver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
    $cachedAnnotationReader, // our cached annotation reader
    array(__DIR__ . DIRECTORY_SEPARATOR . 'src') //apartir daqui busca o codigo fonte 
);

$driverChain = new Doctrine\ORM\Mapping\Driver\DriverChain();
$driverChain->addDriver($annotationDriver,'Code');

$config = new Doctrine\ORM\Configuration; //configurações gerais 
$config->setProxyDir('/tmp');
$config->setProxyNamespace('Proxy');
$config->setAutoGenerateProxyClasses(true); // this can be based on production config.
// register metadata driver
$config->setMetadataDriverImpl($driverChain);
// use our allready initialized cache driver
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);


AnnotationRegistry::registerFile(__DIR__. DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'doctrine' . DIRECTORY_SEPARATOR . 'orm' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Doctrine' . DIRECTORY_SEPARATOR . 'ORM' . DIRECTORY_SEPARATOR . 'Mapping' . DIRECTORY_SEPARATOR . 'Driver' . DIRECTORY_SEPARATOR . 'DoctrineAnnotations.php');  //busca a localização das annotation

$evm = new Doctrine\Common\EventManager();

$em = EntityManager::create(   //gerencia todas as entidades no banco
    array(
        'driver'  => 'pdo_mysql',
        'host'    => '127.0.0.1',
        'port'    => '3306',
        'user'    => 'root',
        'password'  => '',
        'dbname'  => 'trilhando_doctrine',
    ),
    $config,
    $evm
);

$app = new \Silex\Application(); //instancia do objeto do silex

$app['debug']= true; //ativa o modo de debug

$app->register(new Silex\Provider\TwigServiceProvider(), array( //registra o serviço do twig
	'twig.path' => __DIR__.'/views',
));

$app->register(new Silex\Provider\RoutingServiceProvider()); //registra o serviço de geração de rotas

?>