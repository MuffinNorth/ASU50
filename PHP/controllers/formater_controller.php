<?php
function format_by_ctx($ctx, $text){
    $out = str_replace("%name%", $ctx['name'], $text);
    $out = str_replace("%group%", $ctx['group'], $out);
    $out = str_replace("%city%", $ctx['city'], $out);
    $out = str_replace("%email%", $ctx['email'], $out);
    return $out;
}
?>