<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'infomation';
    protected $fillable = ['info_contact', 'info_map', 'info_image'];
    public $timestamp = false;
}
