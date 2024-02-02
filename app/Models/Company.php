<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory;

    protected $table = "companies";

    protected $fillable = ['id', 'company_name', 'email', 'website', 'phone_number', 'address'];

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

    public function asset(){
        return $this->hasMany(CompanyAsset::class);
    }

    public function division(){
        return $this->hasMany(Employee::class);
    }

    public function position(){
        return $this->hasMany(Employee::class);
    }
}
