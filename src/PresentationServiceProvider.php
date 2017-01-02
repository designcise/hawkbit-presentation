<?php
/**
 * Created by PhpStorm.
 * User: marco.bunge
 * Date: 14.10.2016
 * Time: 13:40
 */

namespace Hawkbit\Presentation;


use Hawkbit\Configuration;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use League\Plates\Engine;

class PresentationServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    /**
     * @var
     */
    private $templates;

    /**
     * PresentationServiceProvider constructor.
     * @param $templates
     */
    public function __construct($templates)
    {
        $this->templates = $templates;
    }

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Method will be invoked on registration of a service provider implementing
     * this interface. Provides ability for eager loading of Service Providers.
     *
     * @return void
     */
    public function boot()
    {
        $container = $this->getContainer();
        $container->share(PresentationService::class)
            ->withArgument($this->templates);
    }
}