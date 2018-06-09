<?php

    namespace App\Controller;
    
    use App\Service\ProjectService;
    use App\Service\AttachFileService;

    class ProjectController extends Controller {
        
        protected $logger;
        protected $db;
        
        public function __construct($logger, $db){
            $this->logger = $logger;
            $this->db = $db;
        }

        public function getProjectView($request, $response, $args){
            try{

                // get by year
                $_ProjectYear = ProjectService::getProjectByYear();
                $_ProjectYearList = [];
                foreach($_ProjectYear as $key => $val){
                    $_Project = ProjectService::getProjectView($val['project_year']);
                    $_AttachFiles = AttachFileService::getAttachFiles($_Project['id'], 'project');
                    $_ProjectList = [];
                    foreach($_Project as $k => $v){
                        $_AttachFiles = AttachFileService::getAttachFiles($v['id'], 'project');
                        $v['AttachFiles'] = $_AttachFiles;
                        array_push($_ProjectList, $v);
                    }
                    $_P['year'] = $val['project_year'];
                    $_P['Projects'] = $_ProjectList;
                    array_push($_ProjectYearList, $_P);
                }

                $this->data_result['DATA']['Project'] = $_ProjectYearList;
                return $this->returnResponse(200, $this->data_result, $response, false);
                
            }catch(\Exception $e){
                return $this->returnSystemErrorResponse($this->logger, $this->data_result, $e, $response);
            }
        }

        public function getProject($request, $response, $args){
            try{

                $_Project = ProjectService::getProject();
                $_AttachFiles = AttachFileService::getAttachFiles($_Project['id'], 'project');
                $_ProjectList = [];
                foreach($_Project as $k => $v){
                    $_AttachFiles = AttachFileService::getAttachFiles($v['id'], 'project');
                    $v['AttachFiles'] = $_AttachFiles;
                    array_push($_ProjectList, $v);
                }

                $this->data_result['DATA']['Project'] = $_ProjectList;
                return $this->returnResponse(200, $this->data_result, $response, false);
                
            }catch(\Exception $e){
                return $this->returnSystemErrorResponse($this->logger, $this->data_result, $e, $response);
            }
        }

        public function updateProject($request, $response, $args){
            
            $_WEB_FILE_PATH = 'cio-files/files';

            try{
                // error_reporting(E_ERROR);
                // error_reporting(E_ALL);
                // ini_set('display_errors','On');
                $params = $request->getParsedBody();

                // print_r($params);exit;
                $_Project = $params['obj']['ProjectObj']; 
                $_AttachFiles = $params['obj']['AttachFileObj'];
                unset($_Project['AttachFiles']);

                // Save Project 
                $id = ProjectService::updateProject($_Project);
                // Update Attach files
                $files = $request->getUploadedFiles();
                if($files != null){
                    foreach($files as $key => $val){
                        foreach($val['AttachFileObj'] as $k => $v){
                            // print_r($v['attachFile']);
                            $f = $v['attachFile'];
                            // print_r($f);
                            if($f != null){
                                if($f->getClientFilename() != ''){
                                    $ext = pathinfo($f->getClientFilename(), PATHINFO_EXTENSION);
                                    $FileName = $id . '_' . date('YmdHis').'_'.rand(100000,999999). '.'.$ext;
                                    $FilePath = $_WEB_FILE_PATH . '/project/'.$FileName;

                                    $AttachFile = ['parent_id'=>$id
                                                    ,'page_type'=>'project'
                                                    ,'file_name'=>$f->getClientFilename()
                                                    ,'file_path'=>$FilePath
                                                    ,'content_type'=>$f->getClientMediaType()
                                                    ,'file_size'=>number_format($f->getSize()/1024, 2)

                                                ];
                                    // print_r($AttachFile);exit;
                                    AttachFileService::addAttachFiles($AttachFile);
                                    $f->moveTo('../../' . $FilePath);
                                    
                                }
                            }
                        }
                    }
                }

                // exit;

                return $this->returnResponse(200, $this->data_result, $response, false);
                
            }catch(\Exception $e){
                return $this->returnSystemErrorResponse($this->logger, $this->data_result, $e, $response);
            }
        }
    }