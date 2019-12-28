<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/student")
 */
class StudentController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    private $repository;

    public function __construct(StudentRepository $repository, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    /**
     * @Route("/", name="student_index", methods={"GET"})
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        /*$student = new Student();
        $student->setName('Issiaka');
        $student->setSurname('Kamate');

        $student->setGender('Homme');
        $student->setMatricule(999999);

        $student->setNationality('Côte d\'Ivoire');
        $student->setTelephone("07907123");
        $student->setAddress('Ok');
        $student->setPostalcode('225');
        $student->setProfile('Blabla');
        $student->setEmail('issiakak@outlook.com');
$manager = $this->getDoctrine()->getManager();
        $manager->persist($student);
$manager->flush();*/
        $students = $paginator->paginate(
            $this->repository->findStudentList(),
             $request->query->getInt('page', 1), /*page number*/
        10 /*limit per page*/
        ) ;


        return $this->render('student/index.html.twig', [
            'students' => $students
        ]);
    }

    /**
     * @Route("/new", name="student_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $this->addFlash('info', 'Annonce bien créé');
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($student);
            $this->manager->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/new.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_show", methods={"GET"})
     * @param Student $student
     * @return Response
     */
    public function show(Student $student): Response
    {
        return $this->render('student/show.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="student_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Student $student
     * @return Response
     */
    public function edit(Request $request, Student $student): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('info', 'Annonce bien modifiée');
            $this->manager->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_delete", methods={"DELETE"})
     * @param Request $request
     * @param Student $student
     * @return Response
     */
    public function delete(Request $request, Student $student): Response
    {
        $this->addFlash('info', 'Annonce bien suppriméé');

        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $this->manager->remove($student);
            $this->manager->flush();
        }

        return $this->redirectToRoute('student_index');
    }

    /**
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function error($id, Request $request)
    {
        // On crée la réponse sans lui donner de contenu pour le moment
        $response = new Response();

        // On définit le contenu
        $response->setContent("Ceci est une page d'erreur 404");

        // On définit le code HTTP à « Not Found » (erreur 404)
        $response->setStatusCode(Response::HTTP_NOT_FOUND);

        // On retourne la réponse
        return $response;
    }
}
