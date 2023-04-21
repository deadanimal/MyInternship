<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'credit_balance'
    ];      

    public function internships()
    {
        return $this->hasMany(Internship::class);
    }    
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }         
}
