<?php
namespace my_inventory\myi_client_log;

require_once( plugin_dir_path( __FILE__ ) . '/../myi_user.php');
require_once( plugin_dir_path( __FILE__ ) . '/../myi_log.php');
    
if (!is_user_logged_in()) {
    echo 'You had been logged out. Please login again';
} else {

    if (isset($_GET['client'])) {
        $client_cd_allowed = stripslashes($_GET['client']);
    } else {
        $client_cd_allowed = null; // all clients
    }
    
    // already retrieved the allowed client_list
    if ( isset($_POST['client_list']) && isset($_POST['access_request']) && $_POST['access_request'] == 'view_logs' ) {
        $client_list = stripslashes($_POST['client_list']);
        $client_cd_list = stripslashes($_POST['client_cd_list']);
        $client_name_list = stripslashes($_POST['client_name_list']);        
        
        $user_list = stripslashes($_POST['user_list']);
        $user_cd_list = stripslashes($_POST['user_cd_list']);
        $user_name_list = stripslashes($_POST['user_name_list']);   
    } else { // get the allowed client_list
        $user_roles = new \my_inventory\Myi_User_Roles();
        $clients = $user_roles->get_clients( get_current_user_id(), 'view_logs', $client_cd_allowed );
        
        if ($clients === false) {
            echo 'Error obtaining clients lists<br/><br/>';
        }
        
        $client_list = $clients[0];
        $client_cd_list = $clients[1];
        $client_name_list = $clients[2];

        $object = new \my_inventory\Myi_User();
        $users = $object->get_all_users();
        
        if ($users === false) {
            echo 'Error obtaining users list<br/><br/>';
        }
        
        $user_list = $users[0];
        $user_cd_list = $users[1];
        $user_name_list = $users[2];    
    }
    
    if (isset($_POST['client-select'])  
           && wp_verify_nonce( $_POST['client_log_nonce'], 'client_log' ) ) {
        
        $log = new \my_inventory\Myi_Log();
        $user_roles = new \my_inventory\Myi_User_Roles();
        
        $dt = explode('-',$_POST['daterange']);

        $my_results = $log->get_client( ( count($dt) == 0 ? null : \my_inventory\myi_convert_date($dt[0]) ),
                                        ( count($dt) == 0 ? null : \my_inventory\myi_convert_date($dt[1],false) ),
                                        $_POST['client-select'],
                                        $_POST['user-select'],
                                        $user_roles->get_role_ignore_client( get_current_user_id() ) );
    }
?>
<form id="my_form" name="my_form" method="post" action="#">
<div class="form-group"><pre class="no-display">
    <input type="hidden" name="access_request" id="access_request" value="view_logs" />
    <input type="hidden" name="client_list" id="client_list" value="<?php echo htmlspecialchars($client_list); ?>" />
    <input type="hidden" name="client_cd_list" id="client_cd_list" value="<?php echo htmlspecialchars($client_cd_list); ?>" />
    <input type="hidden" name="client_name_list" id="client_name_list" value="<?php echo htmlspecialchars($client_name_list); ?>" />
    <input type="hidden" name="user_list" id="user_list" value="<?php echo htmlspecialchars($user_list); ?>" />
    <input type="hidden" name="user_cd_list" id="user_cd_list" value="<?php echo htmlspecialchars($user_cd_list); ?>" />
    <input type="hidden" name="user_name_list" id="user_name_list" value="<?php echo htmlspecialchars($user_name_list); ?>" />
    </pre>
    <?php wp_nonce_field( 'client_log', 'client_log_nonce' ); ?>
        <div id="no-more-tables">
            <table class="col-md-12 table-condensed cf">
        		<thead class="cf">
        		</thead>
        		<tbody>
                <tr>
                        <td>Date (Clear the date to retrieve all dates)</td>
                        <td><input type="text" class="input_values daterange" name="daterange" id="daterange" value="<?php echo ( isset($_POST['daterange']) ? $_POST['daterange'] : '');  ?>" />
                        </td>
                </tr>
       			<tr>
        				<td>Client</td>
        				<td><select class="selectpicker click-submit-form" data-style="btn-primary" id="client-select" name="client-select[]" data-live-search="true" 
                             multiple>
                            <option data-content="All Selected" <?php echo (!isset($_POST['client-select']) || $_POST['client-select'][0] == 0 ? 'selected' : ''); ?>
                            >0</option>
                        <?php 
                        $clients_arr = array( explode( ',', $client_list ), explode( '~|`', $client_cd_list), explode( '~|`', $client_name_list ) );                       
                        
                        for ( $cnt = 0; $cnt < count( $clients_arr[0] ); $cnt++ ) {
                            echo '<option data-content="'.htmlspecialchars($clients_arr[1][$cnt]) .'   ' 
                                  .( $clients_arr[2][$cnt] == '' ? '' : '(' .htmlspecialchars($clients_arr[2][$cnt]) .')' ) .'"'
                                  .( isset($_POST['client-select']) && in_array( $clients_arr[0][$cnt], $_POST['client-select'] ) ? 'selected' : '') .'>'
                                    .$clients_arr[0][$cnt] .'</option>';
                        }
                        ?>
                            </select>
                        </td>
                </tr>
       			<tr>
        				<td>User</td>
        				<td><select class="selectpicker click-submit-form" data-style="btn-primary" id="user-select" name="user-select[]" data-live-search="true" 
                             multiple>
                            <option data-content="All Selected" <?php echo (!isset($_POST['user-select']) || $_POST['user-select'][0] == 0 ? 'selected' : ''); ?>>0</option>
                        <?php 
                        $user_arr = array( explode( ',', $user_list ), explode( '~|`', $user_cd_list), explode( '~|`', $user_name_list ) );                       
                        
                        for ( $cnt = 0; $cnt < count( $user_arr[0] ); $cnt++ ) {
                            echo '<option data-content="'.htmlspecialchars($user_arr[1][$cnt]) .'   ' 
                                  .( $user_arr[2][$cnt] == '' ? '' : '(' .htmlspecialchars($user_arr[2][$cnt]) .')' ) .'"'
                                    .( isset($_POST['user-select']) && in_array( $user_arr[0][$cnt], $_POST['user-select'] ) ? 'selected' : '') .'>'
                                    .$user_arr[0][$cnt] .'</option>';
                        }
                        ?>
                            </select>
                        </td>
                </tr>
                <!--<tr>
                        <td>Display Fields (Tick to display)</td>
                        <td><div class="checkbox"><label><input type="checkbox" value="1" id="cb[]" name="cb[]">Client</label>
                                </div>
                            <div class="checkbox"><label><input type="checkbox" value="2" id="cb[]" name="cb[]">Location</label>
                                </div>
                            <div class="checkbox"><label><input type="checkbox" value="3" id="cb[]" name="cb[]">Stock is for</label>
                                </div><br/>
                            <div class="checkbox"><label><input type="checkbox" value="4" id="cb[]" name="cb[]">Smallest UOM</label>
                                </div>
                            <div class="checkbox"><label><input type="checkbox" value="5" id="cb[]" name="cb[]">Job No.</label>
                                </div>
                            <div class="checkbox"><label><input type="checkbox" value="6" id="cb[]" name="cb[]">Remarks</label>
                                </div><br/>
                            <div class="checkbox"><label><input type="checkbox" value="7" id="cb[]" name="cb[]">Add. Field 1</label>
                                </div>
                            <div class="checkbox"><label><input type="checkbox" value="8" id="cb[]" name="cb[]">Add. Field 2</label>
                                </div>
                            <div class="checkbox"><label><input type="checkbox" value="9" id="cb[]" name="cb[]">Add. Field 3</label>
                                </div><br/>
                            <div class="checkbox"><label><input type="checkbox" value="10" id="cb[]" name="cb[]">Add. Field 4</label>
                                </div>
                            <div class="checkbox"><label><input type="checkbox" value="11" id="cb[]" name="cb[]">Add. Field 5</label>
                                </div>
                        </td>
                </tr>-->
                <tr><td></td><td></td>
                </tr>
                <tr>
                            <td></td><td><button type="submit" id="save_btn" class="btn btn-primary"><span class="glyphicon glyphicon-file">    Generate</span>
                                        </button></td>
                </tr>               
        		</tbody>
        	</table>
        </div>
</div>      
</form>
<?php if (isset($_POST['client-select'])) {
?>    
    <table id="report" name="report">
    <thead>
        <tr>
            <th>User Name</th>
            <th>Date</th>
            <th>Action</th>
            <th>Client Code</th>
            <th>Name</th>
            <th>Remark</th>
            <th>Address 1</th>
            <th>Address 2</th>
            <th>Address 3</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if ( $my_results ) {
        foreach ( $my_results as $row ) {
            echo '<tr>';
            echo '<td>' .htmlspecialchars($row->display_name) .'</td>';
            echo '<td>' .htmlspecialchars($row->create_date) .'</td>';
            echo '<td>' .htmlspecialchars($row->action) .'</td>';
            echo '<td>' .htmlspecialchars($row->client_cd) .'</td>';
            echo '<td>' .htmlspecialchars($row->client_name) .'</td>';
            echo '<td>' .htmlspecialchars($row->client_remark) .'</td>';
            echo '<td>' .htmlspecialchars($row->client_address) .'</td>';
            echo '<td>' .htmlspecialchars($row->client_address2) .'</td>';
            echo '<td>' .htmlspecialchars($row->client_address3) .'</td>';
            echo '</tr>';
        } // foreach
    } //if
    ?>
    </tbody>
    </table>
<?php
} // if isset($_POST['client-select']) ?>

<?php
} // user logged in
//wp_footer();
?>
