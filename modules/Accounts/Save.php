<?php
require_once('modules/Accounts/Accounts.php');
require_once('include/logging.php');
//require_once('database/DatabaseConnection.php');
require_once('include/database/PearDatabase.php');
global $log;
global $adb;
global $mod_strings;
global $current_user;

function filter_mark($text){
    if(trim($text)=='')return '';
    $text=preg_replace("/[[:punct:]\s]/",' ',$text);
    $text=urlencode($text);
    $text=preg_replace("/(%7E|%60|%21|%40|%23|%24|%25|%5E|%26|%27|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1|%E3%80%82|%EF%BC%81|%EF%BC%8C|%EF%BC%9B|%EF%BC%9F|%EF%BC%9A|%E3%80%81|%E2%80%A6%E2%80%A6|%E2%80%9D|%E2%80%9C|%E2%80%98|%E2%80%99|%EF%BD%9E|%EF%BC%8E|%EF%BC%88)+/",' ',$text);
    $text=urldecode($text);
    return trim($text);
}

$accountname = $_REQUEST['accountname'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$membername = $_REQUEST['membername'];

$accountname=filter_mark($accountname);
$email=filter_mark($email);
$phone=filter_mark($phone);
$membername=filter_mark($membername);

$record = $_REQUEST['record'];
$orsql = '';
if (!empty($phone)) {
    $orsql .= " and phone='" . $phone . "' ";
}
//if (!empty($email)) {
//    $orsql .= " or email='" . $email . "' ";
//}

if (empty($record)) {
    $query = "SELECT accountname FROM ec_account WHERE ec_account.deleted=0 and (membername='" . $membername . "' {$orsql} ) -- and smownerid=" . $current_user->id . " ";
} else {
    $query = "SELECT accountname FROM ec_account WHERE ec_account.deleted=0 and accountid !=" . $record . " and (membername='" . $membername . "' {$orsql}) --  and smownerid=" . $current_user->id . " ";
}

$result = $adb->query($query);
//changed by dingjianting on 2006-10-26 for checking username exist in dicuz database
if ($adb->num_rows($result) > 0) {
    if (isset($_REQUEST['dup_check']) && $_REQUEST['dup_check'] != '') {
        echo "客户:'" . $accountname . "'已存在，联系人和电话重复！";
    } else {
        echo '<script>history.go(-1)</script>';
    }
} else {
    if (isset($_REQUEST['dup_check']) && $_REQUEST['dup_check'] != '') {
        echo 'SUCCESS';
    } else {
        $focus = new Accounts();
        if (isset($_REQUEST['record'])) {
            $focus->id = $_REQUEST['record'];
        }
        if (isset($_REQUEST['mode'])) {
            $focus->mode = $_REQUEST['mode'];
        }
        setObjectValuesFromRequest($focus);
        if ($focus->column_fields['customernum'] == $app_strings["AUTO_GEN_CODE"]) {
            require_once('user_privileges/seqprefix_config.php');
            $focus->column_fields['customernum'] = $account_seqprefix . "-" . $focus->get_next_id();
        }
        $focus->save("Accounts");
        $return_id = $focus->id;

        if (isset($_REQUEST['parenttab']) && $_REQUEST['parenttab'] != "") $parenttab = $_REQUEST['parenttab'];
        if (isset($_REQUEST['return_module']) && $_REQUEST['return_module'] != "") $return_module = $_REQUEST['return_module'];
        else $return_module = "Accounts";
        if (isset($_REQUEST['return_action']) && $_REQUEST['return_action'] != "") $return_action = $_REQUEST['return_action'];
        else $return_action = "DetailView";
        if (isset($_REQUEST['return_id']) && $_REQUEST['return_id'] != "") $return_id = $_REQUEST['return_id'];

        if (isset($_REQUEST['return_module']) && $_REQUEST['return_module'] == "Potentials" && $_REQUEST['return_action'] == 'CallRelatedList') {
            $for_module = $_REQUEST['return_module'];
            $for_crmid = $_REQUEST['return_id'];
            if (is_file("modules/$for_module/$for_module.php")) {
                require_once("modules/$for_module/$for_module.php");
                $on_focus = new $for_module();
                // Do conditional check && call only for Custom Module at present
                // TOOD: $on_focus->IsCustomModule is not required if save_related_module function
                // is used for core modules as well.
                if (method_exists($on_focus, 'save_related_module')) {
                    $with_module = $module;
                    $with_crmid = $focus->id;
                    $on_focus->save_related_module($for_module, $for_crmid, $with_module, $with_crmid);
                }
            }
        }
//code added for returning back to the current view after edit from list view
        if ($_REQUEST['return_viewname'] == '') $return_viewname = '0';
        if ($_REQUEST['return_viewname'] != '') $return_viewname = $_REQUEST['return_viewname'];
        redirect("index.php?action=$return_action&module=$return_module&parenttab=$parenttab&record=$return_id&viewname=$return_viewname");
    }
}
?>
