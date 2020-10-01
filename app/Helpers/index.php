<?php

function debugger($val){
    echo "<pre>";
    print_r($val);
    echo "</pre>";
    die;
}

function base_url($path=''){
    $protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
    $domain = $_SERVER['SERVER_NAME'];
    $port = $_SERVER['SERVER_PORT'];
    $disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
    $url = "${protocol}://${domain}${disp_port}".ROOT_PATH;
    return $url.$path;
}

function activeLink($path=''){
    return ROOT_PATH.$path == $_SERVER['REQUEST_URI']?'active':'';
}

function sanitize ($value) {
    // sanitize array or string values
    if (is_array($value)) {
        array_walk_recursive($value, 'sanitize_value');
    }
    else {
        return sanitize_value($value);
    }

    return $value;
}

function sanitize_value (&$value) {
    return trim(htmlspecialchars($value));
}

function oldInput($key) {
    $oldInput = Session::get('old')?Session::get('old'):[];
    return isset($oldInput[$key])? $oldInput[$key] : '';
}

function queryParams(){
    $uri = explode('?',$_SERVER['REQUEST_URI'])[1];
    $params = explode('&',$uri);
    $maskedParams = [];
    array_map(function ($item) use(&$maskedParams){
        $values = explode('=',$item);
        $maskedParams[$values[0]] = $values[1];
        return ;
    },$params);
    return $maskedParams;
}