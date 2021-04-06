<?php

function redirect($page, $check, $code){
    header('location: '.$page, $check, $code);
}
