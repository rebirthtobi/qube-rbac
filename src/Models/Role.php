<?php 

namespace RebirthTobi\QubeRbac\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    
    protected $guarded = [
        'id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function permission()
    {
        return $this->belongsToMany('RebirthTobi\QubeRbac\Models\Permission')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
}