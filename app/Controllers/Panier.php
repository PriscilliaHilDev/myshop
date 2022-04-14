<?php
namespace App\Controllers;

use App\Models\CategorieModel;
use App\Models\ProductsModel;
use App\Models\OrderItemsModel;
use App\Models\OrdersModel;
use App\Models\UsersModel;
use App\Models\SousCategorieModel;

class Panier extends BaseController
{
	public $product = null;
	public $category = null;
	public $orderItem = null;
	public $order = null;
	public $user = null;
	public $sousCategory = null;


    public function __construct()
    {
		parent::__construct();
		$this->product =  new ProductsModel();
		$this->category = new CategorieModel();
		$this->orderItem = new OrderItemsModel();
		$this->order = new OrdersModel();
		$this->user = new UsersModel();
		$this->sousCategory = new SousCategorieModel();


	}
	public function index()
	{
		$cat = $this->category->findAll();
		$allSousCat = $this->sousCategory->findAll();
		$products = $this->product->findAll();
		
		
		if(session()->get('userID'))
		{
			$idUser = (int)session()->get('userID');
		
			$itemsPanier = $this->orderItem
			->where("user_id", $idUser)
			->where("order_id", null)
			->orderBy('create', 'DESC')
			->findAll();
	    } 

		if(empty($itemsPanier)){
			$itemsPanier = NULL;
		}

			
			if( $this->request->getCookie('idUser') && !session()->get('userID'))
			{
				$userCookie = $this->request->getCookie('idUser');
				$itemsPanier = $this->orderItem
				->where("key_auth", $userCookie)
				->where("order_id", null)
				->orderBy('create', 'DESC')
				->findAll();
			} 
	
		$data = [
			"panier"=>$itemsPanier,
			'productModel' =>$this->product,
			'orderItemModel'=>$this->orderItem,
			'listCat'=>$cat,
			'listProduct'=>$products,
			'listSousCat'=>$allSousCat

		];
		echo view('common/header', $data);
		echo view('Site/panier/list', $data);
		echo view('common/footer');
	}

	
	public function counOrdertItems()
	{
		$totale = 0; 

		if(session()->get('userID'))
		{
			$itemsPanier = $this->orderItem
			->where("user_id", session()->get('userID'))
			->where("order_id", null)
			->findAll();

			if($itemsPanier){
				foreach($itemsPanier as $items){
					$totale = $totale + $items['quantity'];
				}
				echo $totale;

			}else{
				echo $totale;
			}
		
		}
	}
	public function editProduct()
	{
		$etatAction = [];
		$idEdit = $this->request->getVar('id');
		$editQuantity = $this->request->getVar('quant');
		
		if(session()->get('userID') || $this->request->getCookie('idUser'))
		{
			$user = session()->get('userID');
			
			if(!empty($idEdit) && !empty($editQuantity))
			{
				$dataUpQuantity = [
					'quantity' => $editQuantity
				];
				$this->orderItem
				->where('user_id', $user)
				->where('order_id', null)
				->where('product_id', $idEdit)
				->set($dataUpQuantity)
				->update();

                 $etatAction = ['response'=>true];
				
			} else {
				$etatAction = ['response'=>false, 'message' =>'Veuillez recommencer'];
			}

	    } 
		
		if(!session()->get('userID')) {
			$etatAction = ['response'=>false, 'message' =>'Veuillez vous connecter'];
		}

		return $this->response->setJSON($etatAction); 
    }

	function deleteProduct()
	{
		$etatAction = [];
		$idDelete = $this->request->getVar('id');
			
		if(!session()->get('userID')) {
			$etatAction = ['response'=>false, 'message' =>'Veuillez vous connecter'];
		}
	
		if(session()->get('userID') || $this->request->getCookie('idUser'))
		{
			if(!empty($idDelete))
			{
				$user = session()->get('userID');
	
				$delete = $this->orderItem
						->where('product_id', $idDelete)
						->where("user_id", $user)
						->where("order_id", null)
						->delete();

				$etatAction = ['response'=> 'true',"message"=>"Produit supprimé !" /* ,'total'=>$total, "item"=>$order_item_refresh, "produit" => $tabProduit*/];
			} else {
				$etatAction = ['response'=> 'false', "message"=> "Une erreur s'est produite veuiilez recommencez !"];
			}
		} 
		return $this->response->setJSON($etatAction); 
	}

	// function deleteMultiProduct()
	// {
	// 	$etatAction = [];
	
	// 	if(session()->get('userID') || $this->request->getCookie('idUser'))
	// 	{
	// 		$tabDel = [];
	// 		$idDelete = $this->orderItem->where('user_id', session()->get('userID'))->where('order_id', null)->findAll();
	// 		if(!empty($idDelete))
	// 		{
	// 			foreach($idDelete as $del)
	// 			{
	// 				$tabDel[] =  $del['order_item_id'];
	// 			}
	// 			$user = session()->get('userID');
	
	// 			$delete = $this->orderItem
	// 					->where('product_id', $idDelete)
	// 					->where("user_id", $user)
	// 					->where("order_id", null)
	// 					->delete();

	// 			$etatAction = ['response'=> 'true',"message"=>"Produit supprimé !" /* ,'total'=>$total, "item"=>$order_item_refresh, "produit" => $tabProduit*/];
	// 		} else {
	// 			$etatAction = ['response'=> 'false', "message"=> "Une erreur s'est produite veuiilez recommencez !"];
	// 		}
	// 	} 
	// 	return $this->response->setJSON($etatAction); 
	
	// }

	public function confirm()
	{
		if(session()->get('userID'))
		{
				$dataSave = [
					'total'=>session()->get('totale'),
					'user_id' =>session()->get('userID'),
					"etat" => "en cours"
				];
		
            if($this->order->save($dataSave))
			{
				$orderID = $this->order->getInsertID();
			   	$dataUp = [
					'order_id' => $orderID,
			   ];
				// je mets a jour lid order dans panier
				$valideOrder = $this->orderItem->where('user_id', session()->get('userID'))->where('order_id', null)->set($dataUp)->update();
				if($valideOrder)
				{
					return redirect()->to('/panier/recapitulatif/'.$orderID);
				}
				
			}
			
	     }
	}

	public function recapitulatif($orderID)
	{
		$cat = $this->category->findAll();
		$products = $this->product->findAll();
			// afficher le recapitulatif de cette commande en mode de liste tableau
			if($orderID != null)
			{
				$orderList = $this->orderItem->where('user_id', session()->get("userID"))->where('order_id', $orderID)->findAll();
				$email = $this->user->where('user_id',  session()->get('userID'))->first();
	        }
		$data = [
			"totale"=>session()->get("totale"),
			'order' => $orderList,
			'user'=> $email,
			'listCat'=>$cat,
			"listProduct" => $products,
			// 'modelProduct'=>$this->product,
			'nbOrder' => $orderID,
			
		];
		echo view('common/header', $data);
		echo view('Site/orders/confirm', $data);
		echo view('common/footer');
	}
	
}
