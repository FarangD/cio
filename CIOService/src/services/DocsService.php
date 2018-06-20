<?php
    
    namespace App\Service;
    
    use App\Model\Docs;

    use Illuminate\Database\Capsule\Manager as DB;
    
    class DocsService {

        public static function getDocs(){
            return Docs::orderBy('id', 'DESC')
                    ->get();      
        }

        public static function updateDocs($obj){

        	$model = Docs::find($obj['id']);
        	if(empty($model)){
        		$model = new Docs;
        		$model->create_date = date('Y-m-d H:i:s');
        	}
            $model->topic_th = $obj['topic_th'];
            $model->topic_en = $obj['topic_en'];
            $model->file_path = $obj['file_path'];
            $model->file_name = $obj['file_name'];
            $model->save();
            return $model->id;
        }

        public static function removeDocs($id){
            return Docs::find($id)->delete();
        }
    }