<?php  

namespace App\Model;
class Project extends \Illuminate\Database\Eloquent\Model {  
  	protected $table = 'project';
  	protected $primaryKey = 'id';
  	public $timestamps = false;

  	public function attachFiles()
    {
  		return $this->hasMany('App\Model\AttachFile', 'parent_id');
    }
    
}
