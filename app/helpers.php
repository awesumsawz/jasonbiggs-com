<?php
function isActivePage($route) {
    return request()->is($route);
}