<?php
namespace controllers;
class Security {

    public static function accessSession() {
        return (!empty($_SESSION['access']) && $_SESSION['access'] === 'user');
    }
}