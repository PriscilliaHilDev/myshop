<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class OrderItemsModel extends Model{
    protected $table = 'order_items';
    protected $allowedFields = ['order_item_id','user_id', 'order_id', 'product_id','create','quantity', 'key_auth'];
}