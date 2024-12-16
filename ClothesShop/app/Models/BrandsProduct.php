<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandsProduct extends Model
{
    use HasFactory;
    protected $table = 'brand_product';
    protected $fillable = ['brand_name', 'brand_description', 'brand_status'];
    protected $primaryKey = 'brand_id';
    public $timestamp = false;
}
