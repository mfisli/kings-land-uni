<?php
// Sets a global message for the user using bootstrap
// alert class div.
function setUserMessage($msg, $color){
    $GLOBALS['msg'] = '<div class="container"><div class="alert alert-'. $color .'"> '. $msg . '</div></div>';
}
// Gets global message and unsets it.
function getUserMessage(){
    if(isSet($GLOBALS['msg'])){
        $copy = $GLOBALS['msg'];
        unSet($GLOBALS['msg']);
        return $copy;
    }
}
