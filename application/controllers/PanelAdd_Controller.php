<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class PanelAdd_Controller extends Head{
    private function addPanelToDatabase($panel){
        $returnValue = $this->Panel_model->insert($panel);
        return $returnValue;
    }
    
    private function validatePanelData($panelData){
        if($panelData['name'] == null)
            throw new InvalidArgumentException("Missing input data");
        return true;
    }
    
    private function fetchInput_panelAdd(){
        $fields = array('name', 'description');
        $panelData = $this->fetchdata->fetchInput($fields);
        return $panelData;
    }
    
    public function addPanelFromData($panelData){
        $this->validatePanelData($panelData);
        $user = $this->usermanager->getLoggedUser();
        if($user === false)
            redirect('signing');
        $panelData['ownerId'] = $user->getId();
        $panel = new Panel($panelData);
        return $this->addPanelToDatabase($panel);
    }
    
    public function addPanelFromForm(){
        $panelData = $this->fetchInput_panelAdd();
        try{
            $this->addPanelFromData($panelData);
        }catch(DBException $e){
            $this->setError($e->getMessage());
            redirect('panelAdd');
        }catch(InvalidArgumentException $e){
            $this->setError($e->getMessage());
            redirect('panelAdd');
        }
        redirect("panelMenu");
    }
    
    public function panelAdd_view(){
        $this->load->helper('form');
        $this->codebuilder->setKeyword("panelAdd")
                            ->append_section()
                            ->wrap_all()
                            ->show();
    }
    
    public function index(){
        $this->panelAdd_view();
    }
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Panel_model');
    }
}