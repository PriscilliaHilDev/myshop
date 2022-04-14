<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UsersModel extends Model{
    protected $table = 'users';
    protected $allowedFields = ['user_id','email', 'password', 'role','pseudo','create_at', 'key_auth'];
}