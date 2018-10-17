<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class PanelShow_Controller extends Head{
    public function panel_show($panelId){
            
    }
    
    public function panel_view($panelId){
        $this->load->model("Panels_model");
        $toPass = $this->Panels_model->getDetails($panelId);
        
        $fileRoot = base_url('files/'.$toPass['id']); 
        foreach($toPass["DATA"] as &$data){
            $data['address'] = $fileRoot.$data['directory'].$data['filename'];
        }
        $keyword = 'panel_fileStorage';
        $this->codebuilder->setKeyword($keyword)
                            ->append_section(array($keyword, $toPass))
                            ->addJs()
                            ->wrap_all()
                            ->show();
    }
    
    public function view($panelId){
        $this->showPanel_view($panelId);
    }
    
    public function index(){
        $this->showpanel_view($panelId);
    }
}