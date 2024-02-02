<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Division extends Model
{
    use HasFactory;

    protected $table = "divisions";

    protected $fillable = ['id', 'company_id', 'division_name'];

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function boot(){
        parent::boot();

        static::creating(function($model){
            if(empty($model->id)){
                $model->id = Str::uuid();
            }
        });
    }

    public function employee(){
        return $this->hasMany(Employee::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

}
