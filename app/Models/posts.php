<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $fillable = ['image','caption','date','user_id'];

    public $timestamps = false;
}
