<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
require_once("TableModel.php");
require_once('PanelTableColumn.php');

class PanelTable extends TableModel{
/* ------PROPERTIES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    private $columns;
    private $rows;
    
/* ------GETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    
    public function getColumns(){
        return $this->columns;
    }
    
    public function getRows(){
        return $this->rows;
    }
    
/* ------SETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */

    public function setColumns($columns){
        $this->columns = $columns;
        return $this;
    }
    
    public function setRows($rows){
        $this->rows = $rows;
        return $this;
    }
    
/* ------TABLEMODEL-EXTENSION---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

    public function getAsArray(){
        $toReturn = array();
        $toReturn['columns'] = $this->getColumns();
        $toReturn['rows'] = $this->getRows();
        return $toReturn;
    }
    
/* ------PUBLIC-METHODS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    public function formColumns($data){
        $formedColumns = array();
        foreach($data as $column){
            $id = $column['id'];
            unset($column['id']);
            $formedColumns[$id] = $column;
        }
    }
    
    public function formRows($data){
        $formedRows = array();
        foreach($data as $panelField){
            isset($formedRows[$panelField['id']]) OR $formedRows[$panelField['id']] = array();
            $formedRows[$panelField['id']][$panelField['columnId']] = $panelField['data'];
        }
        return $formedRows;
    }
    
    public function setColumnsFromData($data){
        
        $this->setColumns($data);
        return $this;
    }
    
    public function setRowsFromData($data){
        $formedRows = $this->formRows($data);
        $this->setRows($formedRows);
        return $this;
    }

    public function __construct($columnsData = null, $rowsData = null){
        $this->initializeAll();
        if($columnsData !== null && $rowsData !== null){
            $this->setColumnsFromData($columnsData);
            $this->setRowsFromData($rowsData);
        }
    }
}
