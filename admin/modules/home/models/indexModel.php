<?php

function get_list_users () {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_login_by_username($username) {
    $user = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $user;
}

function get_list_orders() {
    $result = db_fetch_array("SELECT `tbl_orders`.*, `tbl_customers`.*, `tbl_detail_orders`.* FROM `tbl_orders` INNER JOIN `tbl_customers` ON
                        `tbl_orders`.customer_id = `tbl_customers`.customer_id INNER JOIN  `tbl_detail_orders` ON `tbl_orders`.order_id = `tbl_detail_orders`.order_id
                        GROUP BY `tbl_orders`.order_code ASC");
    return $result;
}

function get_turnover() {
    $result = db_fetch_row("SELECT SUM(`tbl_detail_orders`.num_order * `tbl_products`.price) AS `sum_turnover` FROM `tbl_detail_orders` 
                                 INNER JOIN `tbl_products` ON `tbl_detail_orders`.product_id = `tbl_products`.id
                                 INNER JOIN  `tbl_orders` ON `tbl_detail_orders`.order_id = `tbl_orders`.order_id                                                 
                                 WHERE `tbl_orders`.status = 'Thành công'");
    return $result;
}

