<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\ProductsModel;
use App\Models\SousCategorieModel;
use App\Models\CategorieModel;
use App\Models\OrderItemsModel;


class Article extends BaseController
{
	public $users = null;
	public $sousCategory = null;
	public $products = null;
	public $category = null;
	public $orderItem = null;


    public function __construct()
    {
		parent::__construct();
		$this->users =  new UsersModel();
		$this->sousCategory = new SousCategorieModel();
		$this->products = new ProductsModel();
		$this->category = new CategorieModel();
		$this->orderItem = new OrderItemsModel;


	}
	public function index()
	{

        $productAll = $this->products->orderBy("product_id", "DESC")->paginate(12);
		$SousCategoryModel = $this->sousCategory;
		$allSousCat = $this->sousCategory->findAll();
		$allCat =  $this->category->findAll();
		
		$data = [
			'products'=> $productAll,
			'modelSousCat' => $SousCategoryModel,
			'pager'=> $this->products->pager,
			'listCat' =>$allCat,
			'listSousCat' => $allSousCat,
			
		];
		echo view('common/header', $data);
		echo view('Site/index', $data);
		echo view('common/footer');
	}

	public function categorie($nameCat = null)
	{	
		$cat = $this->category->findAll();
		$sousCat = $this->sousCategory->findAll();
		$productCat = "";
		$product = '';
		$page ='';
		if(!empty($nameCat))
		{
			$catName = str_replace('-', ' ', $nameCat);
			
			$categoryName = $this->category->where('categorie_name', ucfirst($catName))->first();	
			// dd($categoryName);
			if($categoryName){
				$productCat = $this->products->where('categorie_id', $categoryName['categorie_id'])->orderBy('date', 'DESC')->paginate(8);
			    $product = $this->products->where('categorie_id', $categoryName['categorie_id'])->orderBy('date', 'DESC');
				$pager = $this->products->pager;
				$page = $pager->links();
			}	
			
		} else {
			$productCat = "";
			$product = '';
		}
	
		/**************************************************************** 
		  * data corresponds au données que je souhaite passer a ma vue 
		*****************************************************************/ 
			
		$data = [
			'products'=> $productCat,
			'modelSousCat' => $this->sousCategory,
			// 'page'=> $page,
			'listCat' =>$cat,
			'listSousCat'=>$sousCat,
			'nameByCat'=> $categoryName['categorie_name'],
			'request'=>$this->request
		
		];
		echo view('common/header', $data);
		echo view('Site/product/filterCat', $data);
		echo view('common/footer');
	}

	// vue si je clique sur une categorie

	public function filtre($catName=null, $sousCatName = null)
	{	
		$cat = $this->category->findAll();
		$sousCat = $this->sousCategory->findAll();
		
		$productCat = "";
		$product = '';
		$page ='';
		
		if(!empty($catName) && !empty($sousCatName))
		{
			$categ = str_replace('-', ' ', $catName);
			$sousCateg = str_replace('-', ' ', $sousCatName);

			$categoryName = $this->category->where('categorie_name', ucfirst($categ))->first();	
			$sousCategoryName = $this->sousCategory->where('sous_categorie_name', ucfirst($sousCateg))->first();	
			$catName =  $categoryName['categorie_name'];
			// dd($categoryName);	
			if(!empty($sousCategoryName) && !empty($categoryName))
			{
				$productCat = $this->products->where('categorie_id', $categoryName['categorie_id'])->where('sous_categorie_id', $sousCategoryName['sous_categorie_id'])->orderBy('date', 'DESC')->paginate(8);
				$product = $this->products->where('categorie_id', $categoryName['categorie_id'])->where('sous_categorie_id', $sousCategoryName['sous_categorie_id'])->orderBy('date', 'DESC');
				$pager = $this->products->pager;
				$page = $pager->links();
			}
			
		} else {
			$products = '';
			$productCat = '';
		}
		// je recuperer lid categorie de lurl
		

		/**************************************************************** 
		  * data corresponds au données que je souhaite passer a ma vue 
		*****************************************************************/ 
			
		$data = [
			'products'=> $productCat,
			'modelSousCat' => $this->sousCategory,
			'page'=> $page,
			'listSousCat'=>$sousCat,
			'nameByCat'=> $catName,
			'listCat' =>$cat,
			'request'=>$this->request

		];
		echo view('common/header', $data);
		echo view('Site/product/filterSousCat', $data);
		echo view('common/footer');
	}

	public function details($idProduct = null)
	{	
		$catProduct = null;
		$produitSimilaires = null;
		$cat = $this->category->findAll();
		$sousCat = $this->sousCategory->findAll();

		if(!empty($idProduct))
		{
			$detailProduct = $this->products->where('product_id', $idProduct)->first();
			
			if(!empty($detailProduct))
			{
				$produitSimilaires = $this->products->where('categorie_id', $detailProduct['categorie_id'])->findAll();
				$catProduct = $this->category->where('categorie_id', $detailProduct['categorie_id'])->first();
				$sousCategory = $this->sousCategory->where('sous_categorie_id', $detailProduct['sous_categorie_id'])->first();
	
			} else {
				$sousCategory = null;
				$catProduct = null;
				$produitSimilaires = null;
			}
		}
	
		
		$data = [
			'similarProducts'=>$produitSimilaires,
			'product'=> $detailProduct,
			'modelCat'=>$this->category,
			'modelSousCat'=>$this->sousCategory,
			'cat' => $catProduct,
			'sousCategory'=>$sousCategory['sous_categorie_name'],
			'pager'=> $this->products->pager,
			'id'=>$idProduct,
			// 'totalPanier'=> $totaleItems,
			'listCat'=>$cat,
			'listSousCat'=>$sousCat,
			'request'=>$this->request,

		];
		echo view('common/header', $data);
		echo view('Site/product/detailsProduct', $data);
		echo view('common/footer');
	}


	public function addProduct()
	{
		$etatAction = [];

		if(!session()->get('userID') && !$this->request->getCookie('idUser'))
		{
			$etatAction = ['button'=>'disabled'];
		}
		// id du produit
		$id = $this->request->getVar('id');
		// quantité du produit
		$quantity = $this->request->getVar('qt');
	
		if(session()->get('userID') || $this->request->getCookie('idUser'))
		{
			$cookieUser = $this->request->getCookie('idUser');
			$user = session()->get('userID');

			// ajout à partir du bouton addCart
			if(empty($quantity))
			{
				$quantity = 1;
			}

			if(!empty($id) && !empty($quantity))
			{
				// tout les produits lié à user a chaque ajout du panier la ou la commande n'est pas encore validé, 
				$allProducts = $this->orderItem->where("user_id", session()->get('userID'))->where('product_id', $id)->where('order_id', null)->findAll();
			
				// Si on a ajouté plus d'une fois l'id du produit on met à jour la quantité de l'item existe dans la base de données avec la nouvelle quantité au second ajout du panier par l'utilisateur
				if(!empty($allProducts))
				{
					$newQuantity = $quantity +  (int)$allProducts[0]['quantity'];	

					$dataUpQt = [
						'quantity' => $newQuantity
					];

					// mise a jour
					$qtProductUp = $this->orderItem
					->where('user_id', $user)
					->where('order_id', null)
					->where('product_id', $id)
					->set($dataUpQt)
					->update();
		
					$etatAction = ['response' => true];
				
				} else {

					// si on n'a pas encore ajouté ce produit on l'ajout une premiere fois
					$dataSave = ['product_id' => $id, 'user_id'=>$user, 'quantity'=>$quantity, 'key_auth'=>$cookieUser];
					$this->orderItem->save($dataSave);
					// on met a jour la quantité totale avec la quantité du produit inserer pour la premiere fois
				}
			} else {

				if(empty($id))
				{
					$etatAction = ['response'=> 'false', "message"=> "Produit inconnu veuillez recommencer !"];
				}	
			}

	    } else {
			$etatAction = ['response'=> 'false', "message"=> "reconnexion obligatoire", "button"=> 'disabled'];

		}
    
        return $this->response->setJSON($etatAction); 
	
}
}
