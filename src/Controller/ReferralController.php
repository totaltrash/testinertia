<?php
namespace App\Controller;

use Rompetomp\InertiaBundle\Service\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
// use App\Repository\ItemRepository;
// use App\Entity\Item;
// use App\Form\ItemType;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/referral")
 */
class ReferralController extends AbstractController
{
    /**
     * @Route("/form/{guid}", methods="GET", name="referral_form", options={"expose"=true})
     */
    public function form($guid, InertiaInterface $inertia, NormalizerInterface $normalizer)
    {
        return $inertia->render('Referral/Form', [
            // 'item' => $normalizer->normalize($item, null, ['groups' => 'item_list']),
            'guid' => $guid 
        ]);
    }
}
