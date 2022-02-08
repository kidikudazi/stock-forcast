<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    /**
     * These attributes are mass assignable
     * @var string[]
     */
    protected $fillable = [
        'name',
        'previous_price',
        'current_price',
        'unit',
    ];
}
