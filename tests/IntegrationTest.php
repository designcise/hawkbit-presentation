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
use Hawkbit\Presentation\Presentation;
use Hawkbit\Presentation\PresentationService;
use Hawkbit\Presentation\PresentationServiceInterface;
use Hawkbit\Presentation\PresentationServiceProvider;
use Hawkbit\Presentation\Tests\Mocks\InjectableController;
use League\Plates\Engine;
use org\bovigo\vfs\vfsStream;
use Zend\Diactoros\ServerRequestFactory;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{

    public function testIntegration()
    {
        $app = new Application(require __DIR__ . '/assets/config.php');
        $app->register(new PresentationServiceProvider($app->getConfig('templates')));

        $engine = $app[PresentationService::class];
        $result = $engine->render('index', ['world' => 'World']);

        $this->assertInstanceOf(PresentationService::class, $engine);
        $this->assertEquals('Hello World', $result);
    }

    public function testInjectableIntegration()
    {
        $app = new Application(require __DIR__ . '/assets/config.php');
        $app->register(new PresentationServiceProvider($app->getConfig('templates')));

        $app->get('/', [InjectableController::class, 'getIndex']);

        $response = $app->handle(ServerRequestFactory::fromGlobals());

        $this->assertEquals('Hello World', $response->getBody()->__toString());
    }

    public function testExtendEngine()
    {
        $app = new Application(require __DIR__ . '/assets/config.php');
        $app->register(new PresentationServiceProvider($app->getConfig('templates')));

        /** @var PresentationService $service */
        $service = $app[PresentationService::class];
        $service->getEngine()
            ->addFolder('acme', __DIR__ . '/templates/acme')
            ->registerFunction('uppercase', function ($string) {
                return strtoupper($string);
            });

        $app->get('/', [InjectableController::class, 'getAcme']);
        $response = $app->handle(ServerRequestFactory::fromGlobals());
        $this->assertEquals('FOO BAR', $response->getBody()->__toString());
    }


}
