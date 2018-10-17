<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_Library.php");

class CodeBuilder extends Head_Library{
    private $code;
    private $keyword;
    private $flags;
    private $js;
    private $css;
    
    
    private function getCode(){
        return $this->code;
    }
    
    private function setCode($code){
        $this->code = $code;
        return $this;
    }
    
    
    
    public function getKeyword(){
        return $this->keyword;
    }
    
    public function setKeyword($keyword){
        $this->keyword = $keyword;
        return $this;
    }
    
    
    
    private function getFlags(){
        return $this->flags;
    }
    
    private function setFlags($flags){
        $this->flags = $flags;
        return $this;
    }

    
    
    private function getJs(){
        return $this->js;
    }
    
    
    private function setJs($js){
        $this->js = $js;
        return $this;
    }
    
    
    
    private function getCss(){
        return $this->css;
    }
    
    
    private function setCss($css){
        $this->css = $css;
        return $this;
    }
    
    
    
    private function setInitValues(){
        $this->setCode("");
        $this->setKeyword("undefined");
        $this->setFlags(array());
        $this->setJs(array());
        $this->setCss(array());
        return $this;
    }
    
    
    
    private function addFlag($flag){
        array_push($this->flags, $flag);
        return $this;
    }
    
    private function wasCalled($name){
        if(in_array($name, $this->getFlags()))
            return true;
        return false;
    }
    
    private function setCalled($name){
        array_push($this->flags, $name);
        return $this;
    }
    
    
    
    public function addJs($jsPath = null){
        if($jsPath === null)
            $jsPath = base_url('js/sections/').$this->getKeyword().".js";
        $js = $this->getJs();
        array_push($js, $jsPath);
        $this->setJs($js);
        return $this;
    }
    
    public function addCss($cssPath = null){
        if($cssPath === null)
            $cssPath = base_url('css/sections/').$this->getKeyword().".css";
        $css = $this->getCss();
        array_push($css, $cssPath);
        $this->setCss($css);
        return $this;
    }
    
    
    
    public function appendCode($codeToAppend){
        $this->setCode($this->getCode().$codeToAppend);
        return $this;
    }
    
    public function prependCode($codeToPrepend){
        $this->setCode($codeToPrepend.$this->getCode());
        return $this;
    }
    
    public function flushCode(){
        $this->setInitValues();
        return $this;
    }
    
    
    
    public function show($flush = true){
        echo $this->getCode();
        if($flush === true)
            $this->flushCode();
        return $this;
    }
    
    
    
    private function getView($viewName, $dataToPass){
        if(!is_array($dataToPass))
            $dataToPass = array();
        if(!isset($dataToPass["content"]))
            $dataToPass["content"] = $this->getCode();

        $toPass = array("fromController" => $dataToPass);
        return $this->ci->load->view($viewName, $toPass, true);
    }
    
    public function wrap_view($viewName, $dataToPass = array()){
        $content = $this->getView($viewName, $dataToPass);
        $this->setCode($content);
        return $this;
    }

    public function append_view($viewName, $dataToPass = array()){
        $content = $this->getView($viewName, $dataToPass);
        $this->appendCode($content);
        return $this;
    }
    
    
    
    public function prepareSection($views = null, $id = null){
        if($views === null)
            $views = $this->getKeyword();
        if($id === null)
            $id = $this->getKeyword();
        if(!preg_match('/^section_/', $id))
            $id = "section_".$id;
        
        if(!is_array($views))
            $views = array($views, array());
        if(!is_array($views[0]))
            $views = array($views);
        
        $code = "";
        foreach($views as $view)
            $code .= $this->getView($view[0], $view[1]);
                
        return $this->getView("common/wrappers/section_wrapper", array("id" => $id, "content" => $code));
    }
    
    /*
     * $views[0-?][0] - (string) Name of the view
     *            [1] - (array) variables to pass
     */
    public function append_section($views = null, $id = null){
        $section = $this->prepareSection($views, $id);
        $this->appendCode($section);
        return $this;
    }
    
    public function prepend_section($views, $id = null){
        $section = $this->prepareSection($views, $id);
        $this->prependCode($section);
        return $this;
    }
    
    private function getNavTabs_logged(){
        return array(
            array("text" => "Home", "id" => "navtab_home", "href" => base_url("index.php/home"), "class" => "", "icon" => ""),
            array("text" => "Panels", "id" => "navtab_panelsList", "href" => base_url("index.php/panelMenu"), "class" => "", "icon" => "octicon octicon-browser"),
            array("text" => $this->ci->session->loggedUser->getUsername(), "id" => "navtab_account", "href" => base_url("index.php/account"), "class" => "", "icon" => "octicon octicon-person"),
            array("text" => "Sign Out", "id" => "navtab_signout", "href" => base_url("index.php/signing/signout"), "class" => "", "icon" => "octicon octicon-link-external")
        );
    }
    
    private function getNavTabs_unlogged(){
        return array(
            array("text" => "Home", "id" => "navtab_home", "href" => base_url("index.php/home"), "class" => "", "icon" => ""),
            array("text" => "Register", "id" => "navtab_register", "href" => base_url("index.php/registration"), "class" => "", "icon" => "octicon octicon-clippy"),
            array("text" => "Sign In", "id" => "navtab_signin", "href" => base_url("index.php/signing"), "class" => "", "icon" => "octicon octicon-link-external")
        );
    }
    
    
    
    public function wrap_main($id = null){
        if($id === null)
            $id = "main_".$this->getKeyword();
        
        $this->wrap_view("common/wrappers/main_wrapper", array("id" => $id));
        $this->setCalled("main");
        return $this;
    }
    
    
    
    public function add_navbar($activeTab = null){
        if(!$this->wasCalled("main"))
            $this->wrap_main();
        
        if($activeTab === null)
            $activeTab = $this->getKeyword();        
        if(!preg_match('/^navbar_/', $activeTab))
            $activeTab = "navbar_".$activeTab;
                
        $toPass = array("fromController" => array());
        $toPass["fromController"]["NAVBAR"] = array();
        
        if($this->ci->usermanager->userIsLogged()){ //logged
            $toPass["fromController"]["NAVBAR"] = $this->getNavTabs_logged();
        }else{ //unlogged
            $toPass["fromController"]["NAVBAR"] = $this->getNavTabs_unlogged();
        }
        
        foreach($toPass["fromController"]["NAVBAR"] as &$tab)
            if($tab["id"] == $activeTab){
                $tab["class"] .= " active ";
                break;
            }
        
        $this->prependCode( $this->ci->load->view("common/navbar", $toPass, true) );
        $this->setCalled("navbar");
        return $this;
    }
    
    
    
    public function wrap_body(){
        if(!$this->wasCalled("navbar"))
            $this->add_navbar();
            
        $this->wrap_view("common/wrappers/body_wrapper");
        $this->setCalled("body");        
        return $this;
    }
    
    
    
    public function add_head($js = null, $css = null){
        if(!$this->wasCalled("body"))
            $this->wrap_body();
        
        $js = array_merge($this->getJs(), (array)$js);
        $css = array_merge($this->getCss(), (array)$css);
            
        $toPass = array("fromController" => array());
        $toPass["fromController"]["js"] = $js;
        $toPass["fromController"]["css"] = $css;
        $this->prependCode( $this->ci->load->view("common/header", $toPass, true) );
        $this->setCalled("head");
        return $this;
    }
    
    
    
    public function wrap_html(){
        if(!$this->wasCalled("head"))
            $this->add_head();
        
        $this->wrap_view("common/wrappers/html_wrapper");
        $this->setCalled("html");
        return $this;
    }
    
    
    
    public function wrap_all(){
        if(!$this->wasCalled("html"))
            $this->wrap_html();
        return $this;
    }
    
    
    
    public function __construct(){
        parent::__construct();
        $this->setInitValues();
    }
}