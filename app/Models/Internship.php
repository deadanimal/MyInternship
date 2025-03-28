<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = [

        'application_id',
        'employer_id',
        'intern_id',
    ];    

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }    
    
    public function intern()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }      
    
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }     
}
