<?php  

namespace App\Model;
class Palace extends \Illuminate\Database\Eloquent\Model {  
  	protected $table = 'palace';
  	protected $primaryKey = 'id';
  	public $timestamps = false;

  	public function attachFiles()
    {
  		return $this->hasMany('App\Model\AttachFile', 'parent_id');
    }
    
}
