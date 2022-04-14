<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class CategorieModel extends Model{
    protected $table = 'categories';
    protected $allowedFields = ['catagorie_id','categorie_name', 'date'];
} 