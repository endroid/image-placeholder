<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

final class ImagePlaceholderController extends AbstractController
{
    #[Route('/image-placeholder')]
    public function __invoke(
        Environment $renderer
    ): Response {
        return new Response($renderer->render('image-placeholder.html.twig'));
    }
}
