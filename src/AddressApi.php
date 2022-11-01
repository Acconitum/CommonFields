<?php

namespace MenthaWeb\CommonFields;

use ProcessWire\WireData;

class AddressApi extends WireData
{
    const EMAIL_CHAR_SET = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
    
    public function email($email)
    {
        $key = str_shuffle(self::EMAIL_CHAR_SET);
        $cipherText = '';
        $id = uniqid('e');

        foreach(str_split($email, 1) as $index => $char) {
            $cipherText .= $key[strpos(self::EMAIL_CHAR_SET,$email[$index])];
        }
        $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipherText.'";var d="";';
        $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
        $script.= 'document.getElementById("'.$id.'").innerHTML="<a class=\\"email\\" href=\\"mailto:"+d+"\\">"+d+"</a>"';
        $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; 
        $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';
        return '<span id="'.$id.'">[javascript protected email address]</span>'.$script;
    }

    public function phone($phone, $text = '')
    {
        return '<a class="phone" href="tel:' . preg_replace('/[\s\-\/]/', '', $phone) . '">' . (empty($text) ? $phone : $text) . '</a>';
    }
}