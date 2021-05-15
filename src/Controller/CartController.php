<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    // /**
    //  * @Route("/add/{id}", methods={"POST"}, name="add_cart", requirements={"id"="\d+"})
    //  */
    // public function addCart(Request $request, SessionInterface $session, BirdModel $birdModel, int $id): RedirectResponse
    // {
    //     //je récupère l'id grace à request
    //     $birdId = $request->attributes->get('id');
    //     //avec l'id je récupère l'oiseau correspondant (comme la methode show)
    //     $bird = $birdModel->getBird($birdId);
    //     //je récupère le nom de l'oiseau 
    //     $birdName = $bird['name'];
    //     // en session je stocke une entrée $birdName et un contenu $bird(contenu/descriptif)
    //     //de cette manière l'entrée du $birdName sera dynamique et changera lorsque j'ajouterai un nouvel oiseau au panier
    //     $session->set($birdName, $bird);

    //     //$data = $session->get('id');
    //     //dd($session);
    //     return $this->redirectToRoute('cart');
    // }


    /**
     * @Route("/cart/add", name="add_cart",  methods={"POST"},)
     */
    public function add(Request $request, SessionInterface $session, BirdModel $birdModel): Response
    {
        // Récupérer l'id de l'oiseau
        $id = $request->request->get('id'); // $_POST['id'];

        // 404 ? Si oiseau non trouvé
        $bird = $birdModel->getBird($id);
        
        if (null === $bird) {
            throw $this->createNotFoundException('Bird not found.');
        }

        // Pour le mettre dans le panier en session
        // 1. On récupère le panier en session
        // /!\ On veut stocker plusieurs oiseaux, donc le panier est un tableau
        $cart = $session->get('cart', []);


         // On va mettre l'id comme clé du tableau cart, si non existant
         if (!array_key_exists($id, $cart)) {
            // Nouvel oiseau
            // On y ajoute l'id de l'oiseau avec la quantité 1
            $cart[$id] = 1;
        } else {
            // Oiseau déjà dans le panier
            // On ajoute 1 à la quantité
            $cart[$id]++;
        }

        // 3. On remet le panier en session
        $session->set('cart', $cart);

    

        // Ajout d'un flash message
        $this->addFlash('success', 'Article ajouté au panier !');
        // $this->addFlash('success', 'Article vraiment ajouté au panier.');
        // $this->addFlash('danger', 'Attention !');

        // On redirige vers la page panier
        return $this->redirectToRoute('cart_list');
    }





    
    /**
     * @Route("/cart", name="cart_list", methods={"GET"})
     */
    public function list(SessionInterface $session, BirdModel $birdModel)
    {
        // Le contenu du panier sur lequel on va boucler pour récupérer les id d'oiseaux
        $cart = $session->get('cart', []);
       

        // Il nous faut la liste des oiseaux pour les afficher à partir de leur id
        $birds = $birdModel->getBirds();

        return $this->render('cart/list.html.twig', [
            'cart' => $cart,
            'birds' => $birds,
        ]); 
    }


    /**
     * Remove cart content
     * 
     * @Route("/cart/remove", name="cart_remove", methods={"POST"})
     */
    public function remove(SessionInterface $session)
    {
        // On supprime l'attribut "cart" de la session
        $session->remove('cart'); // unset($_SESSION['cart']);

        $this->addFlash('success', 'Cart cleared.');

        return $this->redirectToRoute('cart_list');
    }


}
