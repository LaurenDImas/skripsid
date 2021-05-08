<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class BlameableObserver
{
    public function creating(Model $model)
    {
        if(Auth::user() != null){
            $model->created_by = Auth::user()->id;
        }
        // $model->updated_by = Auth::user()->id;
    }

    public function updating(Model $model)
    {
        
        if(Auth::user() != null){
            $model->updated_by = Auth::user()->id;
        }
        // dd( Auth::user()->id);
    }
}