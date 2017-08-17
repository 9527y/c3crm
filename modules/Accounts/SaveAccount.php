<?php
global $adb;
global $app_strings;
global $current_user;

function filter_mark($text){
    if(trim($text)=='')return '';
    $text=preg_replace("/[[:punct:]\s]/",' ',$text);
    $text=urlencode($text);
    $text=preg_replace("/(%7E|%60|%21|%40|%23|%24|%25|%5E|%26|%27|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1|%E3%80%82|%EF%BC%81|%EF%BC%8C|%EF%BC%9B|%EF%BC%9F|%EF%BC%9A|%E3%80%81|%E2%80%A6%E2%80%A6|%E2%80%9D|%E2%80%9C|%E2%80%98|%E2%80%99|%EF%BD%9E|%EF%BC%8E|%EF%BC%88)+/",' ',$text);
    $text=urldecode($text);
    return trim($text);
}

$adb->startTransaction();
$accountname = $_REQUEST['accountname'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];

$accountname=filter_mark($accountname);
$email=filter_mark($email);
$phone=filter_mark($phone);

$where = " accountname like '".$accountname."%' ";


if($phone != "") {
	$where .= " or phone like '".$phone."%' ";
}

if($email != "") {
	$where .= " or email like '".$email."%' ";
}
$query = "SELECT accountname FROM ec_account WHERE deleted=0 and (".$where.")";
$result = $adb->query($query);
if($adb->num_rows($result) > 0)
{
	echo 'REPEAT';
	die;
}
require_once("modules/Accounts/Accounts.php");
$focus = new Accounts();
$focus->column_fields["accountname"] = $accountname;
$focus->column_fields["phone"] = $phone;
$focus->column_fields["email"] = $email;
$focus->column_fields["assigned_user_id"] = $current_user->id;
require_once('user_privileges/seqprefix_config.php');
$focus->column_fields['customernum'] = $account_seqprefix."-".$focus->get_next_id();
$focus->id = "";
$focus->mode = "";
$focus->save("Accounts");
$return_id = $focus->id;
echo $return_id;
die;
?>
