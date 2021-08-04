<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\AccountType;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountCntrollerController extends AbstractController
{
    private $accountRepo,$em;
    public function __construct(AccountRepository $repository,EntityManagerInterface $entityManager)
    {
        $this->accountRepo=$repository;
        $this->em=$entityManager;
    }

    /**
     * @Route("/account/index", name="account_index")
     */
    public function index(): Response
    {
        $repository = $this->em->getRepository(Account::class);
        $accounts = $repository->findAll();
        return $this->render('account_cntroller/index.html.twig', [
            'accounts'=>$accounts
        ]);
    }
    /**
     * @Route("/account/new", name="new_account")
     */
    public function new(Request $request): Response
    {
        $account = new Account();
        $form=$this->createForm(AccountType::class,$account);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();
            $this->accountRepo->createNewAccount($task);

            return $this->redirectToRoute('account_index');
        }
        return $this->render('account_cntroller/new_account.html.twig', ['form'=>$form->createView()]);
    }


    /**
     * @Route("/account/delete/{id}", name="account_delete",methods={"POST"})
     */
    public function delete($id): Response
    {
        $this->accountRepo->removeAccount($id);
        $this->addFlash('success','sucessfully removed account');
        return $this->redirectToRoute('account_index');
    }
}
