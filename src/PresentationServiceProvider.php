<?php
/**
 * Created by PhpStorm.
 * User: marco.bunge
 * Date: 14.10.2016
 * Time: 13:40
 */

namespace Hawkbit\Presentation;


use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Plates\Engine;

class PresentationServiceProvider extends AbstractServiceProvider
{

    protected $provides = [
        Engine::class
    ];
    /**
     * @var array
     */
    private $templates;

    /**
     * PresentationServiceProvider constructor.
     * @param array $templates
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
        $this->registerTemplateEngine();
    }

    /**
     * Register template engine
     *
     * @return $this
     */
    protected function registerTemplateEngine()
    {
        $container = $this->getContainer();
        $this->getContainer()->add(Engine::class, function () use ($container) {
            $templates = $this->templates;
            $default = isset($templates['default']) ? $templates['default'] : reset($templates);
            $engine = new Engine($default);
            foreach ($templates as $name => $template) {
                $engine->addFolder($name, $template, false);
            }
            return $engine;
        });
        return $this;
    }
}