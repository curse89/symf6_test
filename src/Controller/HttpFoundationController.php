<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\AcceptHeader;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\File\Stream;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\UrlHelper;
use Symfony\Component\Routing\Annotation\Route;

class HttpFoundationController extends AbstractController
{
    #[Route('/http/foundation', name: 'app_http_foundation')]
    public function index(): Response
    {
        return $this->render('http_foundation/index.html.twig', [
            'controller_name' => 'HttpFoundationController',
        ]);
    }

    #[Route(
        '/request/{id}',
        name: 'request',
        condition: "params['id'] < 1000"
    )]
    public function request(int $id): JsonResponse
    {
        $request = Request::createFromGlobals();
        $a = $request->cookies->count();
        $s = $request->getPathInfo();
        //$sess = $request->getSession();
        $b = $request->hasPreviousSession();
        $g = HeaderUtils::parseQuery('foo[bar.baz]=qux');
        $request2 = Request::create(
            '/hello-world',
            'GET',
            ['name' => 'Fabien']
        );

        $acceptHeader = AcceptHeader::fromString($request->headers->get('Accept'));
        if ($acceptHeader->has('text/html')) {
            $item = $acceptHeader->get('text/html');
            $charset = $item->getAttribute('charset', 'utf-8');
            $quality = $item->getQuality();
        }

        $acceptHeaders2 = AcceptHeader::fromString($request->headers->get('Accept'))
            ->all();


        return new JsonResponse("id $id");
    }

    #[Route(
        '/response/{id}',
        name: 'response',
        condition: "params['id'] < 1000"
    )]
    public function response(int $id): Response
    {
        $response = new Response(
            'Content' . $id,
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
        $response->headers->setCookie(Cookie::create('foo', 'bar'));
        $response->setCache([
            'must_revalidate'  => false,
            'no_cache'         => false,
            'no_store'         => false,
            'no_transform'     => false,
            'public'           => true,
            'private'          => false,
            'proxy_revalidate' => false,
            'max_age'          => 600,
            's_maxage'         => 600,
            'stale_if_error'   => 86400,
            'stale_while_revalidate' => 60,
            'immutable'        => true,
            'last_modified'    => new \DateTime(),
            'etag'             => 'abcdef',
        ]);
        /*$response->sendHeaders();
        $response->sendContent();
        $response->send();*/

        $response = new StreamedResponse();
        $response->headers->set('X-Accel-Buffering', 'no');
        $response->setCallback(
            function () {
                var_dump('hello');
                flush();
                sleep(2);
                var_dump('jopa');
                flush();
            }
        );
        //$response->send();
        $file = '/symfony_app/.env';
        $response = new BinaryFileResponse($file);
        $response->headers->set('Content-Type', 'text/plain');
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'filename.txt'
        );
        //$response->send();
        $stream = new Stream('/symfony_app/.env');
        $response = new BinaryFileResponse($stream);
        $response->send();
    }

    #[Route('/url')]
    public function url(Request $request, UrlHelper $helper): Response
    {
        $url = $helper->getAbsoluteUrl('asd');
        $url2 = $helper->getRelativePath('/xxx/asd/99');
        return (new Response())->setContent("1 - $url/2 - $url2");
    }
}
