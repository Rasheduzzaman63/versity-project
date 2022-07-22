<?php

use Illuminate\Support\Facades\DB;
use App\Mail\SubscriptionMail;

function moduleExist($role_permissions, $module)
{
    $status = false;
    foreach ($role_permissions as $key => $value) {
        if ($value['permi_module'] == $module) {
            $status = true;
            break;
        }
    }

    return $status;
}

function actionExist($role_permissions, $module, $action)
{
    $status = false;
    foreach ($role_permissions as $key => $value) {
        if ( $value['permi_module'] == $module) {
            if ( strpos($value['permi_desc'], $action) !== false ) {
                $status = true;
                break;
            }
        }
    }
    return $status;
}

function model_to_table_name($string)
{
    // Add underscore if found uppercase in the middle

    $length = strlen($string);
    $store = "";
    for ($i=0; $i < $length; $i++) {

        if($i !=0 && ctype_upper($string[$i])){

            $store .= '_'.$string[$i];
        }else{
            $store .= $string[$i];            
        }
    }

    return $store;
}
function getPluralLowerStringWise($string)
{
    // Add underscore if found uppercase in the middle

    $length = strlen($string);
    $store = "";
    for ($i=0; $i < $length; $i++) {

        if($i !=0 && ctype_upper($string[$i])){

            $store .= '_'.$string[$i];
        }else{
            $store .= $string[$i];            
        }
    }

    $string = $store;

    // NB: it is not language wise convertion
    $record_plural = strtolower($string);

    if (substr($record_plural, -1, 1) == 'y') {
        $record_plural = rtrim($record_plural, 'y') . 'ies';
    }else if (substr($record_plural, -1, 1) == 's') {
        $record_plural .= 'es';
    }else{
        $record_plural = $record_plural.'s';            
    }

    return $record_plural;
}

function hasPermission($controller, $action)
{
    if ( Auth::user()->type == 'superadmin') {
        return true;
    }

    $set = false;

    $role_permissions = session('role_permissions');
    $controller = str_replace('Controller', '', $controller);

    if ($role_permissions) {
        
        foreach ($role_permissions as $key => $value) {
            if ($value->permi_module== $controller && strpos($value->permi_desc, $action) !== false) {
                $set = true;
                break;
            }
        }
    }
    
	return $set;
}

function test_string($value='')
{
	echo "string";
}

function emailQueue($email, $message_text, $subject, $sender_name='Sender Name', $sender_email='sender-email-test@gmail.com')
{
    $multiple_email = explode(',', $email);

    $data = [
            'sender_name'    => $sender_name,
            'sender_email'   => $sender_email,
            'subject'        => $sender_email,
            'message_text'   => $message_text,
        ];

    if(count($multiple_email) == 1){

        $email = $data['receiver_email'] = $multiple_email[0];
        $email = trim( filter_var($email, FILTER_SANITIZE_EMAIL) );
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {                
            Mail::queue(new SubscriptionMail($data));
        }

    }elseif (count($multiple_email) > 1) {

        $email = $data['receiver_email'] = $multiple_email[0];
        $email = trim( filter_var($email, FILTER_SANITIZE_EMAIL) );
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {                
            Mail::queue(new SubscriptionMail($data));
        }

        $email = $data['receiver_email'] = $multiple_email[1];
        $email = trim( filter_var($email, FILTER_SANITIZE_EMAIL) );
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {                
            Mail::queue(new SubscriptionMail($data));
        }
    }
}

?>