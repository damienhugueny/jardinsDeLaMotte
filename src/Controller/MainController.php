<?php

namespace App\Controller;

use App\Entity\ProductCategory;
use App\Repository\PlantRepository;
use App\Repository\HourlyRepository;
use App\Repository\MarketRepository;
use App\Repository\OriginRepository;
use App\Repository\ProductRepository;
use App\Repository\PlantTypeRepository;
use App\Repository\PlantCategoryRepository;
use App\Repository\ProductCategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(HourlyRepository $hourlyRepository ,MarketRepository $marketRepository ,PlantTypeRepository $plantTypeRepository, PlantCategoryRepository $plantCategoryRepository, PlantRepository $plantRepository, ProductRepository $productRepository, ProductCategoryRepository $productCategoryRepository, OriginRepository $originRepository)
    {

        $types = $plantTypeRepository->findAll();
        $categorys = $plantCategoryRepository->findAll();
        $plants = $plantRepository->findAll();
        $products = $productRepository->findAll();
        $productCategorys = $productCategoryRepository->findAll();
        $origins = $originRepository->findAll();
        $markets = $marketRepository->findAll();
        $hourlys = $hourlyRepository->findAll();
        //dump($plants, $types, $categorys);
        //die();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'plant_types' => $types,
            'plant_categorys' => $categorys,
            'plants' => $plants,
            'products' => $products,
            'product_categorys' => $productCategorys,
            'origins' => $origins,
            'markets' => $markets,
            'hourlys' => $hourlys
        ]);
    }
}
