<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\ProductsModel;
use App\Models\SousCategorieModel;
use App\Models\CategorieModel;
use App\Models\OrderItemsModel;


class Home extends BaseController
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
		//  mettre un produit sans cat dans cat autre 
		
	
		$SousCategoryModel = $this->sousCategory;
		$allSousCat = $this->sousCategory->findAll();
		$allCat =  $this->category->findAll();
		$pager = $this->products->pager;
		$page = $pager->links();
		
		
		$data = [
			'products'=> $productAll,
			'modelSousCat' => $SousCategoryModel,
			// 'page'=> $this->products->pager,
			'listCat' =>$allCat,
			'listSousCat' => $allSousCat,
			'request'=> $this->request,
			'btnVisible' => false
			
		];
		echo view('common/header', $data);
		echo view('Site/index', $data);
		echo view('common/footer');
	}
	
	

	
}
