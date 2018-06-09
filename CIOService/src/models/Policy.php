<?php  

namespace App\Model;
class Policy extends \Illuminate\Database\Eloquent\Model {  
  	protected $table = 'policy';
  	protected $primaryKey = 'id';
  	public $timestamps = false;

  	public function attachFiles()
    {
  		return $this->hasMany('App\Model\AttachFile', 'parent_id');
    }
    
}
