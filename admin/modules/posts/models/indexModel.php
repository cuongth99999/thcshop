<?php

function get_list_users () {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_login_by_username($username) {
    $user = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $user;
}

function add_post ($data) {
    return db_insert('tbl_posts', $data);
}

function get_list_posts () {
    $result = db_fetch_array("SELECT `tbl_posts`.*, `tbl_users`.fullname, `tbl_post_categories`.post_cat_name FROM `tbl_posts` INNER JOIN `tbl_users` ON
                        `tbl_posts`.user_id = `tbl_users`.user_id INNER JOIN  `tbl_post_categories` ON `tbl_posts`.post_cat_id = `tbl_post_categories`.post_cat_id");
    return $result;
}

function get_post_by_id ($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_posts` WHERE `post_id` = {$id}");
    return $item;
}

function get_posts($start = 1, $num_per_page = 5, $filter = "") {

    $list_pages = db_fetch_array("SELECT `tbl_posts`.*, `tbl_users`.fullname, `tbl_post_categories`.post_cat_name FROM `tbl_posts` INNER JOIN `tbl_users` ON
                        `tbl_posts`.user_id = `tbl_users`.user_id INNER JOIN  `tbl_post_categories` ON `tbl_posts`.post_cat_id = `tbl_post_categories`.post_cat_id
                         {$filter} LIMIT {$start}, {$num_per_page}");

    return $list_pages;
}

function update_post ($post_id, $data) {
    db_update('tbl_posts', $data, "`post_id` = '{$post_id}'");
}

function delete_post_by_id($post_id) {
    db_delete('tbl_posts', "`post_id` = '{$post_id}'");
}

function get_info_cat_post () {
    $result = db_fetch_array("SELECT `tbl_post_categories`.*, `tbl_users`.fullname FROM `tbl_post_categories` INNER JOIN `tbl_users` ON
                        `tbl_post_categories`.user_id = `tbl_users`.user_id");
    return $result;
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
