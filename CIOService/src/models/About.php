<?php  

namespace App\Model;
class About extends \Illuminate\Database\Eloquent\Model {  
  	protected $table = 'about';
  	protected $primaryKey = 'id';
  	public $timestamps = false;

  	public function attachFiles()
    {
  		return $this->hasMany('App\Model\AttachFile', 'parent_id');
    }
    
}
