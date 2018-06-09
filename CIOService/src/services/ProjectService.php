<?php
    
    namespace App\Service;
    
    use App\Model\Project;

    use Illuminate\Database\Capsule\Manager as DB;
    
    class ProjectService {

    	public static function getProject($project_year = ''){
            return Project::where('actives', 'Y')
                    ->where(function($query) use ($project_year){
                        if(!empty($project_year)){
                            $query->where('project_year', $project_year);
                        }
                     })
                    ->orderBy('project_year', 'DESC')
            		->orderBy('id', 'ASC')
            		->get();      
        }

        public static function getProjectView($project_year = ''){
            return Project::where('actives', 'Y')
                    ->where(function($query) use ($project_year){
                        if(!empty($project_year)){
                            $query->where('project_year', $project_year);
                        }
                     })
                    ->orderBy('project_year', 'DESC')
                    ->orderBy('id', 'DESC')
                    ->get();      
        }

        public static function getProjectByYear(){
            return Project::groupBy('project_year')
                    ->orderBy('project_year', 'DESC')
                    ->get();      
        }

        public static function updateProject($obj){

        	$model = Project::find($obj['id']);
        	if(empty($model)){
        		$model = new Project;
        		$model->create_date = date('Y-m-d H:i:s');
        	}
            $model->update_date = date('Y-m-d H:i:s');
            $model->project_year = $obj['project_year'];
            $model->project_title = $obj['project_title'];
            $model->contents = $obj['contents'];
            $model->project_title_en = $obj['project_title_en'];
            $model->contents_en = $obj['contents_en'];
            $model->save();
            return $model->id;
        }

    }