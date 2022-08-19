<?php
//src/Controller/AgeraController.php
namespace App\Controller;

use App\Helper\AgeraHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AgeraController extends AbstractController
{
    private AgeraHelper $ageraHelper;

    public function __construct(AgeraHelper $ageraHelper)
    {
        $this->ageraHelper = $ageraHelper;
    }

    #[Route('/agera')]
    public function ageraMain(): Response
    {
        $numberOfProducts = $this->ageraHelper->numberOfProducts();
        $lowestPrice = $this->ageraHelper->lowestPrice();
        $maxPrice = $this->ageraHelper->maxPrice();

        return $this->render('agera.html.twig', [
            'numberOfProducts' => $numberOfProducts,
            'lowestPrice' => $lowestPrice,
            'maxPrice' => $maxPrice,
        ]);
    }

    #[Route('/agera/products')]
    public function ageraProducts(): Response
    {
        $allArticles = $this->ageraHelper->allArticles();


        return $this->render('agera_products.html.twig', [
            'allArticles' => $allArticles,
        ]);
    }

    #[Route('/agera/category')]
    public function ageraCategory(): Response
    {
        $allArticles = $this->ageraHelper->allArticles();

        return $this->render('agera_category.html.twig', [
            'allArticles' => $allArticles,
        ]);
    }
}