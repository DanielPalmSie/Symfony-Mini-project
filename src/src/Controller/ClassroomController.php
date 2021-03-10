<?php

namespace App\Controller;

use App\Entity\Classroom;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonDecode;

class ClassroomController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var JsonDecode
     */
    private $jsonDecoder;

    /**
     * @var \App\Repository\ClassroomRepository|\Doctrine\Persistence\ObjectRepository
     */
    private $classroomRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->jsonDecoder = new JsonDecode();
        $this->classroomRepository = $this->entityManager->getRepository(Classroom::class);
    }

    /**
     * @Route("/classroom/list", methods={"GET"})
     * @return Response
     */
    public function getClassroomList(): Response
    {
        return $this->render('classroom/list.html.twig', [
            'classrooms' => $this->classroomRepository->findAll()
        ]);
    }

    /**
     * @Route("/classroom/{id}",  methods={"GET"}, requirements={"id"="\d+"})
     * @param $id
     * @return Response
     */
    public function getClassroomItem($id)
    {
        $classroom = $this->classroomRepository->find($id);

        if (!$classroom) {
            throw new NotFoundHttpException("classroom_not_found");
        }

        return $this->render('classroom/item.html.twig', [
            'classroom' => $classroom
        ]);
    }

    /**
     * @Route("/classroom", methods={"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function createClassroom(Request $request)
    {
        $parameters = $this->jsonDecoder->decode($request->getContent(), 'array');

        $classroom = new Classroom();
        $classroom->setName($parameters->name);
        $classroom->setIsActive($parameters->isActive);

        $this->entityManager->persist($classroom);
        $this->entityManager->flush();

        return new Response('classroom.added');
    }

    /**
     * @Route("/classroom/{id}", methods={"PATCH"})
     *
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function updateClassroom($id, Request $request)
    {
        $parameters = $this->jsonDecoder->decode($request->getContent(), 'array');

        $classroom = $this->classroomRepository->find($id);

        if (!$classroom) {
            throw new NotFoundHttpException("classroom_not_found");
        }

        $classroom->setName($parameters->name);
        $classroom->setIsActive($parameters->isActive);

        $this->entityManager->persist($classroom);
        $this->entityManager->flush();

        return new Response('classroom.updated');
    }

    /**
     * @Route("/classroom/{id}", methods={"DELETE"})
     *
     * @param $id
     * @return Response
     */
    public function deleteClassroom($id)
    {
        $classroom = $this->classroomRepository->find($id);

        if (!$classroom) {
            throw new NotFoundHttpException("classroom_not_found");
        }

        $this->entityManager->remove($classroom);
        $this->entityManager->flush();

        return new Response('classroom.deleted');
    }
}
