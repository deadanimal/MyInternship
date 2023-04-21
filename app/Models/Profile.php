<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'employer_id',
        'user_id',
    ];        

    public function applications()
    {
        return $this->hasMany(Application::class);
    }  
    
    public function internships()
    {
        return $this->hasMany(Internship::class);
    }      
    
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }   
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }      
}
