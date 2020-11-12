<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\ProductFormType;
use App\Repository\ChambreRepository;
use App\Repository\EtudiantRepository;
use ContainerJ2DR1mk\getFosJsRouting_SerializerService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use function Sodium\add;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant", name=")
     */
    public function index()
    {

        return $this->render('etudiant/index.html.twig');
    }

    /**
     * Permet d'afficher toute la liste
     * @param EtudiantRepository $etudiantRepository
     * @Route("/alllistetudiant", options={"expose"=true}, name="alllistetudiant")
     */
    public function allEtudiant(EtudiantRepository $etudiantRepository, Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $encoders = [new XmlEncoder(), new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];

            /*$etudiants = $etudiantRepository->findBy(
                array(),
                array(),
                $limit,
                $offset
            );*/
            $etudiants = $etudiantRepository->findAll();
            $etudianthydrate = [];
            foreach ($etudiants as $etudiant){
                if($etudiant->getStatut() != false){
                    $etudianthydrate[] = $etudiant;
                }
            }
            return $this->json($etudianthydrate,200,[],[ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER=>function($object){
                return $object->getId();
            }]);
        }else{
            throw new \Exception("Aucune requête ajax n'est détecter");
        }
    }

    /**
     * @param $prenom
     * @param $nom
     * @return string
     */
    public function CreerMatricule($prenom,$nom){
        $num=intval(uniqid(rand(100,999)));
        $dernier=strlen($prenom);
        $avantDernier=$dernier-2;
        $cc=substr( $nom, 0,2);
        $ll=substr($prenom,$avantDernier,$dernier);

        return date('Y').strtoupper($cc).strtoupper($ll).$num;
    }

    /**
     * @Route("/etudiant/addetudiant", name="addetudiant")
     */
    public function addEtudiant(Request $request): Response
    {
        $etudiant=new Etudiant();
        $form=$this->createForm(ProductFormType::class,$etudiant);
        $form->handleRequest($request);
        $nom = $form['nom']->getData();
        $prenom = $form['prenom']->getData();
        $adresse=$form['adresse']->getData();
        $numerochambre=$form['numeroChambre']->getData();
        $typebourse=$form['idTypeBourse']->getData();
        $statut =1;

        if($form->isSubmitted() && $form->isValid())
        {
            $matricule=$this->CreerMatricule($nom,$prenom);
            $etudiant->setMatricule($matricule);
            $etudiant->setStatut($statut);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etudiant);
            $entityManager->flush();
        }
        return $this->render('etudiant/addetudiant.html.twig', [
            'formaddEtudiant' => $form->createView(),

        ]);


    }

    /**
     * Permet d'afficher le formulaire d'édition
     * @Route("/etudiant/{id}/edit", name="editEtudiant")
     */
    public function editEtudiant(Etudiant $etudiant, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ProductFormType::class,$etudiant);
        $nomConserver = $form['nom']->getData();
        $prenomConserver = $form['prenom']->getData();
        $form->handleRequest($request);

        $nom = $form['nom']->getData();
        $prenom = $form['prenom']->getData();


        if($form->isSubmitted() && $form->isValid()){
            if($prenom != $prenomConserver || $nom != $nomConserver){
                $matricule=$this->CreerMatricule($nom,$prenom);
                $etudiant->setMatricule($matricule);
            }
            $em->persist($etudiant);
            $em->flush();
            $this->addFlash('success',"Les modifications ont été bien enregistrée !");
        }

        return $this->render('etudiant/editEtudiant.html.twig',[
            'etudiant' => $etudiant,
            'formEditEtudiant' => $form->createView()
        ]);

    }

    /**
     * @Route("/etudiant/{id<[0-9]+>}/delete", name="deleteetudiant")
     */
    public function deleteEtudiant(Etudiant $etudiant, EntityManagerInterface $em, Request $request)
    {
        $etudiant->setStatut(0);
        $em->persist($etudiant);
        $em->flush();

        return $this->redirectToRoute('listetudiant');
    }


}
