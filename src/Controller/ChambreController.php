<?php
namespace App\Controller;



use App\Entity\Etudiant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Chambre;
use App\Form\ChambreType;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Query;


class ChambreController extends AbstractController
{

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
    private function genererNum($num, $num1)
    {
        $num=$this->generer($num);

        return  "00".$num1."-".$num;
    }

    /**
     * @Route("/save_room", name="save_room.index")
     * @return Response
     */
    public function SaveRoom(Request $request):Response
    {
        $em       = $this->getDoctrine()->getManager();
        $chambre = new Chambre();
        $form     = $this->createForm(ChambreType::class, $chambre);
        $lastid = $em->getRepository(Chambre::class)->findOneBy([], ['id' => 'desc']);
        $id = $lastid->getId();
        $nombre= $id+1;
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $numBuild = $chambre->getNumBatiment();

            $genered = $this->genererNum($nombre, $numBuild);
            $chambre->setNumChambre($genered);
            $em->persist($chambre);
            $em->flush();
            $this->addFlash(
                'notice',
                'Chambre enregistrée avec succès!'
            );
            return $this->redirectToRoute('list_room.index');
        }

        return $this->render('chambre/save_room.html.twig', [
            'form' => $form->createView(),
            'current_menu' => 'activation'
        ]);


    }

    /**
     * @Route("/list_room", name="list_room.index", defaults={"page"=1})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function ListRoom(Request $request, PaginatorInterface $paginator)
    {

        $em = $this->getDoctrine()->getManager();
        //$rooms = $em->getRepository(Chambre::class)->findAll();

        $dql   = "SELECT chambre FROM App:Chambre chambre";
        $rooms = $em->createQuery($dql);

        $pagination= $paginator->paginate(
            $rooms,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('chambre/list_room.html.twig', [
            'chambre' => $pagination,

        ]);
    }

    /**
     * @Route("/update_room/{id}", name="update_room.index")
     * @return Response
     */
    public function UpdateRoom(Request $request, int $id):Response
    {
        $em       = $this->getDoctrine()->getManager();
        $chambre = $em->getRepository(Chambre::class)->find($id);
        $form = $this->createForm(ChambreType::class, $chambre);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $numBuild = $chambre->getNumBatiment();
            $id= $chambre->getId();
            $genered = $this->genererNum($id, $numBuild);
            $chambre->setNumChambre($genered);

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
     * @Route("/delete_room/{id}", name="delete_room.index")
     */
    public function deleteRoom(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $sql = 'SELECT * FROM Etudiant e WHERE e.num_chambre_id > :num';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['num' => $id]);


        $momo= $stmt->fetch();


        dump($momo);
       if(empty($momo)){


            $chambre = $em->getRepository(Chambre::class)->find($id);
            $em->remove($chambre);
            $em->flush();

            $this->addFlash(
                'notice',
                'Chambre supprimée avec succès!'
            );



        }elseif(!empty($momo)){
            $this->addFlash(
                'notice',
                'Chambre occupée!'
            );
            return $this->redirectToRoute('list_room.index');


        }

       return $this->redirectToRoute('list_room.index');

    }
}