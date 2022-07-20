<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['balance'];

    // protected $hidden = ['code', 'terminal', 'user_id'];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    protected function getBalanceAttribute()
    {
        return (int) floor($this->amount * $this->rate);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
