<?php

function get_list_users () {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_login_by_username($username) {
    $user = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $user;
}

function add_slider($data) {
    return db_insert('tbl_sliders', $data);
}

function get_list_sliders () {
    $result = db_fetch_array("SELECT `tbl_sliders`.*, `tbl_users`.fullname FROM `tbl_sliders` INNER JOIN `tbl_users` ON
                        `tbl_sliders`.user_id = `tbl_users`.user_id");
    return $result;
}

function get_slider_by_id ($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_sliders` WHERE `slider_id` = {$id}");
    return $item;
}

function get_sliders($start = 1, $num_per_page = 5, $filter = "") {

    $list_pages = db_fetch_array("SELECT `tbl_sliders`.*, `tbl_users`.fullname FROM `tbl_sliders` INNER JOIN `tbl_users` ON
                        `tbl_sliders`.user_id = `tbl_users`.user_id {$filter} LIMIT {$start}, {$num_per_page}");

    return $list_pages;
}

function update_slider ($id, $data) {
    db_update('tbl_sliders', $data, "`slider_id` = '{$id}'");
}

function delete_slider_by_id($id) {
    db_delete('tbl_sliders', "`slider_id` = '{$id}'");
}

function get_pagging($num_page, $page, $base_url = "") {
    $str_pagging = "<div class=\"section\" id=\"paging-wp\">
                <div class=\"section-detail clearfix\">
                    <ul id=\"list-paging\" class=\"fl-right\">";

    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "<li><a href=\"{$base_url}&page={$page_prev}\"><</a></li>";
    }
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page) {
            $active = "class = 'active'";
        }
        $str_pagging .= "<li {$active}><a href=\"{$base_url}&page={$i}\">$i</a></li>";
    }
    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .= "<li><a href=\"{$base_url}&page={$page_next}\">></a></li>";
    }

    $str_pagging .= "</ul>
                </div>
            </div>";

    return $str_pagging;
}
