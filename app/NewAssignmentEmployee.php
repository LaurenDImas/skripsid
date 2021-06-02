<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\BlameableObserver;

class NewAssignmentEmployee extends Model
{
    use Blameable;
    protected $fillable = [
        'new_assignment_id', 'user_id'
    ];

    
    
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function newAssignment()
    {
        return $this->hasOne(NewAssignment::class, 'id', 'new_assignment_id');
    }
    
    
}
