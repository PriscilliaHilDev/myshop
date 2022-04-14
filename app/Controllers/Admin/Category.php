<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategorieModel;
use App\Models\SousCategorieModel;
use App\Models\ProductsModel;

class Category extends BaseController
{
	public $products = null;
	public $category = null;

    public function __construct()
    {
		parent::__construct();
		$this->category =  new CategorieModel();
		$this->sousCategory =  new SousCategorieModel();
		$this->products =  new ProductsModel();
	}
    
    public function index()
	{	

		$AllCategories = $this->category->orderBy('categorie_name', 'ASC')->findAll();
		
		$data = [
			'categories' =>$AllCategories,
		];

		echo view('Admin/categories/headerCat', $data);
		echo view('Admin/categories/list', $data);
		echo view('Admin/categories/footerCat');
	}
	public function add()
	{	
		$rules = [
			'addCat'         => 'required|min_length[3]|max_length[30]',
		];
		if($this->validate($rules))
		{
			     $catInput = $this->request->getVar('addCat');

					$dataSave = [
						'categorie_name' => ucfirst($catInput),
					];	
		
		$this->category->save($dataSave);

			return redirect()->to('/admin/category');
		}	

	}

	public function edit($idCat=null)
	{	
		if(!empty($idCat))
		{

		        /********************************************************************************
				 * Je vérifie si les champs sont correctement remplis
				 * exemple : nom du formulaire est requis et devra 
				  avoir une longueur min de 3 characteres et une longueur max de 30 caracteres
		 		********************************************************************************/
				$rules = [
					'catName'         => 'required|min_length[3]|max_length[30]',
				];
				if($this->validate($rules))
				{
					$catInput = $this->request->getVar('catName');

					$dataSave = [
						'categorie_name' => ucfirst($catInput),
					];
					
			
				$this->category->where('categorie_id', $idCat)
				->set($dataSave)
				->update();

					return redirect()->to('/admin/category');
	            }	

        }
	}

	public function delete($idCat = null)
	{
		if($idCat != null)
		{
			$delCat = $this->category->where('categorie_id', $idCat)->delete();
			if($delCat)
			{
				$productIDcat = $this->products->where('categorie_id', $idCat)->findAll();
				if($productIDcat != null)
				{
					$tabID = [];
					foreach($productIDcat as $product)
					{
                       $tabID[] = $product['product_id'];
					}
					$catAutre = $this->category->where('categorie_name', 'Autres')->orWhere('categorie_name', "Autre")->first();
						if($catAutre)
						{
							    $dataUp = ['categorie_id' => $catAutre['categorie_id']];
								$this->products->whereIn('product_id', $tabID)->set($dataUp)->update();
						}else {
							$dataUp = ['categorie_id' => null];
							$this->products->whereIn('product_id', $tabID)->set($dataUp)->update();
						}
							return redirect()->to('/admin/category');
				}
					
				}
			}
		}
	

	public function filter($idCat = null)
	{
		$productCat = $this->products->where('categorie_id', $idCat)->orderBy('date', 'DESC')->paginate(8);
		$cat = $this->category->findAll();

	
		/**************************************************************** 
		  *data corresponds au données que je souhaite passer a ma vue 
		*****************************************************************/ 
			$data = [
				'page_title' => 'Les petites annonces' ,
				'listProducts'=> $productCat,
				'pager'=> $this->products->pager,
				'modelCat' => $this->category,
			    'modelSousCat' => $this->sousCategory,
				'category' =>$cat,

			];

			echo view('Admin/products/list/header', $data);
			echo view('Admin/categories/filterProducts',$data);
			echo view('Admin/products/list/footer');
	}
}