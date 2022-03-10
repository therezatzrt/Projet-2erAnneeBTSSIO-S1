<?php

namespace App\Controller;

use App\Entity\Calendrier;
use App\Repository\CalendrierRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
    // la methode PUT permet de mettre ajour un enregistrement ou le cree sil nexiste pas 
    /**
     * @Route("/api/{id}/edit", name="api_event_edit", methods={"PUT"})
     */
    public function majEvent(?CalendrierRepository $calendar, Request $request)
    {
        // on recupere les données envpyer par fullcalendar
        $donnees = json_decode($request->getContent());
        
        if (
            isset($donnees->titre ) && !empty($donnees->titre) &&
            isset($donnees->start ) && !empty($donnees->start) &&
            isset($donnees->description ) && !empty($donnees->description) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->tborderColor ) && !empty($donnees->borderColor) &&
            isset($donnees->textColor ) && !empty($donnees->textColor) 
            ){
                // les donnees sont complètes
                // on initialise un code 
                $code = 200;
                // on vérifie si l'id existe
                if(!$calendar){
                    //on instance un rdv
                   $calendar = new Calendrier;
                    // on change le code
                    $code = 201;
                }
                // on hydrate l'objet avec les données
                $calendar ->setTitre($donnees->Title);
                $calendar ->setDescription($donnees->descritpion);
                $calendar ->setStart(new DateTime ($donnees->Titre));
                if($donnees ->allDay){
                    $calendar->setEnd(new DateTime($donnees->start));
                }else{
                    $calendar->setEnd(new DateTime($donnees->end));
                }
                $calendar ->setAllDay($donnees->allDay);
                $calendar ->setBackgroundColor($donnees->backgroundColor);
                $calendar ->setBorderColor($donnees->borderColor);
                $calendar ->setTextColor($donnees->textColor);
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($calendar);
                $em->flush();
                
                // on retourne le code
                return new Response('ok', $code);
            }else {
                // les donnees sont incomplètes
                return new Response('Donnés incomplètes', 404);

            }



        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
