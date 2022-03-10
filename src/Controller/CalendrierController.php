<?php

namespace App\Controller;

use App\Repository\CalendrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendrierController extends AbstractController
{
    /**
     * @Route("/calendrier", name="calendrier")
     */
    public function index(CalendrierRepository $calendar)
    {
        $events = $calendar ->findAll();

        $rdvs = [];
        foreach($events as $events){
            $rdvs[] = [
                'id' => $events -> getId(),
                'start' => $events -> getStart() -> format('Y-m-d H:i:s'),
                'end' => $events -> getEnd()-> format('Y-m-d H:i:s'),
                'titre' => $events -> getTitre(),
                'description' => $events -> getDescription(),
                'backgroundColor' => $events -> getBackgroundColor(),
                'borderColor' => $events -> getBorderColor(),
                'textColor' => $events -> getTextColor(),
                'allDay' => $events -> getAllDay(),
            ];
        }
        
        $data =json_encode($rdvs);

        return $this->render('calendrier/index.html.twig',compact('data'));
    }
}
