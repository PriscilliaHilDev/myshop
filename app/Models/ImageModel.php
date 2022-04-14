<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ImageModel extends Model{
    protected $table = 'images';
    protected $allowedFields = ['id','name', 'date','product_id'];
}