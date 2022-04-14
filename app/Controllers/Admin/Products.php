<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;

use App\Models\SousCategorieModel;
use App\Models\CategorieModel;
use App\Models\ProductsModel;
use App\Models\ImageModel;



class Products extends BaseController
{
	public $sousCategory = null;
	public $category = null;
	public $products = null;
	public $images = null;

	

    public function __construct()
    {
		parent::__construct();
		$this->sousCategory =  new SousCategorieModel();
		$this->category =  new CategorieModel();
		$this->products =  new ProductsModel();
		$this->images =  new ImageModel();
	}
    
    // public function index()
	// {	
	// 	echo view('Admin/products/list/header');
	// 	echo view('Admin/products/list/listProduct');
	// 	echo view('Admin/products/list/footer');
	// }

	public function edition($idProduct = null)
	{
		$oneProduct = $this->products->where("product_id", $idProduct)->first();

		if(!empty($this->request->getVar("save")))
		{
			$save = $this->request->getVar("save");
		        /********************************************************************************
				 * Je vérifie si les champs sont correctement remplis
				 * exemple : nom du formulaire est requis et devra 
				  avoir une longueur min de 3 characteres et une longueur max de 30 caracteres
		 		********************************************************************************/
				$rules = [
					'name'         => 'required|min_length[3]|max_length[50]',
					'category'      => 'required',
					'sousCat'         => 'required',
					'price'        => 'required',
					'descrip'       => 'required|min_length[10]|max_length[500]',
					'available'	 => 'required',			
				];

				 /******************************************************************
		         * Si les champs sont valides permet la soumission du formulaire
		         ********************************************************************/
				if($this->validate($rules))
				{
					// je preparer les données pour l'insertion de données
					$dataSave = 
					[
						'product_name' => $this->request->getVar('name'),
						'categorie_id' => $this->request->getVar('category'),
						'sous_categorie_id' => $this->request->getVar('sousCat'),
						'price' => $this->request->getVar('price'),
						'description' => $this->request->getVar('descrip'),
						'available' => $this->request->getVar('available'),
					];
					
					 $file = $this->request->getFile('photo');
					 	if($file)
						{
					 		if ($file->isValid() && !$file->hasMoved())
					 		{
					 			$newName = $file->getRandomName();
					 			$file->move(ROOTPATH.'/public/uploads', $newName);
					 			$dataSave["main_image"] = $newName;
					 		}
					 	}
						 
                   // Si on a input hidden = update 
					if($save == "update" && !empty($oneProduct))
					{
						$dataUp = 
						[
							'product_name' => $this->request->getVar('name'),
							'categorie_id' => $this->request->getVar('category'),
							'sous_categorie_id' => $this->request->getVar('sousCat'),
							'price' => $this->request->getVar('price'),
							'main_image' => $this->request->getVar('photo'),
							'description' => $this->request->getVar('descrip'),
							'available' => $this->request->getVar('available'),
						];
						$saveImg = [
							"product_id" => $idProduct,
						];

						$imagefile = $this->request->getFiles();
						if($imagefile)
						{

							foreach($imagefile['photos'] as $img)
							{
								
								if ($img->isValid()&& !$img->hasMoved())
								{
									$newName = $img->getRandomName();
									dd($newName);
									$img->move(ROOTPATH.'/public/uploads', $newName);
									$saveImg["name"] = $newName;
								}
								   $this->images->save($saveImg);
							}
						}
					
					  // Je prepare ma requete de mise a jour du tableau de données
					  
					   $this->products->where('product_id', $idProduct)
											->set($dataUp)
											->update(); 
					/* petit plus : pour editer sur la meme page sans redirection */
                    /* Si la mise a jour est reussit il faut faire une requete qui devra recuperer les nouvelles donnees*/
					/* Les nouvelles données doit etre transmise a la vue pour etre affiché */
					/* faire une redirect qui va ajouter un parametre dans l'url et devras declencher laffichage edité*/
					   return redirect()->to('/admin');

					} else { 

						$this->products->save($dataSave);

					  return redirect()->to('/admin');
					}
		    	}
			
			}
			$allCat = $this->category->findAll();
			$allSousCat = $this->sousCategory->findAll();
		$data = [
			"productEdit"=>$oneProduct,
			"category" => $allCat,
			"sousCategory" => $allSousCat,
		];
		
		echo view('Admin/products/edit/headerEdit',$data);
		echo view('Admin/products/edit/editProduct',$data);
		echo view('Admin/products/edit/footerEdit');
	}

	public function delete($idProduct = null)
	{
		if($idProduct != null)
		{
			$this->products->where('product_id', $idProduct)->delete();
			return redirect()->to('/admin');
		}
	}
	public function images($idProduct = null)
	{

		
		$imagefile = $this->request->getFile('file');
		if($imagefile)
		{

			
				if ($imagefile->isValid() && !$imagefile->hasMoved())
				{
					$newName = $imagefile->getRandomName();
					//dd($newName);
					$imagefile->move(ROOTPATH.'/public/uploads', $newName);
					$saveImg = [
						"product_id" => $idProduct,
						"name" => $newName
					];
					$this->images->save($saveImg);
					
				}

				  // $this->images->save($saveImg);
			
		}
		
	}

}
