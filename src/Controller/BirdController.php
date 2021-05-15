<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class BirdController extends AbstractController 
{
    /**
     * @Route("/", name="home", methods={"GET"})
     * 
     * Pour récupérer un "service" (un objet), depuis le contrôleur
     * on "l'injecte" dans la méthode VIA SON TYPE
     * VIA le type-hinting
     */
    public function home(BirdModel $birdModel)
    {
        //On récupère la liste des oiseaux

        
        $birds = $birdModel->getBirds();


        return $this->render('bird/home.html.twig', [
            'birds' => $birds
            ]);
    }

    /**
     * @Route("/bird/{id}", name="bird_show", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function show($id, BirdModel $birdModel)
    {
        //On récupère un oiseau grace à son id

        $bird = $birdModel->getBird($id);
        
        if (!$bird) {
            throw $this->createNotFoundException('The bird does not exist');
    
        }



        return $this->render('bird/show.html.twig', [
            'bird' => $bird,
            'id' => $id
            ]);
    }

    /**
     * @Route("/download", name="download", methods={"GET"})
     */
    public function download()
    {
        // Téléchargement direct
        return $this->file('files/angry_birds_2015_calendar.pdf');


        // Affichage
        // renommage + affiche dans le navigateur
        // return $this->file(
        //     'files/angry_birds_2015_calendar.pdf',
        //     'user_calendar.pdf',
        //     ResponseHeaderBag::DISPOSITION_INLINE
        // );
        
    }

    /**
     * @Route("/theme/dark", name="dark_theme")
     */
    public function darkTheme(SessionInterface $session, Request $request)
    {
        // Définir le thème dark en session si pas présent
        if ($session->get('theme') == null) {
            // Définissons un attribut de session, disons 'theme' à 'dark'
            $session->set('theme', 'dark'); // $_SESSION['theme'] = 'dark';
        } else {
            // Sinon, on le supprime
            $session->remove('theme');
        }

        // On redirige vers la home
        //return $this->redirectToRoute('home');        
        // On redirige vers la page d'où on vient
        // cf en-tête HTTP Referer https://developer.mozilla.org/fr/docs/Web/HTTP/Headers/Referer
        // accessible via $request->headers
        // https://symfony.com/doc/current/components/http_foundation.html#accessing-request-data
        //return $this->redirect($request->headers->get('referer'));
        
        return $this->redirect($request->server->get('HTTP_REFERER'));


    }

}