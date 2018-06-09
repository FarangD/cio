<?php
    
    namespace App\Service;
    
    use App\Model\Contact;

    use Illuminate\Database\Capsule\Manager as DB;
    
    class ContactService {

    	public static function getContact(){
            return Contact::where('actives', 'Y')
            		->orderBy('id', 'DESC')
            		->first();      
        }

        public static function updateContact($obj){

        	$model = Contact::find($obj['id']);
        	if(empty($model)){
        		$model = new Contact;
        		$model->create_date = date('Y-m-d H:i:s');
        	}
            $model->update_date = date('Y-m-d H:i:s');
            $model->contents = $obj['contents'];
            $model->contents_en = $obj['contents_en'];
            $model->save();
            return $model->id;
        }

    }