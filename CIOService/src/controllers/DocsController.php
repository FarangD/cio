<?php

    namespace App\Controller;
    
    use App\Service\DocsService;

    class DocsController extends Controller {
        
        protected $logger;
        protected $db;
        
        public function __construct($logger, $db){
            $this->logger = $logger;
            $this->db = $db;
        }

        public function getDocs($request, $response, $args){
            
            try{
                $params = $request->getParsedBody();

                $_Docs = DocsService::getDocs();
               
                $this->data_result['DATA']['Docs'] = $_Docs;
                return $this->returnResponse(200, $this->data_result, $response, false);
                
            }catch(\Exception $e){
                return $this->returnSystemErrorResponse($this->logger, $this->data_result, $e, $response);
            }
        }

        public function updateDocs($request, $response, $args){
            
            $_WEB_FILE_PATH = 'cio-files/files';

            try{
                // error_reporting(E_ERROR);
                // error_reporting(E_ALL);
                // ini_set('display_errors','On');
                $params = $request->getParsedBody();

                // print_r($params);exit;
                $_Docs = $params['obj']['DocsObj']; 
                unset($_Docs['AttachFiles']);

                // Save Docs 
                
                // Update Attach files
                $files = $request->getUploadedFiles();
                // print_r($files);exit;
                if($files != null){
                    $files = $files['obj']['AttachFileObj'];
                    // print_r($files);exit;
                    if($files->getClientFilename() != ''){
                        $ext = pathinfo($files->getClientFilename(), PATHINFO_EXTENSION);
                        $FileName = date('YmdHis').'_'.rand(100000,999999). '.'.$ext;
                        $FilePath = $_WEB_FILE_PATH . '/docs/'.$FileName;
                        $_Docs['file_path'] = $FilePath;
                        $_Docs['file_name'] = $files->getClientFilename();
                        $files->moveTo('../../' . $FilePath);
                        
                    }   
                }

                $id = DocsService::updateDocs($_Docs);
                // exit;

                return $this->returnResponse(200, $this->data_result, $response, false);
                
            }catch(\Exception $e){
                return $this->returnSystemErrorResponse($this->logger, $this->data_result, $e, $response);
            }
        }

        public function removeDocs($request, $response, $args){
            try{

                $id = $request->getAttribute('id');
                DocsService::removeDocs($id);
                
                return $this->returnResponse(200, $this->data_result, $response, false);
                
            }catch(\Exception $e){
                return $this->returnSystemErrorResponse($this->logger, $this->data_result, $e, $response);
            }
        }
    }