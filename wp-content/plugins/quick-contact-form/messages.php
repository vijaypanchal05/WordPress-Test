<?php
$qcf_setup = qcf_get_stored_setup();
$tabs = explode(",",$qcf_setup['alternative']);
$firsttab = reset($tabs);
echo '<div class="wrap">';
echo '<h1>Quick Contact Form Messages</h1>';
if ( isset ($_GET['tab'])) {qcf_messages_admin_tabs($_GET['tab']); $tab = $_GET['tab'];} else {qcf_messages_admin_tabs($firsttab); $tab = $firsttab;}
qcf_show_messages($tab);
echo '</div>';

function attach_content_type($filename) {
    $mime_types = array(
        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'video/x-flv',
        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',
        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',
        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',
        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',
        // ms office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    );
    $ext = strtolower(array_pop(explode('.',$filename)));
    if (array_key_exists($ext, $mime_types)) {
        return $mime_types[$ext];
    }
    elseif (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME);
        $mimetype = finfo_file($finfo, $filename);
        finfo_close($finfo);
        return $mimetype;
    }
    else {
        return 'application/octet-stream';
    }
}

function qcf_messages_admin_tabs($current = 'default') { 
	$qcf_setup = qcf_get_stored_setup();
	$tabs = explode(",",$qcf_setup['alternative']);
	array_push($tabs, 'default');
	$message = get_option( 'qcf_message' );
	echo '<h2 class="nav-tab-wrapper">';
	foreach( $tabs as $tab ) {
		$class = ( $tab == $current ) ? ' nav-tab-active' : '';
		if ($tab) echo "<a class='nav-tab$class' href='?page=quick-contact-form/messages.php&tab=".$tab."'>$tab</a>";
    }
	echo '</h2>';
}

function qcf_show_messages($id) {
	if ($id == 'default') $id='';
    $fifty=$hundred=$all=$oldest=$newest='';
    $title = $id; if ($id == '') $title = 'Default';
	$qcf_setup = qcf_get_stored_setup();
	$qcf = qcf_get_stored_options($id);
	
    qcf_generate_csv();
	
    if( isset($_POST['qcf_emaillist'])) {
        $message = get_option('qcf_messages'.$id);
        $messageoptions = qcf_get_stored_msg();
        $content = qcf_build_message_table ($id,$messageoptions,$qcf,999);
        $title = $id; if ($id == '') $title = 'Default';
        $title = 'Message List for '.$title.' as at '.date('j M Y'); 
        $current_user = wp_get_current_user();
        $sendtoemail = $_POST['sendtoemail'];
        $headers = "From: {<{$sendtoemail}>\r\n"
            . "MIME-Version: 1.0\r\n"
            . "Content-Type: text/html; charset=\"utf-8\"\r\n";	
        wp_mail($sendtoemail, $title, $content, $headers);
        qcf_admin_notice('Message list has been sent to '.$sendtoemail.'.');
    }
    
    if (isset($_POST['qcf_reset_message'.$id])) delete_option('qcf_messages'.$id);
	
    if( isset($_POST['qcf_email_selected'])) {
        $id = $_POST['formname'];
        $thelist = array();
        $message = get_option('qcf_messages'.$id);
        $count = count($message);
        for($i = 0; $i <= $count; $i++) {
            if ($_POST[$i] == 'checked') {
                $arr['name'] = $message[$i]['field1'];
                $arr['email'] = $message[$i]['field2'];
                $thelist[] = $arr;
            }
        }
        update_option('qcf_wallace',$thelist);
        qcf_sendtolist_page('wallace');
    }
    
    if( isset($_POST['qcf_delete_selected'])) {
        $id = $_POST['formname'];
        $message = get_option('qcf_messages'.$id);
        $count = count($message);
        for($i = 0; $i <= $count; $i++) {
            if ($_POST[$i] == 'checked') {
                unset($message[$i]);
            }
        }
        $message = array_values($message);
        update_option('qcf_messages'.$id, $message ); 
        qcf_admin_notice('Selected messages have been deleted.');
    }

    if( isset( $_POST['Update'])) {
		$options = array( 'messageqty','messageorder');
		foreach ( $options as $item) $messageoptions[$item] = stripslashes($_POST[$item]);
		update_option( 'qcf_messageoptions', $messageoptions );
		qcf_admin_notice("The message options have been updated.");
		}
	
    global $current_user;
    get_currentuserinfo();

    if (!$sendtoemail) {
        $sendtoemail = $current_user->user_email;
    }
    
    $new = '<div class="qpupgrade"><a href="?page=quick-contact-form/settings.php&tab=extensions">
    <h3>'.__('Upgrade to Pro','qcf').'</h3>
    <p>'.__('Upgrading let you create a mailing list, send emails from your dashboard. You can also view and access message attachments on this page. All for just $20.','qcf').'</p>
    <p>'.__('Click here to find out more','qcf').'</p>
    </a></div>';
    
    $qppkey = get_option('qpp_key');
    $messageoptions = qcf_get_stored_msg();
	$showthismany = '9999';
	if ($messageoptions['messageqty'] == 'fifty') $showthismany = '50';
	if ($messageoptions['messageqty'] == 'hundred') $showthismany = '100';
	${$messageoptions['messageqty']} = "checked";
	${$messageoptions['messageorder']} = "checked";
	$dashboard = '<form method="post" action="">
	<p><b>Show</b> <input style="margin:0; padding:0; border:none;" type="radio" name="messageqty" value="fifty" ' . $fifty . ' /> 50 
	<input style="margin:0; padding:0; border:none;" type="radio" name="messageqty" value="hundred" ' . $hundred . ' /> 100 
	<input style="margin:0; padding:0; border:none;" type="radio" name="messageqty" value="all" ' . $all . ' /> all messages.&nbsp;&nbsp;
	<b>List</b> <input style="margin:0; padding:0; border:none;" type="radio" name="messageorder" value="oldest" ' . $oldest . ' /> oldest first 
	<input style="margin:0; padding:0; border:none;" type="radio" name="messageorder" value="newest" ' . $newest . ' /> newest first
	&nbsp;&nbsp;<input type="submit" name="Update" class="button-secondary" value="Update options" />
	</form></p>';
    $dashboard .= '<div class="wrap"><div id="qcf-widget"><form method="post" id="download_form" action="">
    <p>Send list to this email address: <input type="text" name="sendtoemail" value="'.$sendtoemail.'">&nbsp;
    <input type="submit" name="qcf_emaillist" class="qcf-button" value="Email List" />
    <input type="submit" name="qcf_reset_message'.$id.'" class="qcf-button" value="Delete Messages" onclick="return window.confirm( \'Are you sure you want to delete the messages for '.$title.'?\' );"/>
    <input type="submit" name="qcf_delete_selected" class="qcf-button" value="Delete Selected" onclick="return window.confirm( \'Are you sure you want to delete the selected messages?\' );"/>';
    if ($qppkey['authorised']) {
        $dashboard .= '&nbsp;<a class="qcf-button" href="?page=quick-contact-form/settings.php&tab=sendemail">Send an email to selected names</a>';
    }
    $dashboard .= '</p>';
    $dashboard .= qcf_build_message_table($id,$messageoptions,$qcf,$showthismany);
    $dashboard .='<p><input type="hidden" name="formname" value = "'.$id.'" />
    <p>Send to this email address: <input type="text" name="sendtoemail" value="'.$sendtoemail.'">&nbsp;
    <input type="submit" name="qcf_emaillist" class="qcf-button" value="Email List" />
    <input type="submit" name="qcf_reset_message'.$id.'" class="qcf-button" value="Delete Messages" onclick="return window.confirm( \'Are you sure you want to delete the messages for '.$title.'?\' );"/>
    <input type="submit" name="qcf_delete_selected" class="qcf-button" value="Delete Selected" onclick="return window.confirm( \'Are you sure you want to delete the selected messages?\' );"/>';
    if ($qppkey['authorised']) {
        $dashboard .= '&nbsp;<a class="qcf-button" href="?page=quick-contact-form/settings.php&tab=sendemail">Send an email to selected names</a>';
    }
    $dashboard .= '</p>
    <p><input type="submit" name="download_csv" class="qcf-button" value="Export to CSV" /></p>
    </form></div></div>';
    if (!$qppkey['authorised']) {
        $dashboard .= $new;
    }
	echo $dashboard;
}

function qcf_build_message_table($id,$messageoptions,$qcf,$showthismany) {
    $message = get_option('qcf_messages'.$id);
    $attach = qcf_get_stored_attach($id);
    $qppkey = get_option('qpp_key');
    $count = $content = '';
    $qcf['label']['field15'] = "Consent";
    if(!is_array($message)) $message = array();
    $dashboard = '<table cellspacing="0"><tr>';
    foreach (explode( ',',$qcf['sort']) as $name) {
        if ($qcf['active_buttons'][$name] == "on" && $name != 'field12') $dashboard .= '<th style="text-align:left">'.$qcf['label'][$name].'</th>';
    }
    if ($attach['qcf_attach'] && $qppkey['authorised']) $dashboard .= '<th>Attachments</th>';
    $dashboard .= '<th style="text-align:left">Date Sent</th>';
    if ($showthismany !=999) $dashboard .= '<th></th>';
    $dashboard .= '</tr>';
    if ($messageoptions['messageorder'] == 'newest') {
        $i=count($message) - 1;
        foreach(array_reverse( $message ) as $value) {
            if ($count < $showthismany ) {
                $content .= '<tr>';
                foreach (explode( ',',$qcf['sort']) as $name) {
                    if ($qcf['active_buttons'][$name] == "on" && $name != 'field12') {
                        if ($value[$name]) $report = 'messages';
                        $content .= '<td>'.strip_tags($value[$name],$qcf['htmltags']).'</td>';
                    }
                }
                if ($attach['qcf_attach'] && $qppkey['authorised']) $content .= qcf_message_thumbs($value);
                $content .= '<td>'.$value['field0'].'</td>';
                if ($showthismany !=999) $content .= '<td><input type="checkbox" name="'.$i.'" value="checked" /></td>';
                $content .= '</tr>';
                $count = $count+1;
                $i--;
            }
        }
    } else {
        $i=0;
        foreach($message as $value) {
            if ($count < $showthismany ) {
                $content .= '<tr>';
                foreach (explode( ',',$qcf['sort']) as $name) {
                    if ($qcf['active_buttons'][$name] == "on" && $name != 'field12') {
                        if ($value[$name]) $report = 'messages';
                        $content .= '<td>'.strip_tags($value[$name],$qcf['htmltags']).'</td>';
                    }
                }
                if ($attach['qcf_attach'] && $qppkey['authorised']) $content .= qcf_message_thumbs($value);
                $content .= '<td>'.$value['field0'].'</td>';
                if ($showthismany !=999) $content .= '<td><input type="checkbox" name="'.$i.'" value="checked" /></td>';
                $content .= '</tr>';
                $count = $count+1;
                $i++;
            }
        }
    }	
    if ($report) $dashboard .= $content.'</table>';
    else $dashboard .= '</table><p>No messages found</p>';
    return $dashboard;
}
                    
 function qcf_message_thumbs($value) {
    $content = '<td>';
    if ($value['attachments'] ) { 
        foreach ($value['attachments'] as $item) {
            $mime = attach_content_type($item['url']);
            $filename = pathinfo($item['url'],PATHINFO_FILENAME);
            $content .= '<a href="'.$item['url'].'"><img style="width:auto;height:40px;margin-right:6px;" ';
            if (strpos($item['file'],'.pdf')) {
                $content .= 'src="'.plugin_dir_url( __FILE__ ).'images/pdf.png"';
            } elseif (strpos($item['file'],'.xls')) {
                $content .= 'src="'.plugin_dir_url( __FILE__ ).'images/xls.png"';
            } elseif (strpos($item['file'],'.doc')) {
                $content .= 'src="'.plugin_dir_url( __FILE__ ).'images/doc.png"';
            } elseif(strstr($mime, "image/")) {
                $content .= 'src="'.$item['url'].'"';
            } else {
                $content .= 'src="'.plugin_dir_url( __FILE__ ).'images/files.png"';
            }
            $content .= ' alt="'.$filename.'" title="'.$filename.'" /></a>';
        } 
    }
    $content .= '</td>';
    return $content;
 }