<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    protected $table = 'schedule';

    protected $guarded = [];

	public function staff()
    
	{
        
        return $this->hasOne('App\staff', 'id', 'staff_id');
    
    }

	public function client()

	{
        
        return $this->hasOne('App\client', 'id', 'client_id');
    
    }
}
