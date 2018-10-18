<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."third_party/smarty/Smarty.class.php";
require_once("Head.php");

class PanelMenu_Controller extends Head{
    public function panelMenu_view(){
        $this->load->model('Panel_model');
        $user = $this->usermanager->getLoggedUser();
        if($user === false)
            redirect('signing');
        $ownerPanel = new Panel(array('ownerId' => $user->getId()));
        $panelList = $this->Panel_model->getMatchingPanels($ownerPanel);
        $dataToPass = array('PANELS' => array());
        foreach($panelList as $panel){
            $panelArray = $panel->getAsArray();
            $panelArray["address"] = base_url('index.php/panelShow/panel_show/').$panelArray["id"];
            array_push($dataToPass['PANELS'], $panelArray);
        }
        $keyword = 'panelMenu';
        $this->codebuilder->setKeyword($keyword)
                            ->addCss()
                            ->append_section(array($keyword, $dataToPass))
                            ->wrap_all()
                            ->show();
    }
    
    public function index(){
        $this->panelMenu_view();
    }
}