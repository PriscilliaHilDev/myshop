<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SousCategorieModel;
use App\Models\ProductsModel;


class SousCategory extends BaseController
{

	public $sousCategory = null;
	public $products = null;


    public function __construct()
    {
		parent::__construct();
		$this->sousCategory =  new SousCategorieModel();
		$this->products =  new ProductsModel();
	}
    
    public function index()
	{	

		$sousCategoriesList = $this->sousCategory->orderBy('sous_categorie_name', 'ASC')->findAll();
		
		$data = [
			'sousCategories' =>$sousCategoriesList,
		];

			
		echo view('Admin/categories/headerCat', $data);
		echo view('Admin/sousCategorie/list', $data);
		echo view('Admin/categories/footerCat');
	}
	public function add()
	{	
		$rules = [
			'addCat'         => 'required|min_length[3]|max_length[30]',
		];
		if($this->validate($rules))
		{
			$dataSave = [
				'sous_categorie_name' => $this->request->getVar('addCat'),
			];	
		
		$this->sousCategory->save($dataSave);

			return redirect()->to('/admin/SousCategory');
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

					$dataSave = [
						'sous_categorie_name' => $this->request->getVar('catName'),
					];	
				
				$this->sousCategory->where('sous_categorie_id', $idCat)
				->set($dataSave)
				->update();

					return redirect()->to('/admin/SousCategory');
	            }	

        }
	}

	public function delete($idCat = null)
	{
		if($idCat != null)
		{
			$delCat = $this->sousCategory->where('sous_categorie_id', $idCat)->delete();
			if($delCat)
			{
				// on cherche dans produits les produits qui ont la sous categorie supprimé
				$productIDsousCat = $this->products->where('sous_categorie_id', $idCat)->findAll();
				if($productIDsousCat != null)
				{
					$tabID = [];
					foreach($productIDsousCat as $product)
					{
                       $tabID[] = $product['product_id'];
					}
					$sousCatAutre = $this->sousCategory->where('sous_categorie_name', "Divers")->first();
						if($sousCatAutre)
						{
							    $dataUp = ['sous_categorie_id' => $sousCatAutre['sous_categorie_id']];
								$this->products->whereIn('product_id', $tabID)->set($dataUp)->update();
						}else {
							$dataUp = ['sous_categorie_id' => null];
							$this->products->whereIn('product_id', $tabID)->set($dataUp)->update();
						}
							return redirect()->to('/admin/SousCategory');
				}
					
				}
			}
		// if(!empty($page))
		// {
		// 	return redirect()->to('/admin/Artistes?page='.$page);
		// } else {
		// 	return redirect()->to('/admin/Artistes');
		// }
	
	}

    
  

}
