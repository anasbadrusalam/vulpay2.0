<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $with = ['receivers'];

    public function receivers()
    {
        return $this->hasMany(Receiver::class);
    }

    public function getReceiver()
    {
        return $this->receivers()->whereActive(true)->first()->orderBy('code');
    }
}
