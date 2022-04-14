<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\OrderItemsModel;
use App\Models\CategorieModel;


class Auth extends BaseController
{
	public $usersModel = null;
	public $category = null;
	public $panier = null;
	public $session = null;

	public function __construct()
	{
		/******** Initialisation des models appelés  *****/
         $this->usersModel =  new UsersModel();
		 $this->category =  new CategorieModel();
		 $this->panier =  new OrderItemsModel();
		 $this->session = session();

	}
	public function index()
	{
		$this->affichageFormLogin('Connexion à wwww.site.com', false);	
	}
	public function connexion()
    {
        $sessionData = [];
        //helper form est inclus dans baseController

		$error = false ;
   
        //set rules validation form
        $rules = [
            'emailLogin'   => 
			[
				'rules' => 'required|valid_email|is_not_unique[users.email]',
				'errors' => [
					'required' => "Veuillez saisir votre adresse email",
						'valid_email'=> "Adresse email incorrecte",
						'is_not_unique'=> "Adresse email inconnue"
				]
			],
			'passwordLogin'      =>
			[
				'rules' => 'required|min_length[6]|max_length[200]',
				'errors' => [
					'required' => "Veuillez saisir votre mot de passe",
						'min_length'=> "Votre mot de passe est trop court",
						'max_length' => "Votre mot de passe est trop long",
				]	
			]
        ];
        
         
        if($this->validate($rules))
		{
            $data = [
                'userEmail' => $this->request->getVar('emailLogin'),
				'userPassword' => $this->request->getVar('passwordLogin'),
            ];
		
			$users = $this->usersModel->where('email', $data['userEmail'])->findAll();
			if(!empty($users))
			{
				foreach ($users as $user)
				{
					$pwd = $user['password'];
					if(password_verify($data['userPassword'], $pwd))
					{
						
					   $sessionData = [
										'userID'=>
										$user['user_id'],
										'email'=> $user['email'],
										'role'=> $user['role'],
										'loggin'=>true,
										'Datecreate' => date("m/d/Y", strtotime($user['create_at'])),
										'heureCreate' => date("H:i:s", strtotime($user['create_at']))
						];	

					$this->session->set($sessionData); 

				/******************************************************************/
						if(empty($user['key_auth']))
						{
							$cookie = [
								'name'   => 'idUser',
								'value'  => sha1(md5(microtime(true).mt_rand(10000, 90000))),
								'expire' => '36000',
								'httponly' => false
						    ];
							
				     	   $this->response->setCookie($cookie)->send();
						   $userCookie = $this->response->getCookie('idUser');
						   
						   $keyUser = $userCookie['value'];
						   $dataUp = 
						   [
							'key_auth'=> $keyUser
						   ];

						   $this->usersModel->where('user_id', $user['user_id'])->set($dataUp)->update();

						} else {
							$cookie = [
								'name'   => 'idUser',
								'value'  => $user['key_auth'],
								'expire' => '36000',
								'httponly' => false
						    ];
							$this->response->setCookie($cookie)->send();
						}

				/******************************************************************/

					if($user['role'] == "admin")
					{
						return redirect()->to('/admin');
					} else {

						return redirect()->to('/');
					}

					} else {
						$error = true;
						
					}
				}
			}
	}

		$this->affichageFormLogin('connexion à wwww.site.com', false, $this->validator, $error);
    }
	public function inscris()
    {
		$allCat =  $this->category->findAll();
		//set rules validation form
		$rules = [
            'email'   => 
			[
				'rules' => 'required|valid_email|is_unique[users.email]',
				'errors' => [
					'required' => "Veuillez saisir votre adresse email",
						'valid_email'=> "Adresse email incorrecte",
						'is_unique' => 'Cette adresse email existe déjà'
				]
				],
			'password'      =>
			[
				'rules' => 'required|min_length[6]|max_length[200]',
				'errors' => [
					'required' => "Veuillez saisir votre mot de passe",
						'min_length'=> "Votre mot de passe est trop court",
						'max_length' => "Votre mot de passe est trop long",
				]	
				],
			'confpassword'      =>
			[
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => "Veuillez confirmer votre mot de passe",
						'matches[password]' => "Vos mots de passse doivent correspondent",
				]	
			]
        ];
        
     
     /***********************************************************************************************
     * Si les saisies de l'utilisateur respectent les regles de validation on le connecte directement
     * **********************************************************************************************/
        if($this->validate($rules)){
            
            $data = [
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' =>$this->request->getVar('role'),
            ];

            $this->usersModel->save($data);
			if ($this->usersModel->save($data))
			{
				$userID = $this->usersModel->getInsertID();
				$this->session->set(['userID' => $userID]);
				return redirect()->to('/');
			}
        }else{

            $this->affichageFormLogin('Register à wwww.site.com', false, $this->validator );
        }
    /****************************************************
     * fonction qui permet d'afficher la vue register
     * ***********************************************/
    }
	private function affichageFormLogin($pageTitle = "", $affMenu = false, $validation = null, $error=null)
    {
        $data = [

			'page_title' => 'Nous rejoindre',
			'validation' => $validation,
			'request'=> $this->request,
			'passError' => $error
		];

		echo view('common/header', $data);
		echo view('authAndRegister/LogRegister', $data);
	    echo view('common/footer');
    }
	
	public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth');
    }
	
}
