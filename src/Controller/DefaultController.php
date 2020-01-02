<?php
namespace App\Controller;

use Rompetomp\InertiaBundle\Service\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ItemRepository;
use App\Entity\Item;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home", options = { "expose" = true })
     */
    public function index(InertiaInterface $inertia)
    {
        return $inertia->render('Dashboard', ['prop' => 'propValue']);
    }

    /**
     * @Route("/item/", name="item_list", options = { "expose" = true })
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

    /**
     * @Route("/item/{id}", name="item_edit", options = { "expose" = true })
     */
    public function itemEdit(InertiaInterface $inertia, Item $item, NormalizerInterface $normalizer)
    {
        return $inertia->render('ItemEdit', [
            'item' => $normalizer->normalize(
                $item,
                null,
                ['groups' => 'item_edit']
            ),
        ]);
    }
}
