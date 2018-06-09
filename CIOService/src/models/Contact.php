<?php  

namespace App\Model;
class Contact extends \Illuminate\Database\Eloquent\Model {  
  	protected $table = 'contact';
  	protected $primaryKey = 'id';
  	public $timestamps = false;

  	public function attachFiles()
    {
  		return $this->hasMany('App\Model\AttachFile', 'parent_id');
    }
    
}
