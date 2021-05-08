<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    
    protected $fillable = [
        'name','project_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
