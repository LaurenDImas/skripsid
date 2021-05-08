<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Observers\BlameableObserver;
use App\Blameable;

class Forum extends Model
{
    use Blameable;
    
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    
    protected $guarded = [
        'id',
    ];
    
    public function user(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    
    public function comment(){
        return $this->hasMany(Forum::class, 'parent_id', 'id');
    }
}