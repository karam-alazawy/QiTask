<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'user_id',
        'name',
        'description',
        'duration',
        'start_date',
        'due_date',
        'completed',
    ];

    
    protected $casts = [
        'start_date' => 'datetime',
        'due_date' => 'datetime',
        'completed' => 'boolean',
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

   
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucfirst($name);
    }


}
