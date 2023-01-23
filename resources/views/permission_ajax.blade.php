<?php

use App\Http\Controllers\UserController;

$userid = $_REQUEST['id'];
if($userid!='')
{
    $UserData = UserController::getUserById($userid);
    $User = json_decode($UserData,true);
    $Modules = UserController::getAllModules();
    $ModuleData = json_decode($Modules,true);
    $ModuleList = $ModuleData['data'];
    $UserPermission = UserController::getUserPermissions($userid);
    $permission = json_decode($UserPermission,true);
    if(isset($permission['data']) && !empty($permission['data']))
    {
        $permission = $permission['data'];
    }
?>
@csrf
            <div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                User Name
                            </div>
                            <div class="col-md-9">
                                <input type="hidden" name="userid" id="userid" value="<?php echo $User['data'][0]['id'];?>">
                                <?php echo $User['data'][0]['name'];?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        <tbody>
                        <?php 
                        foreach($ModuleList as $module)
                        {   
                            $checked = '';
                            foreach($permission as $up)
                            {
                                if($up['permissionname'] == $module['modulename'])
                                {
                                    $checked = 'checked';
                                    
                                }
                            }
                            ?>
                            
                            <tr>
                                <td><?php echo $module['moduleid'];?></td>
                                <td><?php echo ucfirst($module['modulename']);?></td>
                                <td><input type="checkbox" name="permission[<?php echo $module['modulename']?>]" id="<?php echo $module['modulename']; ?>" <?php echo $checked;?> onchange="$(this).val(this.checked ? 1 : 0);" ></td>
                            </tr>
                        
                       <?php }
                        ?>
                        </tbody>
                    </table>
                </div>



<?php
    }


?>