<?php
    
    namespace App\Service;
    
    use App\Model\AttachFile;

    use Illuminate\Database\Capsule\Manager as DB;
    
    class AttachFileService {

    	public static function getAttachFiles($parent_id, $page_type){
            return AttachFile::where('parent_id', $parent_id)
                    ->where('page_type', $page_type)
            		->orderBy('id', 'ASC')
            		->get();      
        }

        public static function addAttachFiles($AttachFile){
            $model = new AttachFile;
            // $model->fill($AttachFile);
            $model->parent_id = $AttachFile['parent_id'];
            $model->page_type = $AttachFile['page_type'];
            $model->file_name = $AttachFile['file_name'];
            $model->file_path = $AttachFile['file_path'];
            $model->content_type = $AttachFile['content_type'];
            $model->file_size = $AttachFile['file_size'];
            $model->save();
        }

        public static function removeAttachFile($id){
            return AttachFile::find($id)->delete();
        }
    }