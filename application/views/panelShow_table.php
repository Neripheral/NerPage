<?php 
    defined('BASEPATH') OR exit('No direct script access allowed'); 

    isset($fromController) OR $fromController = array();
    isset($fromController['TABLEDATA']) OR $fromController['TABLEDATA'] = array();
    isset($fromController['TABLEDATA']['columns']) OR $fromController['TABLEDATA']['columns'] = array();
    foreach($fromController['TABLEDATA']['columns'] as &$column){
        isset($column['title']) OR $column['title'] = 'ERROR: Column title not found';
        isset($column['dataType']) OR $column['dataType'] = 'error_dataType_missing';
    }
    isset($fromController['TABLEDATA']['rows']) OR $fromController['TABLEDATA']['rows'] = array();
    //var_dump($fromController);
?>

<div class=' p-4 w-100'>
		<div>
			<form action="<?php echo base_url('index.php/panelShow/addColumn');?>" method="post" accept-charset="utf-8">
				<div class='d-inline-flex flex-row w-100 text-right'>
					<input name='panelId' type='hidden' value='<?php echo $fromController['PANELDATA']['panelId'];?>'>
					<legend class='mr-2'>Add a column:</legend>
					<input name='title' type='text' placeholder='Title' class='text-center'>
                    <select name='dataType'>
                    	<option>string</option>
                    </select>
					<input type='submit' value='+' class='btn bg-dark text-light'>
				</div>
			</form>
		</div>
		<hr>
		<table class='table table-dark rounded'>
			<thead class='thead-light'>
				<tr>
					<th>
						#
					</th>
					<?php 
    					foreach($fromController["TABLEDATA"]['columns'] as &$column){
    					    $tpl = new Smarty;
    					    $tpl->template_dir = APPPATH."views\\templates\\";
    					    $tpl->compile_dir = APPPATH."views\\templates_c\\";
    					    
    					    foreach($column as $key => $var){
    					        $tpl->assign($key, $var);
    					    }
    					    $tpl->display("panelTable_column.tpl");
    					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php 
                    echo '<tr class="table-dark text-dark">';
                        echo form_open(base_url('index.php/panelShow/addRow'));
                        echo form_hidden('panelId', $fromController['PANELDATA']['panelId']);
                        echo '<td></td>';
                        foreach($fromController['TABLEDATA']['columns'] as $key => $column){
                            echo '<td>';
                                switch($column['dataType']){
                                    case 'string':
                                        echo form_input(array('name' => 'inputColumn_'.$key));
                                        break;
                                    default:
                                        echo 'Error: datatype was not recognized!';
                                }
                            echo '</td>';
                        }
                        echo '<td>';
                        echo form_submit(array('class' => 'btn btn-default p-2', 'value' => '+'));
                        echo '</td>';
                        echo form_close();
                    echo '</tr>';
                    
                    $counter = 1;
                    foreach($fromController['TABLEDATA']['rows'] as $rowId => &$row){
                        echo '<tr>';
                            echo "<td>$counter</td>";
                            $counter++;
                            $tpl = new Smarty;
                            $tpl->template_dir = APPPATH.'views\\templates\\';
                            $tpl->compile_dir = APPPATH.'views\\templates_c\\';
                            
                            $fieldCounter = 0;
                            foreach($row as &$data){
                                $fieldCounter++;
                                $tpl->assign('data', $data);
                                $tpl->display('panelTable_field.tpl');
                            }
                            
                            while($fieldCounter++ < count($fromController['TABLEDATA']['columns']))
                                echo '<td></td>';
                            
                            echo '<td>';
                                echo '<a href="'.base_url('index.php/panelShow/removeRow/'.$fromController['PANELDATA']['panelId'].'/'.$rowId).'"><span class="octicon octicon-x"></span></a>';
                            echo '</td>';
                        echo '</tr>';
                    }
				?>
			</tbody>
		</table>
</div>