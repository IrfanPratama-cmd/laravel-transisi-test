<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;

    protected $table = "employees";

    protected $fillable = ['id', 'company_id', 'division_id', 'position_id', 'employee_code', 'employee_name', 'email', 'phone_number', 'entry_date', 'address'];

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

    public function division(){
        return $this->belongsTo(Division::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function asset(){
        return $this->hasMany(EmployeeAsset::class);
    }
}
