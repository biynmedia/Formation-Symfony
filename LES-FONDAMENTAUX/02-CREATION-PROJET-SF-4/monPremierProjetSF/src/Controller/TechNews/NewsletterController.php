<?php
/**
 * Created by PhpStorm.
 * User: Hugo LIEGEARD
 * Date: 02/03/2018
 * Time: 01:19
 */

namespace App\Controller\TechNews;


use App\Form\NewsletterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewsletterController extends Controller
{

    public function newsletter() {

        $form = $this->createForm(NewsletterType::class);

        # Affichage du Formulaire Newsletter
        return $this->render('newsletter/subscribe.html.twig', [
            'form' => $form->createView()
        ]);

    }

}