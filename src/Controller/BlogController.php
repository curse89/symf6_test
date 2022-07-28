<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

#[Route('/blog', name: 'blog_')]
class BlogController extends AbstractController
{
    #[Route('/', name: 'start', methods: ['GET'])]
    public function start(): JsonResponse
    {
        return new JsonResponse('privet');
    }

    #[Route('/index/blog', name: 'blog', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse('blog - index');
    }

    #[Route(
        '/posts/{id}',
        name: 'post_show',
        condition: "params['id'] < 1000"
    )]
    public function showPost(int $id): JsonResponse
    {
        $a = getenv('TEST');
        return new JsonResponse("id $id");
    }

    #[Route('/blog/{!slug}/{!cat<\d+>?1}', name: 'blog_show')]
    public function show(string $slug, string $cat): Response
    {
        return new JsonResponse("$slug - $cat");
    }

    #[Route('/blog/{page}', name: 'blog_page')]
    public function page(int $page = 1): Response
    {
        return new JsonResponse($page);
    }

    #[Route('/blog/{slug}', name: 'blog_print', schemes: ['https'], priority: 3)]
    public function print(string $slug)
    {
        return new JsonResponse("print - $slug");
    }

    /**
     * This route could not be matched without defining a higher priority than 0.
     */
    #[Route('/blog/list', name: 'blog_list', priority: 4)]
    public function list(): JsonResponse
    {
        return new JsonResponse("list");
    }

    #[Route('/blog/post/{slug}', host: 'localhost')]
    public function blogpost(BlogPost $post1, Request $req): JsonResponse
    {
        try {
            $url = $this->generateUrl('blog_blog_list', [], UrlGeneratorInterface::ABSOLUTE_URL);
        } catch (RouteNotFoundException $e) {
            $a = 2;
        }

        return new JsonResponse($post1);
    }

    #[Route(
        path: '/articles/{_locale}/search.{_format}',
        requirements: [
            '_locale' => 'en|ru',
            '_format' => 'html|xml',
        ],
        locale: 'en',
        format: 'html',
    )]
    public function search(Request $req, RequestStack $stack): Response
    {

        $routeName = $req->attributes->get('_route');
        $routePar = $req->attributes->get('_route_params');
        $allAttr = $req->attributes->all();
        return new Response($req);
    }
}