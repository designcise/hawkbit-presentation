<?php
/**
 * Created by PhpStorm.
 * User: marco.bunge
 * Date: 14.10.2016
 * Time: 13:40
 */

namespace Hawkbit\Persistence;


use League\Container\Container;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class PersistenceServiceProvider extends AbstractServiceProvider
{

    protected $provides = [

    ];

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
}