<?php
    
    namespace App\Service;
    
    use App\Model\Policy;

    use Illuminate\Database\Capsule\Manager as DB;
    
    class PolicyService {

    	public static function getPolicy(){
            return Policy::where('actives', 'Y')
            		->orderBy('id', 'DESC')
            		->get();      
        }

        public static function updatePolicy($obj){

        	$model = Policy::find($obj['id']);
        	if(empty($model)){
        		$model = new Policy;
        		$model->create_date = date('Y-m-d H:i:s');
        	}
            $model->update_date = date('Y-m-d H:i:s');
            $model->policy_title = $obj['policy_title'];
            $model->contents = $obj['contents'];
            $model->contents_en = $obj['contents_en'];
            $model->policy_title_en = $obj['policy_title_en'];
            $model->save();
            return $model->id;
        }

    }