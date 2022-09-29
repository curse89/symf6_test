<?php

namespace App\Controller;

use App\Model\Suit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\EnumRequirement;

#[Route('/cards')]
class CardController
{
    #[Route('/{suit}')]
    public function list(Suit $suit): Response
    {
        return new Response("$suit->name | $suit->value");
    }
}
