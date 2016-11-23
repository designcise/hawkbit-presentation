<?php
/**
 * Created by PhpStorm.
 * User: marco.bunge
 * Date: 18.10.2016
 * Time: 15:07
 */

namespace Hawkbit\Persistence\Tests;


use ContainerInteropDoctrine\EntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;
use Hawkbit\Application;
use Hawkbit\Persistence\PersistenceService;
use Hawkbit\Persistence\PersistenceServiceInterface;
use Hawkbit\Persistence\PersistenceServiceProvider;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{

    public function testIntegration()
    {
        $this->markTestSkipped();
        $app = new Application(require __DIR__ . '/assets/config.php');


    }
}
