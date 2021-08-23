<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportHistory extends Model
{
    protected $table = 'import_history';

    protected $fillable = [
        'filename',
        'path',
        'hash'
    ];
}
