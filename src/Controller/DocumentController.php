<?php

namespace App\Controller;

use App\Entity\Document;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;


class DocumentController extends Controller
{
    /**
     * Liste d'entêtes de document pour le client connecté
     *
     *
     * @Route(
     *     name = "api_document_header_items_get",
     *     path = "/api/documents/ws/header",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste d'entête de document pour le client connecté",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Document::class, groups={"full"}))
     *     )
     * )
     */
    public function documEntGetAction(Request $request)
    {
        return $this->json('success');
    }
}