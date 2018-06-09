<?php
    
    namespace App\Service;
    
    use App\Model\Palace;

    use Illuminate\Database\Capsule\Manager as DB;
    
    class PalaceService {

    	public static function getPalace(){
            return Palace::orderBy('position_start_date', 'DESC')
            		->get();      
        }

        public static function getPalaceCurrent(){
            return Palace::orderBy('position_start_date', 'DESC')
                    ->first();      
        }

        public static function updatePalace($obj){
            
        	$model = Palace::find($obj['id']);
        	if(empty($model)){
        		$model = new Palace;
        		$model->create_date = date('Y-m-d H:i:s');
        	}
            $model->update_date = date('Y-m-d H:i:s');
            $model->prefix_name_th = $obj['prefix_name_th'];
            $model->prefix_name_en = $obj['prefix_name_en'];
            $model->firstname_th = $obj['firstname_th'];
            $model->firstname_en = $obj['firstname_en'];
            $model->lastname_th = $obj['lastname_th'];
            $model->lastname_en = $obj['lastname_en'];
            $model->position_th = $obj['position_th'];
            $model->position_en = $obj['position_en'];
            $model->position_start_date = $obj['position_start_date'];
            $model->position_end_date = ($obj['position_end_date']=='null'?'NULL':$obj['position_end_date']);
            $model->picture_name = $obj['picture_name'];
            $model->picture_path = $obj['picture_path'];

            $model->save();
            return $model->id;
        }

        public static function removePicture($id){
            $model = Palace::find($obj['id']);
            $model->picture_name = '';
            $model->picture_path = '';

            $model->save();
            return $model->id;
        }

    }