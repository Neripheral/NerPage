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
?>

<div class='container pt-5'>
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
                        echo '<td>';
                        echo form_submit(array('class' => 'btn btn-default p-2', 'value' => '+'));
                        echo '</td>';
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
                        echo form_close();
                    echo '</tr>';
                    
                    $counter = 1;
                    foreach($fromController['TABLEDATA']['rows'] as &$row){
                        echo '<tr>';
                            echo "<td>$counter</td>";
                            $counter++;
                            $tpl = new Smarty;
                            $tpl->template_dir = APPPATH.'views\\templates\\';
                            $tpl->compile_dir = APPPATH.'views\\templates_c\\';
                            
                            foreach($row as &$data){
                                $tpl->assign('data', $data);
                                $tpl->display('panelTable_field.tpl');
                            }
                        echo '</tr>';
                    }
				?>
			</tbody>
		</table>
</div>