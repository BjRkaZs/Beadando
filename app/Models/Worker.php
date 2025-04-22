<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Worker extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'workers';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'birthdate',
        'city_id',
        'phonenumber',
        'salary',
        'department_id',
        'position_id',
        'speciality_id'
    ];

    protected $casts = [
        'birthdate'=>'date'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    public function position(){
        return $this->belongsTo(Position::class );
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }
}
