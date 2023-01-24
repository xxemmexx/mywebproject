<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    public const MOVIES = [
        'le-torrent' => ['Le Torrent', '2022-11-30', ['Thriller']],
        'johny-hallday' => ['Johnny Hallday', '2022-12-05', ['Concert']],
        'days' => ['Days', '2022-11-30', ['Drama', 'Romance']]
        ];

    #[Route('/movies/{slug<[a-z0-9-]+>}', name: 'app_movies')]
    public function movieDetail(string $slug): Response
    {
        if(!isset(self::MOVIES[$slug])) {
            throw $this->createNotFoundException();
        }

        [$title, $releasedAt, $genres] = self::MOVIES[$slug];

        return $this->render('movies/index.html.twig', [
            'title' => $title,
            'releasedAt' => $releasedAt,
            'genres' => $genres,
        ]);
    }
}
