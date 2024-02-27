<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use App\Form\ContactFormType;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly MailerInterface $mailer
    ) {
    }

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        $formData = [];
        $form = $this->createForm(ContactFormType::class, $formData);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            $message = (new \Symfony\Component\Mime\Email())
                ->from($formData['email'])
                ->to('nowak.louis@gmail.com')
                ->subject($formData['sujet'])
                ->text($formData['email']);
            $this->mailer->send($message);

            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function toBase(Request $request): Response
    {
        $jsonFile = file_get_contents('public/assets/entrypoint.app.json');

        // Décoder le contenu JSON
        $decodedJson = json_decode($jsonFile, true);

        // Renvoyer la réponse avec le contenu JSON
        return $this->render('base.html.twig', [
            'assetUrls' => $decodedJson,
        ]);
    }
}
