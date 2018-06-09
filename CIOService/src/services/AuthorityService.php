<?php
    
    namespace App\Service;
    
    use App\Model\Authority;

    use Illuminate\Database\Capsule\Manager as DB;
    
    class AuthorityService {

    	public static function getAuthority(){
            return Authority::where('actives', 'Y')
            		->orderBy('id', 'DESC')
            		->first();      
        }

        public static function updateAuthority($obj){

        	$model = Authority::find($obj['id']);
        	if(empty($model)){
        		$model = new Authority;
        		$model->create_date = date('Y-m-d H:i:s');
        	}
            $model->update_date = date('Y-m-d H:i:s');
            $model->contents = $obj['contents'];
            $model->contents_en = $obj['contents_en'];
            $model->save();
            return $model->id;
        }

    }