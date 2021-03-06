<?php

namespace App\Controller;

use App\Repository\BookCopyRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class SearchController
 * @package App\Controller
 */
class SearchController extends Controller
{
    /**
     * @Route("/search", name="ajax_search")
     * @param Request $request
     * @param BookCopyRepository $repository
     * @return \Symfony\Component\HttpFoundation\JsonResponse|Response
     */
    public function search(Request $request, BookCopyRepository $repository)
    {
        if ($request->isXmlHttpRequest()) {
            $foundBooks = $this->findBySearch($request, $repository);
            return $this->json($foundBooks);
        }

        $foundBooks = $this->findBySearch($request, $repository);

        return $this->render('search/index.html.twig', [
            'foundBooks' => $foundBooks
        ]);
    }

    /**
     * @param Request $request
     * @param BookCopyRepository $repository
     * @return mixed
     */
    private function findBySearch(Request $request, BookCopyRepository $repository)
    {
        $search = $request->get('q') ?? '';
        return $repository->findBySearch($search);
    }
}