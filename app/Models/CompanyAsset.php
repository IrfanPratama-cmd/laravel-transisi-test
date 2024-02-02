<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CompanyAsset extends Model
{
    use HasFactory;

    protected $table = "company_assets";

    protected $fillable = ['id', 'company_id', 'file_name', 'url'];

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
