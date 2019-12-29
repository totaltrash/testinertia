<?php
namespace App\Controller;

use Rompetomp\InertiaBundle\Service\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ItemRepository;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(InertiaInterface $inertia)
    {
        return $inertia->render('Dashboard', ['prop' => 'propValue']);
    }

    /**
     * @Route("/item/", name="item_list")
     */
    public function itemList(InertiaInterface $inertia, ItemRepository $repo, NormalizerInterface $normalizer)
    {
        return $inertia->render('ItemList', [
            'items' => $normalizer->normalize(
                $repo->findAll(),
                null,
                ['groups' => 'item_list']
            ),
        ]);
    }
}
