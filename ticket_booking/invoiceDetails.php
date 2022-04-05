<!DOCTYPE html>
<html>
    <head>
        <title>title</title>
        <?php
        include 'invoiceDetailsBackEnd.php';
        $orderID = $_POST['order_id'];
        $orderDtls = retrieveOrderDtls($orderID);
        $orderListFoodDtls = retrieveOrderListFoodDtls($orderID);
        $orderListSeatDtls = retrieveOrderListSeatDtls($orderID);
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <script>
            var orderDtls;
            var orderListSeatDtls;
            var orderListFoodDtls;
            $(function () {
                orderDtls = <?php echo json_encode($orderDtls); ?>;
                console.log(orderDtls);
                orderListSeatDtls = <?php echo json_encode($orderListSeatDtls); ?>;
                orderListFoodDtls = <?php echo json_encode($orderListFoodDtls); ?>;

                createTable(document.getElementById('seat-table'), orderListSeatDtls);
                createTable(document.getElementById('food-table'), orderListFoodDtls);
            });

            // dynamic function to cteate table out of 2d arrays
            function createTable(table, tableData) {

                // creating table body <tbody> element
                var tableBody = document.createElement('tbody');
                // creating cells in each row based on second diamention datas
                tableData.forEach(function (rowData) {
                    var row = document.createElement('tr');
                    for (var key in rowData) {
                        var col = document.createElement('td');
                        var value = rowData[key];
                        col.appendChil d(document.createTextNode(value));
                        col.classList.add("text-truncate");
                        row.appendChild(col);
                    }
                    // adding each row to table body
                    tableBody.appendChild(row);
                });
                // adding table body to table
                table.appendChild(tableBody);
            }
        </script>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <style type="text/css">

            body
            {
                background:rgb(16,27,44);
            }

            .payment
            {
                border:1px solid #f2f2f2;
                border-radius:20px;
                background:#fff;
            }
            .payment_header
            {
                background:#5cb85c;
                padding:20px;
                border-radius:20px 20px 0px 0px;

            }

            .check
            {
                margin:0px auto;
                width:50px;
                height:50px;
                border-radius:100%;
                background:#fff;
                text-align:center;
            }

            .check i
            {
                vertical-align:middle;
                line-height:50px;
                font-size:30px;
            }

            .content
            {
                text-align:center;
            }

            .content  h1
            {
                font-size:25px;
                padding-top:25px;
            }

            .content a
            {
                width:200px;
                height:35px;
                color:#fff;
                border-radius:30px;
                padding:5px 10px;
                background:#5cb85c;
                transition:all ease-in-out 0.3s;
            }

            .content a:hover
            {
                text-decoration:none;
                background:#000;
            }
            @media print{
                body *{
                    visibility:hidden;

                }
                .print-container, .print-container *{
                    visibility:visible;
                }
            }

            /* Small devices (landscape phones, 544px and up) */
            @media (min-width: 544px) {
                .data {font-size:0.9rem;} /*1rem = 16px*/
            }

            /* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
            @media (min-width: 768px) {
                .data {font-size:1rem;} /*1rem = 16px*/
            }

            /* Large devices (desktops, 992px and up) */
            @media (min-width: 992px) {
                .data {font-size:1rem;} /*1rem = 16px*/
            }

            /* Extra large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) {
                .data {font-size:1rem;} /*1rem = 16px*/
            }
        </style>
    </head>
    <body>
        <form onsubmit="" id="sendEmailForm">
            <button type="submit" form="sendEmailForm">This is submti button</button>
        </form>
        <script>

            $("#sendEmailForm").on("submit", function (e) {
                e.preventDefault();
                sendEmail();
                reset();
                return false;
            })

        </script>

        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto mt-5">
                    <div class="payment">
                        <div class="payment_header">
                            <h1 class="text-center">Invoice Details</h1>
                        </div>

                        <div class="content container-fluid pb-4">
                            <div class=" container-fluid justify-content-end align-items-right clearfix" onclick="window.print();">
                                <button class="btn btn-outline-primary float-right font-weight-bold text-uppercase col-lg-3 col-sm-3 col-3 my-lg-3 my-sm-3 my-3 rounded" id="next-btn">
                                    Print
                                </button>
                            </div>


                            <hr>
                            <div class="print-container mb-3">



                                <div class= " col-12 text-left px-0 py-3 align-middle">
                                    <div class="d-flex container  col-12 mt-2" >
                                        <p class="label col-lg-3 col-xs-2 px-3 py-2 mx-0  font-weight-bold m-0 text-white bg-dark align-middle">
                                            Order Date
                                        </p>
                                        <div class=" col-8 rounded px-3 py-2 font-weight-bold data">
                                            <?php echo $orderDtls[0]['ORDER_DATE']; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex container  col-12 mt-2" >
                                        <p class="label col-lg-3 col-xs-2  px-3 py-2 mx-0  font-weight-bold m-0 text-white bg-dark align-middle">
                                            Order ID
                                        </p>
                                        <div class=" col-8 rounded px-3 py-2 font-weight-bold data">
                                            <?php echo $orderDtls[0]['ORDER_ID']; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex container  col-12 mt-2" >
                                        <p class="label col-lg-3 col-xs-2  px-3 py-2 mx-0  font-weight-bold m-0 text-white bg-dark align-middle">
                                            Transaction ID
                                        </p>
                                        <div class=" col-8 rounded px-3 py-2 font-weight-bold data">
                                            <?php echo $orderDtls[0]['TRANSACTION_ID']; ?>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex container  col-12 mt-2" >
                                        <p class="label col-lg-3 col-xs-2  px-3 py-2 mx-0  font-weight-bold m-0 text-white bg-dark align-middle">
                                            Customer ID
                                        </p>
                                        <div class=" col-8 rounded px-3 py-2 font-weight-bold data">
                                            <?php echo $orderDtls[0]['CUST_ID']; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex container  col-12 mt-2" >
                                        <p class="label col-lg-3 col-xs-2  px-3 py-2 mx-0  font-weight-bold m-0 text-white bg-dark align-middle">
                                            Customer Name
                                        </p>
                                        <div class=" col-8 rounded px-3 py-2 font-weight-bold data">
                                            <?php echo $orderDtls[0]['CUST_NAME']; ?>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex container  col-12 mt-2" >
                                        <p class="label col-lg-3 col-xs-2  px-3 py-2 mx-0  font-weight-bold m-0 text-white bg-dark align-middle">
                                            Location Name
                                        </p>
                                        <div class=" col-8 rounded px-3 py-2 font-weight-bold data">
                                            <?php echo $orderDtls[0]['LOCATION_NAME']; ?>
                                        </div>
                                    </div>

                                    <div class="d-flex container  col-12 mt-2" >
                                        <p class="label col-lg-3 col-xs-2  px-3 py-2 mx-0  font-weight-bold m-0 text-white bg-dark align-middle">
                                            Cinema Room ID
                                        </p>
                                        <div class=" col-8 rounded px-3 py-2 font-weight-bold data">
                                            <?php echo $orderDtls[0]['CINEMA_ROOM_ID']; ?>
                                        </div>
                                    </div>



                                    <div class="d-flex container  col-12 mt-2" >
                                        <p class="label col-lg-3 col-xs-2  px-3 py-2 mx-0  font-weight-bold m-0 text-white bg-dark align-middle">
                                            Show Date
                                        </p>
                                        <div class=" col-8 rounded px-3 py-2 font-weight-bold data">
                                            <?php echo $orderDtls[0]['SHOW_DATE']; ?>
                                        </div>
                                    </div>

                                    <div class="d-flex container  col-12 mt-2" >
                                        <p class="label col-lg-3 col-xs-2  px-3 py-2 mx-0  font-weight-bold m-0 text-white bg-dark align-middle">
                                            Show Time
                                        </p>
                                        <div class=" col-8 rounded px-3 py-2 font-weight-bold data">
                                            <?php echo date("h:i A", strtotime($orderDtls[0]['SHOW_TIME'])); ?>
                                        </div>
                                    </div>

                                    <div class="d-flex container  col-12 mt-2" >
                                        <p class="label col-lg-3 col-xs-2  px-3 py-2 mx-0  font-weight-bold m-0 text-white bg-dark align-middle">
                                            End Time
                                        </p>
                                        <div class=" col-8 rounded px-3 py-2 font-weight-bold data">
                                            <?php echo date("h:i A", strtotime($orderDtls[0]['END_TIME'])); ?>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-striped table-dark txt_cent my-0" id="seat-table" >
                                    <thead>
                                        <tr>
                                            <th  scope="col">ID</th>
                                            <th  scope="col">Seat</th>
                                            <th  scope="col">Ticket Type</th>
                                            <th  scope="col">unit Price</th>
                                        </tr>
                                    </thead>
                                </table>

                                <br/>

                                <table class="table table-striped table-dark txt_cent my-0" id="food-table" >
                                    <thead>
                                        <tr>
                                            <th  scope="col">ID</th>
                                            <th  scope="col">Food Name</th>
                                            <th  scope="col">Unit Price (RM)</th>
                                            <th  scope="col">Quantity</th>
                                            <th  scope="col">Sub Price</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class= "d-flex justify-content-start clearfix col-12 text-right px-0 py-3 ">
                                    <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0 text-white bg-dark">Total Price</p>
                                </div>
                                <div class= "d-flex justify-content-end clearfix col-12 text-left px-0 py-3 ">
                                    <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0 text-white bg-dark">Total Price&emsp;<span>RM&ensp;<?php echo number_format($orderDtls[0]['TOTAL_PRICE'], 2); ?></span></p>
                                </div>
                            </div>
                            <hr>
                            <a href="http://localhost/LGTL_Cineplex/LGTL_cinema/ticket_booking/refundsOverview.php" class = "h5 px-4">Go Back</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script src="https://smtpjs.com/v3/smtp.js"></script>

        <script>
                                function sendEmail() {
                                    Email.send({
                                        Host: "smtp.gmail.com",
                                        Username: "teezx-wm19@student.tarc.edu.my",
                                        Password: "pashchyxtrtfopav",
                                        To: 'ABC@gmail.com',
                                        From: "Tee Zhuo Xuan",
                                        Subject: "This is the subject",
                                        Body: "Customer ID : " + "NONE"
                                                + "<br>Name : " + "NONE"
                                                + "<br> Email : " + "NONE"
                                                + "<br> Contact Number : " + "NONE"
                                                + "<br> Comment : " + "NONE"
                                                //+"<br> Rate : " + document.getElementById("comment").value
                                    }).then(
                                            message => alert("Message Sent Successfully")
                                    );
                                }
        </script>
    </body>
</html>

