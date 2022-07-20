<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function addBalance($balance)
    {
        $this->update([
            'balance' => $this->balance + $balance
        ]);
    }

    public function subBalance($balance)
    {
        $this->update([
            'balance' => $this->balance - $balance
        ]);
    }
}
