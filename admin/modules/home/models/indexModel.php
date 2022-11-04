<?php

function get_list_users () {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_login_by_username($username) {
    $user = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $user;
}

function add_page ($data) {
    return db_insert('tbl_pages', $data);
}

function get_list_pages () {
    $result = db_fetch_array("SELECT `tbl_pages`.*, `tbl_users`.fullname FROM `tbl_pages` INNER JOIN `tbl_users` ON
                        `tbl_pages`.page_user_id = `tbl_users`.user_id");
    return $result;
}

function get_page_by_id ($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_pages` WHERE `page_id` = {$id}");
    return $item;
}

function get_pages($start = 1, $num_per_page = 5, $filter = "") {

    $list_pages = db_fetch_array("SELECT `tbl_pages`.*, `tbl_users`.fullname FROM `tbl_pages` INNER JOIN `tbl_users` ON
                        `tbl_pages`.page_user_id = `tbl_users`.user_id {$filter} LIMIT {$start}, {$num_per_page}");

    return $list_pages;
}

function update_page ($page_id, $data) {
    db_update('tbl_pages', $data, "`page_id` = '{$page_id}'");
}

function delete_page_by_id($page_id) {
    db_delete('tbl_pages', "`page_id` = '{$page_id}'");
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
