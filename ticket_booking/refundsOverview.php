<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Orders Overview</title>
        <script src="https://kit.fontawesome.com/bf82faea7e.js" crossorigin="anonymous"></script>
        <style>
            @media screen and (max-width: 992px){

                .orders-box:hover{
                    overflow-x: scroll;
                }
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        include '../nav_bar/navigation_bar.php';
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script>
            $(function () {
                $.ajax({
                    url: "refundsOverviewBackEnd.php",
                    type: "POST",
                    data: {
                        "action": "retrieveAllOrdersByCustFunc"
                    },
                    error: function (xhr, status, error) {
                        console.log("Error: " + error);
                    },
                    success: function (result, status, xhr) {
                        var catchAssocList;
                        catchAssocList = JSON.parse(result);
                        createTable(document.getElementById('order-table'), catchAssocList);
                    }
                });
            })

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
                        col.appendChild(document.createTextNode(value));
                        col.classList.add("text-truncate");
                        row.appendChild(col);
                    }
                    var uniqueID = uniqId("122");
                    var col = document.createElement('td');
                    col.innerHTML = "<form action = 'invoiceDetails.php' method = 'post' id ='" + uniqueID + "'> <input type ='hidden' name ='order_id' value='" + row.firstChild.textContent + "'/> </form>";
                    col.innerHTML += "<button type='submit' form ='" + uniqueID + "' class='btn btn-primary ' ><i class='fa-solid fa-file'></i></button>";

                    row.appendChild(col);
                    // adding each row to table body
                    tableBody.appendChild(row);
                });
                // adding table body to table
                table.appendChild(tableBody);
            }


            function uniqId(prefix) {
                if (window.performance) {
                    var s = performance.timing.navigationStart;
                    var n = performance.now();
                    var base = Math.floor((s + Math.floor(n)) / 1000);
                } else {
                    var n = new Date().getTime();
                    var base = Math.floor(n / 1000);
                }
                var ext = Math.floor(n % 1000 * 1000);
                var now = ("00000000" + base.toString(16)).slice(-8) + ("000000" + ext.toString(16)).slice(-5);
                if (now <= window.my_las_uid) {
                    now = (parseInt(window.my_las_uid ? window.my_las_uid : now, 16) + 1).toString(16);
                }
                window.my_las_uid = now;
                return (prefix ? prefix : '') + now;
            }
        </script>
        <div class="container-fluid">
            <div class="col-lg-12 input-group mt-3 justify-content-center">
                <input type="search" class="form-control rounded mr-3 col-lg-4 srchBar" placeholder="Search" aria-label="Search" aria-describedby="search-addon" id = "search-text"/>
                <button type="button" class="btn btn-outline-primary srchBtn  " id="serch-btn">search</button>
            </div>
            <div class="container-fluid  scrolling-wrapper orders-box" >

                <table class="table table-striped table-dark txt_cent  mx-auto my-4 " id="order-table" >
                    <thead>
                        <tr>
                            <th  scope="col">ID</th>
                            <th  scope="col">Order Date</th>
                            <th  scope="col">Location</th>
                            <th  scope="col">Show Date</th>
                            <th  scope="col">Total Price (RM)</th>
                            <th  scope="col">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <script>
            $("#serch-btn").on('click', function () {
                alert($("#search-text").val());
                $.ajax({
                    url: "refundsOverviewBackEnd.php",
                    type: "POST",
                    data: {
                        "action": "retrieveAllOrdersByCustAndConditionFunc",
                        "srch_text": $("#search-text").val()
                    },
                    error: function (xhr, status, error) {
                        console.log("Error: " + error);
                    },
                    success: function (result, status, xhr) {
                        var select = document.getElementById('order-table');
                        select.removeChild(select.lastChild);

                        var catchAssocList;
                        catchAssocList = JSON.parse(result);
                        createTable(document.getElementById('order-table'), catchAssocList);
                    }
                });
            })
        </script>
    </body>
</html>
