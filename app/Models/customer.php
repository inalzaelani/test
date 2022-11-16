<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function customer()
    {

        return $this->hasMany(Customer::class);
    }
}
