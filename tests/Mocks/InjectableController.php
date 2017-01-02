<?php
/**
 * Created by PhpStorm.
 * User: marco.bunge
 * Date: 02.01.2017
 * Time: 10:12
 */

namespace Hawkbit\Presentation\Tests\Mocks;

use Hawkbit\Presentation\Presentation;
use Hawkbit\Presentation\PresentationService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


/**
 * @codeCoverageIgnore
 */
class InjectableController
{
    /**
     * @var PresentationService
     */
    private $presentationService;

    /**
     * TestInjectableController constructor.
     * @param PresentationService $presentation
     */
    public function __construct(PresentationService $presentation)
    {
        $this->presentationService = $presentation;
    }

    public function getIndex(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $response->getBody()->write($this->presentationService->render('index', ['world' => 'World']));
        return $response;
    }

    public function getAcme(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $response->getBody()->write($this->presentationService->render('acme::index', ['text' => 'foo bar']));
        return $response;
    }
}