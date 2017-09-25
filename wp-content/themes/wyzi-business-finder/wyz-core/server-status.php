<?php
global $pagenow;
if ( isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
    wp_redirect( admin_url( 'themes.php?page=wyzi_server_status' ) );
    exit;
}

add_action('admin_menu', 'wyzi_add_server_status_menu');

function wyzi_add_server_status_menu() {
add_submenu_page( 'themes.php', 'Server Compatibility Status', 'Server Status', 'manage_options', 'wyzi_server_status', 'wyzi_server_status' );
}

function wyzi_server_status() {

	// Get PHP Memory Limit
	$memory_limit = ini_get('memory_limit');
	if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
	    if ($matches[2] == 'M') {
	        $memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
	    } else if ($matches[2] == 'K') {
	        $memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
	    }
	}
	
	$memory_limit_ok = ($memory_limit >= 512 * 1024 * 1024); // at least 512M?
	
	
	
	
	// Get Maximum Upload File Size
			function wyzi_return_bytes($val) {
		    $val = trim($val);
		    $last = strtolower($val[strlen($val)-1]);
		    switch($last) 
		    {
		        case 'g':
		        $val *= 1024;
		        case 'm':
		        $val *= 1024;
		        case 'k':
		        $val *= 1024;
		    }
		    return $val;
		}
		
		function wyzi_max_file_upload_in_bytes() {
		    //select maximum upload size
		    $max_upload = wyzi_return_bytes(ini_get('upload_max_filesize'));
		    //select post limit
		    $max_post = wyzi_return_bytes(ini_get('post_max_size'));
		      
		    //select memory limit
		    $memory_limit = wyzi_return_bytes(ini_get('memory_limit'));
		    // return the smallest of them, this defines the real limit
		    return min($max_upload, $max_post, $memory_limit);
		}
		
		function wyzi_formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
	$max_upload_in_bytes = wyzi_max_file_upload_in_bytes();
	
	$max_upload_filesize_ok = ($max_upload_in_bytes >= 32 * 1024 * 1024); // at least 32M?
	
	

	
    $server_status_page_Content =  '<table class="widefat fixed" cellspacing="0">
    <thead>
    <tr>

           
            <th colspan="3" id="columnname" class="manage-column column-columnname" scope="col"><h3>Wyzi Theme Server Status</h3><br>Please make sure to meet with the following server requirements for demo import and other theme and plugins features to work properly.</th>
          

    </tr>
    </thead>

    <tbody>
        <tr class="alternate">
        
            <td class="column-columnname">PHP version</td>
            <td class="column-columnname">'.PHP_VERSION.'</td>'
           . (version_compare(PHP_VERSION, '5.6.24', '>') ? '
            <td class="column-columnname" style="color:#7ad03a;">Good</td>'
            : '<td class="column-columnname" style="color:#d03a4c;">Minimum Required is PHP version 5.6.24 </td>' ) .
            
        '</tr>
        <tr>
            
        <td class="column-columnname">PHP Memory Limit</td>
            <td class="column-columnname">'.ini_get('memory_limit').'</td>'
           . ($memory_limit_ok ? '
            <td class="column-columnname" style="color:#7ad03a;">Good</td>'
            : '<td class="column-columnname" style="color:#d03a4c;">Recommended 512 MB </td>' ) .
            
        '</tr>
        
        <tr class="alternate">
            
       <td class="column-columnname">PHP Upload Max File Size</td>
            <td class="column-columnname">'.wyzi_formatSizeUnits($max_upload_in_bytes).'</td>'
           . ($max_upload_in_bytes ? '
            <td class="column-columnname" style="color:#7ad03a;">Good</td>'
            : '<td class="column-columnname" style="color:#d03a4c;">Minimum Required is 32 MB </td>' ) .
            
        '</tr>
        
         <tr>
            
        <td class="column-columnname">Maximum Execution Time</td>
            <td class="column-columnname">'.ini_get("max_execution_time").' seconds</td>'
           . (ini_get("max_execution_time") > 600 ? '
            <td class="column-columnname" style="color:#7ad03a;">Good</td>'
            : '<td class="column-columnname" style="color:#d03a4c;">Minimum Required 600 seconds </td>' ) .
            
        '</tr>
     
    </tbody>
</table>';

echo $server_status_page_Content;
}