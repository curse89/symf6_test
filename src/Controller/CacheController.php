<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class CacheController extends AbstractController
{
    #[Route('/c', name: 'app_cache')]
    public function index(TagAwareCacheInterface $curseCachePool): Response
    {
        $val = $curseCachePool->get('item_0', function (ItemInterface $item) {
            $k = $item->getKey();
            $item->set('xxx');
            $x = $item->get();
            //$item->tag(['foo', 'bar']);

            return $x;
        }, 1.0);

        /* $val2 = $curseCachePool->get('foo', function (ItemInterface $item) {
            return $item->get('foo');
        });*/

        $curseCachePool->invalidateTags(['foo']);

        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }
}