<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

use App\Models\UsersModel;
use App\Models\CategorieModel;
use App\Models\OrdersModel;
use App\Models\OrderItemsModel;
use App\Models\ProductsModel;


class Customers extends BaseController
{
	public $orderItem = null;
	public $users = null;
	public $category = null;
	public $order = null;
	public $product = null;
	

    public function __construct()
    {
		parent::__construct();
		$this->users =  new UsersModel();
		$this->category = new CategorieModel();
		$this->order = new OrdersModel();
		$this->orderItem = new OrderItemsModel();
		$this->product = new ProductsModel();
	}

    public function index()
	{	
		$listUsers = $this->users->orderBy("create_at", "DESC")->paginate(12);
		$allCat = $this->category->findAll();

		$data = [
			'usersAll'=> $listUsers,
			'pager' => $this->users->pager,
			'category' =>$allCat,
			'pager'=> $this->users->pager
		];

        echo view('Admin/categories/headerCat', $data);
		echo view('Admin/customers/list', $data);
		echo view('Admin/categories/footerCat');
		
	}
	

	public function orders($idUser = null)
	{
		$listUserOrders = $this->order->where('user_id', $idUser)->orderBy("date", "DESC")->paginate(12);
		$userFind = $this->users->where('user_id', $idUser)->first();

		$data = [
			'listOrders'=> $listUserOrders,
			'pager' => $this->order->pager,
			'panierModel'=>$this->orderItem,
			'user'=> $userFind,
			'pager'=> $this->order->pager
		];

        echo view('Admin/categories/headerCat', $data);
		echo view('Admin/customers/orders', $data);
		echo view('Admin/categories/footerCat');
		
	}
	public function details($orderID = null, $idUser = null, $action= null)
	{
		// recuperer les elements de la commandes : utile pour avoir le totale, la date 
		$detailsOrder = $this->order->where('order_id', $orderID)->where('user_id', $idUser)->first();
		$items = $this->orderItem->where('order_id', $orderID)->where('user_id', $idUser)->findAll();

		// dd($detailsOrder);
		$user = $this->users->where('user_id', $idUser)->first();
		$idOrder = $this->order->where('order_id', $orderID)->first();
		$cat = $this->category->findAll();
		$allProduct = $this->product->findAll();
        $tabEtat = ['en cours', 'terminé', 'annulé'];
        if($action != null && $action == "edit")
		{
			$etat = $this->request->getVar('orderStatus');
		    if($etat)
			{
				$dataSave = ['etat'=> $etat];
				$this->order->where('order_id', $orderID)->where('user_id', $idUser)->set($dataSave)->update();
			}
		}
		if($action != null && $action == "delete")
		{
		    if(!empty($idUser) && !empty($orderID))
			{
			    $this->order->where('order_id', $orderID)->where('user_id', $idUser)->delete();
				return redirect()->to('/admin/customers/orders/'.$idUser);
			}
		}


		$data = [
			  'userOrder'=> $user,
			  'panier'=> $items, 
			  'listProducts'=> $allProduct,
			  "detail" => $detailsOrder,
			  'etatOrder' =>$tabEtat
		];

		echo view('Admin/categories/headerCat', $data);
		echo view('Admin/customers/details', $data);
		echo view('Admin/categories/footerCat');
		
	}

}
