<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>


    </head>
    <body>

        <?php
        include '../nav_bar/navigation_bar.php';
        include "paymentbackEnd.php";

        $seatsCompleteInfo = getSeatsCompleteInfo();
        $invoiceDtls = getInvoiceDetails($seatsCompleteInfo[0]['sch_id']);
        $seatTtlPrice = $invoiceDtls[0]['unit_price'] * count($seatsCompleteInfo);
        $seatOriPrice = $invoiceDtls[0]['unit_price'];
        $seatChildPrice = $invoiceDtls[0]['unit_price'] * 0.6; // 40% discount
        ?>


        <script>
            var ttlPrice = 0;
            var price = 0;
            $(function () {
                var returnPhp;
                price = <?php echo $invoiceDtls[0]['unit_price']; ?>;
                ttlPrice += <?php echo $seatTtlPrice; ?>;
                $.ajax({
                    url: "paymentBackEnd.php", //your page
                    type: "POST", //type of method
                    data: {action: "retrieveFoods"}, // passing the values
                    error: function (xhr, status, error) {
                        console.log("Error: " + error);
                    },
                    success: function (result, status, xhr) {
                        try {
                            returnPhp = jQuery.parseJSON(result);
                            if (returnPhp != null && returnPhp.length != 0) {
                                createTable(document.getElementById('food-table'), returnPhp);
                                // after source code do at here
                                document.getElementById("total-price").innerHTML = "";
                                document.getElementById("total-price").appendChild(document.createTextNode("RM " + ttlPrice.toFixed(2)));
                            } else {
                                clearFoodTable();
                            }
                        } catch (err) {
                            clearFoodTable();
                        }
                    }
                });
                // dont put source code do at here, it will do here first just do the ajax
            });
            function clearFoodTable() {
                var paraGraph = document.createElement('p');
                paraGraph.classList.add("rounded");
                paraGraph.classList.add("px-3");
                paraGraph.classList.add("py-2");
                paraGraph.classList.add("mx-0");
                paraGraph.classList.add("font-weight-bold");
                paraGraph.classList.add("m-0");
                paraGraph.classList.add("content");
                paraGraph.appendChild(document.createTextNode("No Food Selected."));
                document.getElementById("food-table-container").innerHTML = "";
                document.getElementById("food-table-container").appendChild(paraGraph);
            }

            // dynamic function to cteate table out of 2d arrays
            function createTable(table, tableData) {

                // creating table body <tbody> element
                var tableBody = document.createElement('tbody');
                // creating cells in each row based on second diamention datas
                tableData.forEach(function (rowData) {
                    var row = document.createElement('tr');
                    ttlPrice += rowData['uniPr'] * rowData['foodQty'];
                    for (var key in rowData) {
                        var col = document.createElement('td');
                        var value = rowData[key];
                        col.appendChild(document.createTextNode(value));
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

        <link rel="stylesheet" type="text/css" href="payment.css"/>


        <div class="container-fluid  ">
            <div class="container-fluid  col-lg-8 invoice-box rounded p-3 mt-2" id = "invoice-container">
                <form>
                    <div class="container-fluid /*border border-success*/ col-12 ">

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0 font-weight-bold m-0 ">Movie Name</p>
                        </div>
                        <div class="row   rounded py-2 content-div mx-auto">
                            <!--
                            -->

                            <p  class= " rounded px-3 py-2 mx-0  font-weight-bold m-0 content"><?php echo $invoiceDtls[0]['movie_name']; ?></p>
                        </div>
                    </div>
                    <div class="container-fluid  /*border border-success*/ col-12">

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0 ">Location</p>
                        </div>
                        <div class="row  rounded py-2 content-div  mx-auto">
                            <p  class= " rounded px-3 py-2 mx-0  font-weight-bold m-0 content"><?php echo $invoiceDtls[0]['location_name']; ?></p>
                        </div>
                    </div>

                    <div class="container-fluid /*border border-success*/ col-12">

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0 ">Date & Time</p>
                        </div>
                        <div class="row   rounded py-2 content-div  mx-auto">
                            <p  class= " rounded px-3 py-2 mx-0  font-weight-bold m-0 content"><?php echo date("l, F d, Y", strtotime($invoiceDtls[0]['show_date'])) . " (" . date("h:i A", strtotime($invoiceDtls[0]['show_time'])) . ")"; ?></p>
                        </div>
                    </div>

                    <hr >
                    <div class="container-fluid /*border border-success*/ col-12">

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0">Adult Ticket</p>
                        </div>
                        <div class="row drag-zone  rounded content-div  mx-auto" id="qw1" ondrop="handleDrop(event); adjTtlPr(this, <?php echo $seatChildPrice; ?>, <?php echo $seatOriPrice; ?>);" ondragstart="onDragStart(event);setPrice(this, <?php echo $seatOriPrice; ?>);"ondragover="onDragOver(event);">

                            <?php
                            foreach ($seatsCompleteInfo as $row) {
                                echo "<div draggable = 'true' class = 'box m-2' id = '" . $row['sch_id'] . "'>";
                                echo "<input type = 'submit' value = '" . $row['seat_name'] . "' class = 'btn btn-outline-primary font-weight-bold' />";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="container-fluid /*border border-success*/ col-12">
                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0">Child Ticket</p>
                        </div>
                        <div class="row drag-zone  rounded content-div  mx-auto" id="qw2" ondrop="handleDrop(event); adjTtlPr(this, <?php echo $seatOriPrice; ?>, <?php echo $seatChildPrice; ?>);" ondragstart="onDragStart(event);setPrice(this, <?php echo $seatChildPrice; ?>);" ondragover="onDragOver(event);" style = "height:50px;">

                        </div>
                    </div>
                    <hr >
                    <div class="container-fluid /*border border-success*/ col-12 "> <!<!-- d-none display nothing -->

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0">Food & Beverage</p>
                        </div>
                        <div class="row rounded py-0 content-div my-auto mx-auto" id="food-table-container">
                            <table class="table table-striped table-dark txt_cent my-0" id="food-table" >
                                <thead>
                                    <tr>
                                        <th  scope="col">ID</th>
                                        <th  scope="col">Food Name</th>
                                        <th  scope="col">Unit Price (RM)</th>
                                        <th  scope="col">Quantity</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="container-fluid /*border border-success*/ col-12">

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0">Total Price</p>
                        </div>
                        <div class="row   rounded py-2 content-div  mx-auto">
                            <p  class= " rounded px-3 py-2 mx-0  font-weight-bold m-0 content" id="total-price">Try</p>
                        </div>
                    </div>

                    <!--
                    <div class="container-fluid /*border border-success*/ col-12">

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0">Description</p>
                        </div>
                        <div class="row   rounded    mx-auto">
                            <textarea class = "rounded px-3 py-2 mx-0  col-12 font-weight-bold m-0 content" placeholder="Tell us your additional requirement that we shoud pay attention..." maxlength="500"></textarea>
                        </div>
                    </div>
                    -->
                </form>

                <div class=" container-fluid justify-content-end align-items-right clearfix">
                    <form class="paypal" action = "paypalEnv/request.php" id="goPaypalForm" method="post">
                        <input type="hidden" name="pymt_amt" value="" id="pymt_amt">
                    </form>

                    <button class="btn btn-outline-primary float-right font-weight-bold text-uppercase col-lg-4 col-sm-4 col-4 my-lg-3 my-sm-3 my-3 rounded" id="next-btn">
                        next
                    </button>
                </div>
            </div>

        </div>




    </div>

    <?php
    include '../nav_bar/footer.php';
    ?>
    <script src = "dragADrop.js" type = "text/javascript"></script>
    <script src="cookies.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script>

                            var oriZoneId;
                            var seatTicketType;
                            function setPrice(currZone, amount) {
                                price = amount;
                                oriZoneId = currZone.id;
                            }

                            function adjTtlPr(currZone, oldPrice, newPrice) {
                                if (currZone.id != oriZoneId) {
                                    ttlPrice -= oldPrice;
                                    ttlPrice += newPrice;
                                    // after source code do at here
                                    document.getElementById("total-price").innerHTML = "";
                                    document.getElementById("total-price").appendChild(document.createTextNode("RM " + ttlPrice.toFixed(2)));
                                }
                            }



                            $('#next-btn').on('click', function () {
                                document.getElementById('pymt_amt').value = ttlPrice;
                                var stcompleteInfor = [];
                                var adultZone = document.getElementById('qw1');
                                var oChild;

                                for (i = 1; i < adultZone.childNodes.length - 1; i++) {
                                    oChild = adultZone.childNodes[i];
                                    stcompleteInfor.push({"sch_id": oChild.id, "ticket_type": "Adult", "unitPrice":<?php echo $seatOriPrice ?>})
                                }

                                var childZone = document.getElementById('qw2');
                                for (i = 1; i < childZone.childNodes.length; i++) {
                                    oChild = childZone.childNodes[i];

                                    stcompleteInfor.push({"sch_id": oChild.id, "ticket_type": "Child", "unitPrice":<?php echo $seatChildPrice ?>})
                                }

                                delete_cookie('seatsSelected');
                                createCookie('seatsSelected', JSON.stringify(stcompleteInfor), '1');

                                document.getElementById("goPaypalForm").submit();
                            });
    </script>

</body>
</html>
