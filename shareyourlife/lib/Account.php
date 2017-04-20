<?php

/**
 * Created by PhpStorm.
 * User: bchaca
 * Date: 20.04.2017
 * Time: 13:54
 */
class Account
{

    public static function getUsername() {
        return (!empty($_SESSION['username'])) ? $_SESSION['username'] : "";
    }
    public static function getUserid(){
        return(!empty($_SESSION['username'])) ? $_SESSION['username']:"";
    }

}