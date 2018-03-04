<?php
/**
 * Created by PhpStorm.
 * User: Hugo LIEGEARD
 * Date: 22/02/2018
 * Time: 12:40
 */

namespace App\Controller\Security;


use App\Entity\Auteur;
use App\Form\AuteurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * Connexion d'un utilisateur
     * @Route("/connexion", name="security_connexion")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function connexion(Request $request, AuthenticationUtils $authenticationUtils)
    {
        # Récupération du message d'erreur s'il y en a un.
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastEmail = $authenticationUtils->getLastUsername();

        return $this->render('security/connexion.html.twig', array(
            'last_email'    => $lastEmail,
            'error'         => $error,
        ));
    }

    /**
     * Inscription d'un utilisateur
     * @Route("/inscription", name="security_inscription", methods={"GET", "POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        # Création d'un nouvel auteur
        $auteur = new Auteur();
        $auteur->setRoles('ROLE_MEMBRE');

        # Créer un Formulaire permettant l'ajout d'un Auteur
        $form = $this->createForm(AuteurType::class, $auteur);

        # Traitement des données POST
        $form->handleRequest($request);

        # Vérification des données du Formulaire
        if ($form->isSubmitted() && $form->isValid()) :

            # Gestion du mot de passe
            $password = $passwordEncoder->encodePassword($auteur, $auteur->getPassword());
            $auteur->setPassword($password);

            # Insertion en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($auteur);
            $em->flush();

            # Redirection sur la page connexion
            return $this->redirect('connexion?inscription=success');

        endif;

        # Affichage du Formulaire dans la Vue
        return $this->render('security/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
