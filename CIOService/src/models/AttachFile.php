<?php  

namespace App\Model;
class AttachFile extends \Illuminate\Database\Eloquent\Model {  
  	protected $table = 'attach_file';
  	protected $primaryKey = 'id';
  	public $timestamps = false;
  	
  	protected $fillable = ['parent_id', 'page_type', 'file_name', 'file_path', 'content_type', 'file_size'];

}
