<?php
if (!function_exists('isThePageActive')) {
    function isThePageActive($path)
    {
        return request()->is(trim($path, '/')) || (request()->is('/') && $path === '/') ? 'active' : '';
    }
}