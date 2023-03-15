<?php
function store_user_cookie($user_id)
{
    $cookie_name = "user_id";
    $cookie_value = $user_id;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // expires in 1 day
}
?>