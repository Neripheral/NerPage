<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."third_party/smarty/Smarty.class.php";
require_once("Head.php");

class PanelsList_Controller extends Head{
    public function panelsList_view(){
        $this->load->model('Panels_model');
        $dataToPass = array('PANELS' => $this->Panels_model->getList($this->usermanager->getLoggedUser()->getId()));
        foreach($dataToPass['PANELS'] as &$panel){
            $panel["address"] = base_url('index.php/showPanel/showPanel_view/').$panel["id"];
        }
        $keyword = 'panelsList';
        $this->codebuilder->setKeyword($keyword)
                            ->addCss()
                            ->append_section(array($keyword, $dataToPass))
                            ->wrap_all()
                            ->show();
    }
    
    public function index(){
        $this->panelsList_view();
    }
}