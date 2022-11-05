<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');

    load_view('index');
}