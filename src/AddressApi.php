<?php

namespace MenthaWeb\CommonFields;

use ProcessWire\WireData;

class AddressApi extends WireData
{
    public function email(string $email, string $text = '', array $classes = ['email'])
    {

        $emailParts = explode('@', $email);


        $user = current($emailParts);
        $domainParts = explode('.', end($emailParts));
        $domain = current($domainParts);
        if (count($domainParts) > 2) {
            $end = $domainParts[1] . '.' . $domainParts[2];
        } else {
            $end = end($domainParts);
        }
        $path = explode('?', $end);
        $topLevel = $path[0];
        $parameter = (count($path) > 1 ? end($path) : ''); 
        $id = uniqid('e');

        $script = '<script>';
        $script .= 'var a="' . base64_encode($user) . '";';
        $script .= 'var b="' . base64_encode($domain) . '";';
        $script .= 'var c="' . base64_encode($topLevel) . '";';
        $script .= 'var d="' . base64_encode($parameter) . '";';
        $script .= 'var href=atob(a)+"@"+atob(b)+"."+atob(c)+(d !== "" ? "?"+decodeURIComponent(escape(window.atob(d))) : "");';
        $script .= 'document.getElementById("'.$id.'").innerHTML="';
        $script .= '<a class=\"' . implode(' ', $classes) . '\" href=\"mailto:"+href+"\">' . (empty($text) ? '"+atob(a)+"@"+atob(b)+"."+atob(c)+"' : addslashes($text)) . '</a>"';
        $script .= '</script>';

        echo '<span id="'.$id.'">[javascript protected email address]</span>';
        echo $script;
    }

    public function phone($phone, $text = '')
    {
        return '<a class="phone" href="tel:' . preg_replace('/[\s\-\/]/', '', $phone) . '">' . (empty($text) ? $phone : $text) . '</a>';
    }
}