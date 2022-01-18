<?php
namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController{
    /**
     * @Route("/user/register", name="register")
     */
    public function index(UserPasswordHasherInterface $passwordHasher,Request $request,ManagerRegistry $doctrine):Response
    {
        $User=new User();
        $form=$this->createForm(UserType::class,$User);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $entityManager = $doctrine->getManager();

           $userpassword=$form['password']->getData();

           $hashedPassword = $passwordHasher->hashPassword(
              $User,$userpassword);
            $User->setPassword($hashedPassword);
            $User->setRoles(['ROLE_USER']);
            $User=$form->getData();
            $entityManager->persist($User);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('login');
        }
        return $this->renderForm('Register.html.twig', [
            'form' => $form,
        ]);

    }
    /**
     * @Route("task_success", name="task_success")
     */
    public function task_success(){
        echo 'done';
    }
}

