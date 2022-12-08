<?php

namespace App\Controller;

use App\Model\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidateController extends AbstractController
{
    #[Route('/v', name: 'app_validate')]
    public function index(ValidatorInterface $validator): Response
    {
        $author = new Author();
        $author->firstName = 'test';
        $res = $validator->validate($author);
        return $this->render('validate/index.html.twig', [
            'controller_name' => 'ValidateController',
        ]);
    }
}
