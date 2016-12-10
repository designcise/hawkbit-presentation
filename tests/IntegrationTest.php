<?php
/**
 * Created by PhpStorm.
 * User: marco.bunge
 * Date: 18.10.2016
 * Time: 15:07
 */

namespace Hawkbit\Presentation\Tests;


use ContainerInteropDoctrine\EntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;
use Hawkbit\Application;
use Hawkbit\Presentation\PresentationService;
use Hawkbit\Presentation\PresentationServiceInterface;
use Hawkbit\Presentation\PresentationServiceProvider;
use League\Plates\Engine;
use org\bovigo\vfs\vfsStream;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{

    public function testIntegration()
    {
        $app = new Application(require __DIR__ . '/assets/config.php');
        $app->register(new PresentationServiceProvider($app->getConfig('templates')));

        $engine = $app[Engine::class];
        $result = $engine->render('index', ['world' => 'World']);

        $this->assertInstanceOf(Engine::class, $engine);
        $this->assertEquals('Hello World', $result);
    }
}
