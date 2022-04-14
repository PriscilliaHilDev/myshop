<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\ProductsModel;
use App\Models\OrdersModel;
use App\Models\SousCategorieModel;
use App\Models\OrderItemsModel;
use App\Models\CategorieModel;



class Orders extends BaseController
{
	public $users = null;
	public $category = null;
	public $sousCategory = null;
	public $panier = null;	
	public $order = null;
	public $products = null;


    public function __construct()
    {
		parent::__construct();
		$this->users =  new UsersModel();
		$this->category = new CategorieModel();
		$this->panier = new OrderItemsModel();
		$this->sousCategory = new SousCategorieModel();
		$this->products = new ProductsModel();
		$this->order = new OrdersModel();

	}

	public function index()
	{
		$cat = $this->category->findAll();
		$allSousCat = $this->sousCategory->findAll();


		if(session()->get('userID'))
		{
			$allOrders = $this->order->where('user_id', session()->get('userID'))->findAll();
			$email = $this->users->where('user_id', session()->get('userID'))->first();

			// $totaleItems = $this->orderItem
			// ->where("user_id", session()->get('userID'))
			// ->where("order_id", null)->countAllResults();
		} else {
           $allOrders = '';
		   $email ='';
		}
		
		$data = [
			'orders' => $allOrders,
			'panierModel' =>$this->panier,
			'user'=> $email,
			'listCat'=>$cat,
			'listSousCat'=>$allSousCat
			
		];
		echo view('common/header',$data);
		echo view('Site/orders/list', $data);
		echo view('common/footer');
	}

	public function details($idOrder =null)
	{
		// recuperer les elements de la commandes : utile pour avoir le totale, la date 
		$detailsOrder = $this->order->where('order_id', $idOrder)->first();
		// dd($detailsOrder);
		$allSousCat = $this->sousCategory->findAll();

			// chaque produits qui  font partie de la commande 
			// on boucle dessus pour afficher le produit concerné a partir du productModel
			// chercher dans le order_item = panier tout ce qui concerne la commande idOrder
			$productOrder = $this->panier->where('order_id', $idOrder)->find();
			// dd($productOrder);
			$cat = $this->category->findAll();
			$products = $this->products->findAll();


		$data = [
			'details'=>$detailsOrder,
			'categoryModel' =>$this->category,
			'itemsID'=> $productOrder,
			'productModel' => $this->products,
			'listCat'=>$cat,
			'productAll'=> $products,
			'listSousCat'=>$allSousCat
		];
		echo view('common/header',$data);
		echo view('Site/orders/details', $data);
		echo view('common/footer');
	}
	
}
