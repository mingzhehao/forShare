<?php
/**
 * 添加自定义公共方法
 */

function setDomainCookie($name,$value,$expire = 0) {
    $domain = $_SERVER['SERVER_NAME'];
    if($expire!=0)$expire = time()+$expire;
    setcookie($name,$value,$expire,'/',$domain);
}

function getDomainCookie($name)
{
    return $_COOKIE["$name"];
}

