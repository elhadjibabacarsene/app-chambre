<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\AddChambreType;
use App\Repository\ChambreRepository;
use App\Repository\TypeChambreRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use MongoDB\Driver\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class ChambreController extends AbstractController
{
    /**
     * @Route("/chambre", name="listechambre")
     */
    public function index()
    {
        //$typeChambres = $typeChambreRepository->findAll();
        //dd($typeChambres);
        return $this->render('chambre/listechambre.html.twig');
    }



    /**
     * @Route("/chambre/addchambre", name="addchambre")
     */
    public function addChambre(Request $request)
    {
        $chambre = new Chambre();

        $form = $this->createForm(AddChambreType::class,$chambre);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
                $em = $this->getDoctrine()->getManager();
                $em->persist($chambre);
                $em->flush();
                //Affichage du flash
                //$this->addFlash('success',"La nouvelle chambre {$chambre->getNumero()} est enregistrée ! ");
                $this->addFlash('success',"La nouvelle chambre {$chambre->getNumero()} a été enregistrée");

                return $this->redirectToRoute('addchambre');
        }

        return $this->render('chambre/index.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * Permet de générer le numéro unique par chambre
     * @Route("/chambre/generernumerochambre", options={"expose"=true}, name="generernumerochambre")
     */
    public function getNewNumeroChambre(Request $request,ChambreRepository $chambreRepository)
    {
        if($request->isXmlHttpRequest())
        {
            $value = $request->request->get('value');
            //On génére le numéro unique de la chambre
            $newIdChambre = $this->genererNewIdChambre($chambreRepository);
            //On génére le numéro du batiment
            $newNumBatiment = $this->traitementNumeroBatiment($value);

            //On générer le numero complet finale de la chambre
            $numeroChambre = $newNumBatiment.'-'.$newIdChambre;
            return $this->json($numeroChambre);
        }
    }

    /**
     * Permet de générer automtiquement le nouveau numéro de la chambre à partir du dernier ID
     * @param $value
     * @param ChambreRepository $chambreRepository
     * @return int
     */
    private function genererNewIdChambre($chambreRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $lastQuestion = $chambreRepository->findOneBy([], ['id' => 'desc']);
        $lastId = $lastQuestion->getId();

        $numIdChambre = $lastId+1;

        $taille = strlen($numIdChambre);
        if($taille===1)
        {
            $numero = "00".$numIdChambre;
        }elseif ($taille===2)
        {
            $numero = "0".$numIdChambre;
        }
        return $numero;
    }

    /**
     * Permet de d'ajouter les zéro devant l'id batiment
     * @param $idBatiment
     * @return string
     */
    private function traitementNumeroBatiment($idBatiment)
    {
        $numUnique = "";
        if($idBatiment<=9)
        {
            $numUnique = "000".$idBatiment;
        }elseif ($idBatiment>9 && $idBatiment<=99)
        {
            $numUnique = "00".$idBatiment;
        }elseif($idBatiment>99&&$idBatiment<=999)
        {
            $numUnique = "0".$idBatiment;
        }elseif ($idBatiment>999&&$idBatiment<=9999)
        {
            $numUnique = $idBatiment;
        }
        return $numUnique;
    }

    /**
     * Permet de lister les chambres
     * @Route("chambre/listchambre", options={"expose"=true}, name="alllistchambre")
     */
    public function allListChambre(ChambreRepository $chambreRepository, Request $request)
    {
       if($request->isXmlHttpRequest()){
            $encoders = [new XmlEncoder(), new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];

            $chambres = $chambreRepository->findAll();
            $chambrehydrate = [];
           foreach ($chambres as $chambre){
               if($chambre->getStatut() != false){
                   $chambrehydrate[] = $chambre;
               }
           }
            return $this->json($chambrehydrate,200,[],[ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER=>function($object){
                return $object->getId();
            }]);
        }else{
            throw new \Exception("Aucune requête ajax n'est détecter");
        }

    }

    /**
     * @param Chambre $chambre
     * @param Request $request
     * @param EntityManagerInterface $em
     * @Route("chambre/{id}/edit", name="editChambre")
     */
    public function editChambre(Chambre $chambre, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(AddChambreType::class,$chambre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($chambre);
            $em->flush();
            //Affichage du flash
            $this->addFlash('success',"La chambre a été modifiée avec succès");
        }

        return $this->render('chambre/editchambre.html.twig',[
            'chambre' => $chambre,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/chambre/{id<[0-9]+>}/delete", name="deletechambre")
     */
    public function deleteEtudiant(Chambre $chambre, EntityManagerInterface $em)
    {
        $chambre->setStatut(0);
        $em->persist($chambre);
        $em->flush();

        return $this->redirectToRoute('listechambre');
    }
}
