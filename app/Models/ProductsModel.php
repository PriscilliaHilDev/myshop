<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ProductsModel extends Model{
    protected $table = 'products';
    protected $allowedFields = ['product_id','product_name', 'sous_categorie_id', 'categorie_id','price','description','available','date', 'main_image'];
}