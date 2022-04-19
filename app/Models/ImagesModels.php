<?php namespace App\Models;

use CodeIgniter\Model;

class ImagesModels extends model{
    protected $table = 'images';
    protected $allowedFields = ['image_id','image_path','image_is_active','image_create_date','image_create_by','image_update_date','image_update_by'];
    
}