<?php
namespace App\Controller;

use App\Entity\Chambre;
use App\Entity\EtudiantSearch;
use App\Form\ChambreType;
use App\Form\EtudiantSearchType;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;

class EtudiantController extends AbstractController
{


    // Fin de mon test
    private function generer($num)
    {
        if(strlen($num)==1)
        {
            $part2="000";
            $part2.=$num;
        }elseif (strlen($num)==2)
        {
            $part2="00";
            $part2.=$num;
        }elseif (strlen($num)==3)
        {
            $part2="0";
            $part2.=$num;
        }
        return $part2;
    }


    /**
     * @Route("/save_student", name="save_student.index")
     * @return Response
     */
    public function SaveStudent(Request $request):Response
    {
        $em       = $this->getDoctrine()->getManager();
        $etudiant = new Etudiant();
        $form     = $this->createForm(EtudiantType::class, $etudiant);
        $lastid = $em->getRepository(Etudiant::class)->findOneBy([], ['id' => 'desc']);
        $id = $lastid->getId();
        $nombre= $id+1;
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $code= $this->generer($nombre);
            $prenom = $etudiant->getPrenom();
            $nom= $etudiant->getNom();
            $pren = strtoupper(substr($prenom, -2));
            $nams = strtoupper(substr($nom, 0,2));
            $year = date('Y');
            $matricule = $year."-".$nams."-".$pren."-".$code;
            $etudiant->setMatricule($matricule);
            $statu="actif";
            $etudiant->setStatus($statu);
            $em->persist($etudiant);
            $em->flush();
            $this->addFlash(
                'notice',
                'Etudiant(e) enregistré(e) avec succès!'
            );
            return $this->redirectToRoute('list_student.index');
        }

        return $this->render('etudiant/save_etudiant.html.twig', [
            'form' => $form->createView(),
            'current_menu' => 'activation'
        ]);
    }

    /**
     * @Route("/list_student", name="list_student.index")
     * @return Response
     */
    public function ListStudent(Request $request, PaginatorInterface $paginator):Response
    {
        $search = new EtudiantSearch();
        $form =$this->createForm(EtudiantSearchType::class, $search);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        //$student = $this->findAllVisibleQuery($search);
        $etudiant = $em->getRepository(Etudiant::class)->findAllVisibleQuery($search);
        //Nouvelle méthode: elle permet d'afficher seulement les étudiants non supprimés

     //   $dql   = "SELECT etudiant FROM App:Etudiant etudiant WHERE etudiant.status='actif'";
      // $students = $em->createQuery($student);
      // $student = $stmt->fetch();
       dump($etudiant);
        $pagination= $paginator->paginate(
            $etudiant,
            $request->query->getInt('page', 1),
            5
        );


        return $this->render('etudiant/list_etudiant.html.twig', [
            'etudiants' => $pagination,
            'current_menu' => 'activation',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/update_student/{id}", name="update_student.index")
     * @return Response
     */
    public function UpdateRoom(Request $request, int $id):Response
    {
        $em       = $this->getDoctrine()->getManager();
        $etudiant = $em->getRepository(Etudiant::class)->find($id);
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $numBuild = $etudiant->getNumBatiment();
            $id= $etudiant->getId();
            $genered = $this->genererNum($id, $numBuild);
            $etudiant->setMatricule($genered);

            $em->flush();
            $this->addFlash(
                'notice',
                'Chambre modifiée avec succès!'
            );
            return $this->redirectToRoute('list_room.index');
        }

        return $this->render('chambre/update_room.html.twig', [
            'form' => $form->createView(),
            'current_menu' => 'activation'
        ]);


    }

    /**
     * @Route("/delete_student/{id}", name="delete_student.index")
     * @return Response
     */
    public function DeleteStudent(Request $request, int $id):Response
    {
        $em       = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Etudiant::class)->find($id);
                $statu= "deleted";
            $student->setStatus($statu);

            $em->flush();
            $this->addFlash(
                'notice',
                'Etudiant(e) supprimé(e) avec succès!'
            );
            return $this->redirectToRoute('list_student.index');


    }
}