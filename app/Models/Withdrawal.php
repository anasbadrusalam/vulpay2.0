<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['balance'];

    protected function getBalanceAttribute()
    {
        return (int) floor($this->amount - $this->rate);
    }
}
