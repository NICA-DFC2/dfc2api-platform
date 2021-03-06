<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/logout", name="logout", methods="GET")
     */
    public function logout()
    {
        $response = array(
            'code' => 200,
            'message' => 'Déconnexion réussie.',
            'user' => null,
            'token' => null
        );

        $finalResponse = json_encode($response);

        $response = new Response($finalResponse);
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(200);

        return $response;
    }
}