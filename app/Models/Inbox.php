<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';

    protected $table = 'inbox';

    protected $primaryKey = 'kode';

    protected $guarded = ['kode'];

    public $timestamps = false;
}
