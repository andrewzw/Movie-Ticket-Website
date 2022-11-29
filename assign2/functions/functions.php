<?php

function sanitise_input($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function get_query_param($name, $default_value)
{
    return isset($_GET[$name]) ? $_GET[$name] : $default_value;
}

// Mercury uses PHP 5.4 which doesn't support null coalesce with undefined assoc array keys
function array_key_coalesce($arr, $key, $default)
{
    if (array_key_exists($key, $arr))
        return $arr[$key];

    return $default;
}
