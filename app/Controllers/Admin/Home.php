<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;

use App\Models\CategorieModel;
use App\Models\ProductsModel;
use App\Models\SousCategorieModel;


class Home extends BaseController
{
	public $product = null;
	public $category = null;
	public $sousCategory = null;

    public function __construct()
    {
		parent::__construct();
		$this->product =  new ProductsModel();
		$this->category = new CategorieModel();
		$this->sousCategory = new SousCategorieModel();

	}

    public function index()
	{	
		$products = $this->product->orderBy("date","ASC")->paginate(12);
		$categoryModel = $this->category;
		$SousCategoryModel = $this->sousCategory;
		$allCat =  $this->category->findAll();
		$sousCats =  $this->sousCategory->findAll();

		$data = [
			'listProducts'=> $products,
			'modelCat' => $categoryModel,
			'modelSousCat' => $SousCategoryModel,
			'pager'=> $this->product->pager,
			'category' => $allCat,
			'listSousCat'=> $sousCats 
		];

		echo view('Admin/products/list/header', $data);
		echo view('Admin/products/list/listProduct',$data);
		echo view('Admin/products/list/footer');
	}
	

}
