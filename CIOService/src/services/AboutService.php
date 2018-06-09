<?php
    
    namespace App\Service;
    
    use App\Model\About;

    use Illuminate\Database\Capsule\Manager as DB;
    
    class AboutService {

    	public static function getAbout(){
            return About::where('actives', 'Y')
            		->orderBy('id', 'DESC')
            		->first();      
        }

        public static function updateAbout($obj){

        	$model = About::find($obj['id']);
        	if(empty($model)){
        		$model = new About;
        		$model->create_date = date('Y-m-d H:i:s');
        	}
            $model->update_date = date('Y-m-d H:i:s');
            $model->contents = $obj['contents'];
            $model->contents_en = $obj['contents_en'];
            $model->save();
            return $model->id;
        }

    }