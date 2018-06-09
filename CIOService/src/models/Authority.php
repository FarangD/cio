<?php  

namespace App\Model;
class Authority extends \Illuminate\Database\Eloquent\Model {  
  	protected $table = 'authority';
  	protected $primaryKey = 'id';
  	public $timestamps = false;

  	public function attachFiles()
    {
  		return $this->hasMany('App\Model\AttachFile', 'parent_id');
    }
    
}
