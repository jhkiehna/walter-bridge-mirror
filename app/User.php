<?php

namespace App;

use App\Interview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'walter_id',
        'central_id',
    ];

    public function interviews()
    {
        return $this->hasMany(Interview::class, 'central_id', 'central_id');
    }
}
