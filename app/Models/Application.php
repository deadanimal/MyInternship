<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        /// more to add here...

        'applicant_id',        
        'employer_id',
        'post_id',
    ];    

    public function applicant()
    {
        return $this->belongsTo(Profile::class, 'applicant_id');
    }     
    
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }       

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }     
}
