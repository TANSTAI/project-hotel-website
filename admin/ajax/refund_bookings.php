<?php

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['get_bookings']))
    {
        $frm_data = filteration($_POST);
        $query = "SELECT bo.*, bd.* FROM `booking_order` bo
        INNER JOIN `booking_detail` bd ON bo.booking_id = bd.booking_id
        WHERE (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?)
        AND (bo.booking_status = ? AND bo.refund = ?) ORDER BY bo.booking_id ASC";

        $res = select($query,["%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","cancelled",0],'sssss');
        $i = 1;
        $table_data="";

        if(mysqli_num_rows($res)==0){
            echo"<b>Không tìm thấy dữ liệu!</b>";
            exit;
        }

        while($data = mysqli_fetch_assoc($res))
        {
            $date = date("d-m-Y",strtotime($data['datetime']));
            $checkin = date("d-m-Y",strtotime($data['check_in']));
            $checkout = date("d-m-Y",strtotime($data['check_out']));

            $table_data .="
                <tr>
                    <td>$i</td>
                    <td>
                        <span class='badge bg-primary'>
                            Order ID: $data[order_id]
                        </span>
                        <br>
                        <b>Tên :</b>$data[user_name]
                        <br>
                        <b>Điện thoại :</b>$data[phonenum]
                    </td>
                    <td>
                        <b>Phòng :</b> $data[room_name]
                        <br>
                        <b>Check in:</b> $checkin
                        <br>
                        <b>Check out:</b> $checkout
                        <br>
                        <b>Ngày:</b> $date
                    </td>
                    <td>
                        <b>$data[trans_amt]₫</b> 
                        <br>
                    </td>
                    <td>
                        <button type='button' onclick='refund_booking($data[booking_id])' class='btn btn-success btn-sm fw-bold shadow-none'>
                        <i class='bi bi-cash-stack'></i> Hoàn Tiền
                        </button>
                    </td>
                </tr>
            ";
            $i++;
        }
        echo $table_data;

    }

    if(isset($_POST['refund_booking']))
    {
        $frm_data = filteration($_POST);

        $query = "UPDATE `booking_order` SET `refund` = ? WHERE `booking_id`=?";
        $values = [1,$frm_data['booking_id']];
        $res = update($query,$values,'ii');

        echo $res;
    }

?>