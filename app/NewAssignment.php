<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\BlameableObserver;
use App\Traits\Blameable;

class NewAssignment extends Model
{
    use Blameable;
    // test
    protected $guarded = [
        'id',
    ];
    
    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }
    
    public function newAssignmentEmployee()
    {
        return $this->hasMany(NewAssignmentEmployee::class, 'new_assignment_id', 'id');
    }
    
    
}
