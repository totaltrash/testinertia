<?php
namespace App\Controller;

use Rompetomp\InertiaBundle\Service\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ItemRepository;
use App\Entity\Item;
use App\Form\ItemType;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/item")
 */
class ItemController extends AbstractController
{
    /**
     * @Route("/", name="item_list", options={"expose"=true})
     */
    public function index(InertiaInterface $inertia, ItemRepository $repo, NormalizerInterface $normalizer)
    {
        return $inertia->render('Item/List', [
            'items' => $normalizer->normalize(
                $repo->findAll(),
                null,
                ['groups' => 'item_list']
            ),
        ]);
    }

    /**
     * @Route("/{id}", methods="GET", name="item_edit", options={"expose"=true})
     */
    public function edit(InertiaInterface $inertia, Item $item, NormalizerInterface $normalizer)
    {
        return $inertia->render('Item/Edit', [
            'item' => $normalizer->normalize($item, null, ['groups' => 'item_list']),
        ]);
    }

    /**
     * @Route("/{id}", methods="PUT", name="item_update", options={"expose"=true})
     */
    public function update(InertiaInterface $inertia, Item $item, Request $request, EntityManagerInterface $em, NormalizerInterface $normalizer)
    {
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(ItemType::class, $item);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Item successfully updated');
            $this->addFlash('info', 'Some info message');
            $this->addFlash('success', 'Some success message');
            $this->addFlash('warning', 'Some warning message');
            return $this->redirectToRoute('item_list');
        }
        // dump($form->getErrors(true));
        // exit();
        return $inertia->render('Item/Edit', [
            'item' => $normalizer->normalize($item, null, ['groups' => 'item_list']),
            'errors' => $this->normalizeErrors($form)
            // 'errors' => [
            //     'name' => ['Required Field', 'Not good enough']
            // ]
        ]);
    }

    protected function normalizeErrors($form)
    {
        $errorArray = [];
        foreach ($form->getErrors(true) as $error) {
            $strip = 'data.';
            $propertyPath = $error->getCause()->getPropertyPath();
            if (substr($propertyPath, 0, strlen($strip)) == $strip) {
                $propertyPath = substr($propertyPath, strlen($strip));
            }
            $errorArray[$propertyPath] = $error->getMessage();
        }
        return $errorArray;
    }
}
