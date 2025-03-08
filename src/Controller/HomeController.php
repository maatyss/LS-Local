<?php

namespace App\Controller;

use App\Form\MarkerFormType;
use App\Repository\MarkerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
        ]);
    }

    #[IsGranted('ROLE_GROUPE_CJGN')]
    #[Route('/map', name: 'app_map')]
    public function map(MarkerRepository $markerRepository): Response
    {
        $markerNorth = $markerRepository->getRegionMarkers('north');
        $markerSouth = $markerRepository->getRegionMarkers('south');

        return $this->render('map/map.html.twig', [
            'markersNorth' => $markerNorth,
            'markersSouth' => $markerSouth,
        ]);
    }

    #[IsGranted('ROLE_GROUPE_CJGN')]
    #[Route('/create/marker/{region}/{posX}/{posY}', name: 'app_create_marker')]
    public function marker(Request $request, EntityManagerInterface $manager, $region, $posX, $posY): Response
    {
        $user = $this->getUser()?? null;

        $marker = new Marker();
        $marker->setCreator($user)
            ->setRegion($region)
            ->setPosX($posX)
            ->setPosY($posY)
        ;

        $manager->persist($marker);

        $form = $this->createForm(MarkerFormType::class);
        $form->remove('posX')
            ->remove('posY')
            ->remove('region')
            ->remove('creator');
        $form->handleRequest($request);

//        Ajouter && $user a la condition quand user sera complétement implémenter
        if ($form->isSubmitted() && $form->isValid()){

            $marker->setName($form->get('name')->getData())
                ->setTitle($form->get('title')->getData())
                ->setComment($form->get('comment')->getData())
                ;

            if ($file = $form->get('image')->getData()){
                $entriesPictureDir = __DIR__.'/../../public/upload/img/marker/'.$user->getId()
                ;

                $file->move($entriesPictureDir,$filename = 'marker_'.$region.'_'.$posX.'-'.$posY.$file->guessExtension());
                $marker->setImage($filename);
            }
            $manager->flush();
            return $this->redirectToRoute('app_map');
        }

        return $this->render('map/marker.html.twig',[
            'form' => $form,
        ]);
    }
}
