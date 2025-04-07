<?php
if (isset($_GET['id'])) {
    $id_num = $_GET['id'];
} ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMCC Quickbite - Staff Orders</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="staff main.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <img src="png files/smcc logo.png" alt="" height="35" width="40">
                </button>
                <div class="sidebar-logo">
                    <a href="#">SMCC QuickBite</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="dashboard staff.php?id=<?php echo $id_num ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>

                </li>

                <li class="sidebar-item">
                    <a href="staff main.php?num=<?php echo $id_num ?>" class="sidebar-link">
                        <i class="bi bi-box-seam"></i>
                        <span>Your Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="orders staff.php?id=<?php echo $id_num ?>" class="sidebar-link">
                        <i class="bi bi-cart"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="staff_login.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
            <div class="text-center">
                <h1 style="font-size: 2.3rem;">
                    Orders from your clients
                </h1>

            </div>
            <div class="searchArea" style="margin-bottom:1em;">
                <input type="number" id="searchInpt" name="searchInpt" class="inptSearch">
                <button class="btn btn-outline-success searchBtn" id="searchBtn">Search</button>


            </div>

            <article class="tableSec">
                <table class="table table-striped" style="background-color: white;">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Ordered Details</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="tableSec">

                        <?php

                        include('db.php');

                        $sql = "SELECT * FROM orders_history where seller_id = $id_num ORDER BY id_row;";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($row['status'] == "Pending") {
                                    echo "<tr>";
                                    echo "<td><img src='" . $row['product_image'] . "' alt='' height='120' width='120'></td>";
                                    echo "<td>";
                                    echo "<span>" . $row['product_name'] . "</span><br>";
                                    echo "<span>Quantity: " . $row['product_qty'] . "</span><br>";
                                    echo "<span>Customer Name: " . $row['id_number'] . "</span><br>";
                                    echo "<div style='display:flex; gap:10px; flex-wrap:wrap;'>";
                                    echo "<button class='btn btn-success' onclick='approvedBtn(" . $id_num . "," . $row['id_number'] . "," . $row['id_row'] . ", \"" . addslashes($row['seller_name']) . "\",\"" . addslashes($row['product_name']) . "\")'>Order Ready</button>";
                                    echo "<button class='btn btn-danger'>Reject</button>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<span style='color:#FFD900;'>" . $row['status'] . "</span>";
                                    echo "</td>";
                                    echo "</tr>";
                                } else if ($row['status'] == "Waiting for pickup") {
                                    echo "<tr>";
                                    echo "<td><img src='" . $row['product_image'] . "' alt='' height='120' width='120'></td>";
                                    echo "<td>";
                                    echo "<span>" . $row['product_name'] . "</span><br>";
                                    echo "<span>Quantity: " . $row['product_qty'] . "</span><br>";
                                    echo "<span>Customer Name: " . $row['id_number'] . "</span><br>";
                                    echo "<div style='display:flex; gap:10px; flex-wrap:wrap;'>";
                                    echo "<button class='btn btn-success' onclick='pickupBtn(". $row['id_number'] .", ". $id_num .",".$row['id_row']  .", \"" . addslashes($row['seller_name']) . "\",\"" . addslashes($row['product_name']) . "\")'>Pickup Done</button>";
                                    echo "<button class='btn btn-danger'>Reject</button>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<span style='color:blue;'> Waiting for pickup</span>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                else{
                                    echo "<tr>";
                                    echo "<td><img src='" . $row['product_image'] . "' alt='' height='120' width='120'></td>";
                                    echo "<td>";
                                    echo "<span>" . $row['product_name'] . "</span><br>";
                                    echo "<span>Quantity: " . $row['product_qty'] . "</span><br>";
                                    echo "<span>Customer Name: " . $row['id_number'] . "</span><br>";
                                    echo "<div style='display:flex; gap:10px; flex-wrap:wrap;'>";
                                 
                                    echo "</div>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<span style='color:green;'> Order Retrieved</span>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                        ?>


                    </tbody>
                </table>
            </article>
        </div>
    </div>
    <script>


        function pickupBtn(stud_id,sell_id,idRow,sellerName,productName){
            let formD = new FormData();

            formD.append('studId', stud_id);
            formD.append('sell_id', sell_id);
            formD.append('id_row', idRow);
            formD.append('seller_name', sellerName);
            formD.append('product_name',productName);

            let xhr = new XMLHttpRequest();

            xhr.open('POST', 'order pickup done(staff).php', true);

            xhr.onload = function() {
                if (xhr.status == 200) {
                    console.log(xhr.responseText);
                    alert('Order Retrieved')
                } else {
                    console.log(xhr.status)
                }
            }
            xhr.send(formD);
            location.reload();
        }

        function approvedBtn(sell_id, stud_id, idRow,sellerName,proName) {
            let formD = new FormData();

            formD.append('sell_id', sell_id);
            formD.append('stud_id', stud_id);
            formD.append('id_row', idRow);
            formD.append('seller_name', sellerName);
            formD.append('product_name',proName);

            let xhr = new XMLHttpRequest();

            xhr.open('POST', 'order ready(staff).php', true);

            xhr.onload = function() {
                if (xhr.status == 200) {
                    console.log(xhr.responseText);
                    alert('Order is ready to pickup');
                } else {
                    console.log(xhr.status)
                }
            }

            xhr.send(formD);
            location.reload();

        }
    </script>
    <div class="mainConfirm" id="mainConfirm">
        <div class="bodyConf">
            <div class="bg-light p-5 text-center confM">
                <i class="bi bi-exclamation-circle"></i>
                <p>What's the reason: </p>
                <div class="choicesBtn">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="" id="firstRadio" checked>
                            <label class="form-check-label" for="firstRadio">First radio</label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="" id="secondRadio">
                            <label class="form-check-label" for="secondRadio">Second radio</label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="" id="thirdRadio">
                            <label class="form-check-label" for="thirdRadio">Third radio</label>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>