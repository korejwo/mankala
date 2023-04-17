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

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (empty($model->name)) {
                $model->name = $model->user->name . "'s game";
            }

//            $model->status = $model->status->value();
        });
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function statusName(): string {
        return match($this->status) {
            0 => 'In progress',
            1 => 'Finished',
        };
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status',
        'user_id',
        'data',
    ];
}
