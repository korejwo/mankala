<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
//    const CREATED_AT = 'creation_date';
//    const UPDATED_AT = 'updated_date';
//    protected $table = 'table_name';
//    protected $primaryKey = 'field_id';
//    public $incrementing = false;
//    protected $keyType = 'string';
    public $timestamps = false;
//    protected $dateFormat = 'U';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
}
