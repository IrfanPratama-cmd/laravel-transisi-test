<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EmployeeAsset extends Model
{
    use HasFactory;

    protected $table = "employee_assets";

    protected $fillable = ['id', 'employee_id', 'file_name', 'url'];

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

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
