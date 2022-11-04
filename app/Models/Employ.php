<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employ extends Model
{
    use HasFactory;
    protected $fillable = [
        'compani_id',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];
    public function company()
    {
        return $this->hasOne(Company::class,'id','compani_id');
    }
}
