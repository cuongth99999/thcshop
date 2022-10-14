<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('team');
    load('lib', 'email');
}

function indexAction() {

    load_view('teamIndex');
}