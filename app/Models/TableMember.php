<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TableMember extends Model
{
    use SoftDeletes;

    protected $table = 'table_members';
    protected $guarded = false;
}
