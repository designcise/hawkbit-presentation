<?php
/**
 * The Hawkbit Micro Framework. An advanced derivate of Proton Micro Framework
 *
 * @author Daniyal Hamid (@Designcise) <hello@designcise.com>
 * @copyright Daniyal Hamid (@Designcise) <hello@designcise.com>
 *
 * @license MIT
 */

namespace Hawkbit\Presentation;

use League\Plates\Engine;
use League\Plates\Extension\Asset;
use League\Plates\Extension\ExtensionInterface;
use Psr\Http\Message\ResponseInterface;

class Plates
{
	/**
     * @var string[]
     */
    private $settings;
	
	/**
     * @var \League\Plates\Engine
     */
    private $plates;

    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
	
	/**
     * Create new Hawkbit\Presentation\Plates instance.
     *
     * @param string[] $settings
     * @param null|\Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(array $settings, ResponseInterface $response = null)
    {
		// merge default + user settings
        $this->settings = array_merge([
			'directory' => null,
			'fileExtension' => 'php',
			'assetPath' => null,
			'filenameCaching' => false,
		], $settings);
		
		// instantiate plates
        $this->plates = new Engine($this->settings['directory'], $this->settings['fileExtension']);
        $this->response = $response;
		
		$this->setAssetPath($this->settings['assetPath']);
    }
	
	/**
     * Set Asset path from Plates Asset Extension.
     *
     * @param \League\Plates\Extension\ExtensionInterface $extension
     *
     * @return \League\Plates\Engine
     */
    public function loadExtension(ExtensionInterface $extension)
    {
        $extension->register($this->plates);

        return $this->plates;
    }
	
	/**
     * Render the template.
     *
     * @param string   $name
     * @param string[] $data
     *
     * @throws \LogicException
     *
     * @return Mixed
     */
    public function render($name, array $data = [])
    {	
		$out = $this->plates->render($name, $data);
		
		if(is_null($this->response)) {
			// @return string
			return $out;
		}
		
		$this->response->getBody()->write($out);
		
		// @return \Psr\Http\Message\ResponseInterface
        return $this->response;
    }
	
	
	/**
     * Get property.
     *
     * @param string $prop
	 *
	 * @return Mixed
     */
	public function __get($prop) 
	{
		// @return settings value
		if (isset($this->settings[$prop])) {
			return $this->settings[$prop];
		}
		// @return \Psr\Http\Message\ResponseInterface $response
		else if ($prop === 'response') {
			return $this->response;
		}
		// @return \League\Plates\Engine
		else if ($prop === 'plates') {
			return $this->plates;
		}
		
		return null;
	}
	
	
	
	/**
     * Set Asset path from Plates Asset Extension.
     *
     * @param string $assetPath
     *
     * @return \League\Plates\Engine
     */
    private function setAssetPath($assetPath)
    {
		if (!is_null($this->settings['assetPath'])) {
			return $this->plates->loadExtension(
				new \League\Plates\Extension\Asset($assetPath, $this->settings['filenameCaching'])
			);
		}
    }
	
	
	/**
     * Set property.
     *
     * @param string $prop
     * @param mixed $value
     */
	public function __set($prop, $value) 
	{
		switch($prop) {
			case 'response':
				$this->response = $value;
			break;
				
			case 'assetPath':
				if (!is_null($value)) {
					$this->setAssetPath($value);
				}
				
			case 'directory':
			case 'fileExtension':
			case 'filenameCaching':
				$this->settings[$prop] = $value;
			break;
		}
	}
	
	
	/**
     * Expose native Plates object methods.
     *
     * @param string $name
     * @param array $args
     * @param bool   $fallback
     *
     * @return Mixed
     */
	public function __call($name, $args) 
	{
		if (method_exists($this->plates, $name)) {
			return call_user_func_array(array($this->plates, $name), $args);
		}
	}
	
}
