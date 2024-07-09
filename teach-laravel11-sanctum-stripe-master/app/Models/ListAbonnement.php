<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListAbonnement extends Model
{
    use HasFactory;

    protected $table = 'listabonnement';

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
    ];
}
