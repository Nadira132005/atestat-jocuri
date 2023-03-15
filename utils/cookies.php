<?php
function store_user_in_cookie($user_id)
{
    $cookie_name = "user_id";
    $cookie_value = $user_id;
    $expiry_time = time() + (86400 * 30);
    setcookie($cookie_name, $cookie_value, $expiry_time, "/"); // expires in 1 day
}
?>