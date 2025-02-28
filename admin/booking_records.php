<?php
    require('inc/essentials.php');
    require('inc/db_config.php');
    adminLogin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Booking Records</title>
    <?php require('inc/link.php'); ?>
</head>
<body class="bg-light">
    <?php
        require('inc/header.php');
    ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4">
                <h3 class="mb-4 h-font">
                HỒ SƠ ĐẶT PHÒNG
                </h3>
                <!-- ROOMS section -->
                <div class="card border-0 shadow-sm mb-4 overflow-hidden">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <input type="text" id="search_input" oninput="get_bookings(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Nhập để tìm kiếm...">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover border" style="min-width: 1200px;">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Người dùng</th>
                                        <th scope="col">Phòng </th>
                                        <th scope="col">Chi Tiết Đặt Phòng</th>
                                        <th scope="col">Trạng Thái</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                                   
                                </tbody>
                            </table>
                        </div>
                        <nav>
                            <ul class="pagination mt-3" id="table-pagination">
                    
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>




<?php require('inc/scripts.php'); ?>
   
<script src="scripts/booking_records.js"></script>

</body>
</html>