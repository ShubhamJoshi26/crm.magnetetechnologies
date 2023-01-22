<?php

use App\Http\Controllers\UserController;

$userid = $_REQUEST['id'];
if($userid!='')
{
    $Modules = UserController::getAllModules();
    $ModuleData = json_decode($Modules,true);
    $ModuleList = $ModuleData['data'];
    
?>
            <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Module Id</th>
                                <th>Module Name</th>
                                <th>Permission</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <?php 
                        foreach($ModuleList as $module)
                        {?>
                            <tbody>
                            <tr>
                                <td><?php echo $module['moduleid'];?></td>
                                <td><?php echo $module['modulename'];?></td>
                                <td><input type="checkbox" name="permission_<?php echo $module['moduleid']?>" id="permission_<?php echo $module['moduleid']?>"></td>
                            </tr>
                        </tbody>
                       <?php }
                        ?>
                    </table>
                </div>



<?php
    }


?>