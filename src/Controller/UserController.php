<?php

namespace App\Controller;


use App\User\Adapter\LoadUserPort;
use App\User\Adapter\Request\CreateUserForm;
use App\User\Adapter\Request\CreateUserFormMapper;
use App\User\Adapter\UpdateUserStatePort;
use App\User\Application\CreateUserCommand;
use App\User\Application\CreateUserUseCase;
use App\User\Application\DeleteUserUseCase;
use App\User\Application\UpdateUserUseCase;
use App\User\Domain\User;
use App\User\Domain\UserFactory;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserController extends AbstractController
{
	private LoadUserPort $loadUserPort;

	private CreateUserFormMapper $createUserFormMapper;

	private CreateUserUseCase $createUserUseCase;

	private DeleteUserUseCase $deleteUserUseCase;

	private UpdateUserUseCase $updateUserUseCase;

	public function __construct(
		LoadUserPort         $loadUserPort,
		CreateUserFormMapper $createUserFormMapper,
		CreateUserUseCase    $createUserUseCase,
		DeleteUserUseCase    $deleteUserUseCase,
		UpdateUserUseCase    $updateUserUseCase
	) {
		$this->loadUserPort         = $loadUserPort;
		$this->createUserFormMapper = $createUserFormMapper;
		$this->createUserUseCase    = $createUserUseCase;
		$this->deleteUserUseCase    = $deleteUserUseCase;
		$this->updateUserUseCase    = $updateUserUseCase;
	}

	/**
	 * @Route ("/home", methods={"GET"}, name="users_list")
	 *
	 */
	public function getUsers()
	{
		$users = $this->loadUserPort->getAllUsers();

		return $this->render('users/index.html.twig', array('users' => $users));
	}

	/**
	 * @Route ("/user/new", methods={"GET", "POST"})
	 *
	 */
	public function createUser(Request $request)
	{
		$createForm = new CreateUserForm();

		$form = $this->createFormBuilder($createForm)
			->add('Name', TextType::class, array('attr' => array('class' => 'form-control')))
			->add('Email', EmailType::class, array('attr' => array('class' => 'form-control')))
			->add('Phone', TextType::class, array('attr' => array('class' => 'form-control')))
			->add('Passport', TextType::class, array('attr' => array('class' => 'form-control')))
			->add('save', SubmitType::class, array(
				'label' => 'Create',
				'attr' => array('class' => 'btn btn-primary mt-3')
			))
			->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$userData = $form->getData();

			$this->createUserUseCase->createByCommand($this->createUserFormMapper->mapToCreateUserCommand($userData));

			return $this->redirectToRoute('users_list');
		}

		$form->handleRequest($request);

		return $this->render('users/new.html.twig', array(
			'form' => $form->createView()
		));
	}

	/**
	 * @Route ("/user/{userId}", methods={"DELETE"})
	 *
	 */
	public function deleteOne(string $userId)
	{
		$user = $this->loadUserPort->getById($userId);
		$this->deleteUserUseCase->delete($user);
		$response = new Response();
		$response->send();
	}

	/**
	 * @Route ("/user/{userId}", methods={"GET", "POST"})
	 *
	 */
	public function updateUser(Request $request, string $userId)
	{
		$user = $this->loadUserPort->getById($userId);

		$createForm = $this->getValidFormForUpdate($user);

		$form = $this->createFormBuilder($createForm)
			->add('Name', TextType::class, array('attr' => array('class' => 'form-control')))
			->add('Email', EmailType::class, array('attr' => array('class' => 'form-control')))
			->add('Phone', TextType::class, array('attr' => array('class' => 'form-control')))
			->add('Passport', TextType::class, array('attr' => array('class' => 'form-control')))
			->add('Save', SubmitType::class, array(
					'label' => 'Update',
					'attr' => array('class' => 'btn btn-primary mt-3')
				)
			)
			->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$userData = $form->getData();

			$this->updateUserUseCase->update(
				$this->createUserFormMapper->mapToUpdateUserCommand(
					$userData, $user
				)
			);

			return $this->redirectToRoute('users_list');
		}

		$form->handleRequest($request);

		return $this->render('users/update.html.twig', array(
			'form' => $form->createView()
		));
	}

	private function getValidFormForUpdate(User $user): CreateUserForm
	{
		$form           = new CreateUserForm();
		$form->Name     = $user->getName();
		$form->Email    = $user->getEmail();
		$form->Passport = $user->getUserInfo()->getPassport();
		$form->Phone    = $user->getUserInfo()->getPhone();

		return $form;
	}
}