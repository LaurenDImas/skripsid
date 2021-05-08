<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleActivity extends Model
{
    use Blameable;
    // test
    protected $guarded = [
        'id',
    ];
    
    public function user(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }
    
}
