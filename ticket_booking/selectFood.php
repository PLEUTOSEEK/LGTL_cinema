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
        <link rel="stylesheet" href="selectFood.css"/>
        <link rel="stylesheet" href="./frameworks/bootstrap.min.css"></link>
        <link href="./font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <style>
            .txt_cent{
                text-align:center;
            }
            .inp_width{
                width:70px;
            }
        </style>
    </head>
    <body>
        <div class="textBox"><span>The quick brown fox jumps over the lazy dog</span></div>

        <?php
        include '../nav_bar/navigation_bar.php';
        include 'selectFoodBackEnd.php';
        $foods = getFoods();
        ?>

        <?php
        $borderPrimary = "border border-primary";
        $borderWaring = "border border-warning";
        $borderDanger = "border border-danger";
        $borderPrimary = " ";
        $borderWaring = " ";
        $borderDanger = " ";
        ?>



        <div class="container-fluid  py-3 <?php echo $borderDanger ?>  " >


            <div class=" d-flex flex-row-reverse  <?php echo $borderDanger ?>  " style="height:50px">
                <button class="btn btn-outline-primary  position-fixed " id="toggle-panel-btn" data-toggle="collapse" data-target="#mySidepanel" aria-controls ="mySidepanel" class="mobile" style="z-index:112;">&#9776; Food Cart</button>

                <div id="mySidepanel" class="collapse  position-fixed  col-12 mt-5   add-on-foodCartPanel overflow-auto bg-dark"aria-expanded="false" style=" transition: 0.5s; ">

                    <table class="table table-striped table-dark txt_cent" id="food-table" >
                        <thead>
                            <tr>
                                <th  scope="col">ID</th>
                                <th  scope="col">Food Name</th>
                                <th  scope="col">unit Price (RM)</th>
                                <th  scope="col">Quantity</th>
                                <th  scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr >

                            </tr>
                        </tbody>
                    </table>
                    <div class=" d-flex flex-row-reverse">
                        <button class="btn btn-outline-primary font-weight-bold text-uppercase col-lg-2 col-4 my-lg-3 my-sm-3 my-3 rounded-0 add-on-next-btn " id="next-btn">
                            next
                        </button>
                    </div>

                </div>
            </div>
            <div class="container-fluid  px-lg-auto px-auto <?php echo $borderDanger ?> d-flex justify-content-center " >

                <div class="row justify-content-center " id="foodRows" style="z-index:1;" >
                    <?php
                    //1 need 12
                    //2 need 4
                    // 3 need 3
                    //
                    $totalCard = count($foods);

                    $cardSize = 2;
                    $cardSizeSmall = 6;
                    if ($totalCard == 1) {
                        $cardSize = 12;
                        $cardSizeSmall = 8;
                    } else if ($totalCard == 2) {
                        $cardSize = 5;
                    } else if ($totalCard == 3) {
                        $cardSize = 3;
                    } else {
                        $cardSize = 2;
                    }
                    for ($x = 1; $x <= count($foods); $x++) {
                        echo "<div class=\"card  col-lg-$cardSize col-md-4 col-$cardSizeSmall mx-4 px-0 my-3\" style=\"height: 23em;width: 17em;\">";
                        echo "<div style=\"height:60%;width:100%;background-color: #5f5f5f\">";
                        echo "<div class = \"card-img-top\" >";
                        echo "<img src='data:image/jpg;charset=utf8;base64," . base64_encode($foods[$x - 1]['food_img']) . "' alt='' title='" . $foods[$x - 1]['food_name'] . "' class='card-img-top'/>";
                        echo "</div>";
                        echo "</div>";
                        echo " <div class = \"card-body\">";
                        echo "<h3 class = 'card-title text-truncate' >" . $foods[$x - 1]['food_name'] . "</h3>";
                        echo "<h5 class = \"card-title \">" . number_format((float) $foods[$x - 1]['unit_price'], 2, '.', '') . "</h5>";
                        echo "<form name = \"foodInfo\" class = \"food-obj py-0\" >";

                        echo "<input type = \"submit\" value = \"Add To Basket\" class = \"btn btn-outline-primary \" />";
                        //add whatever column you want here
                        echo "<input type = \"hidden\" name = \"col1\" value = \"" . $foods[$x - 1]['fb_id'] . "\" />";
                        echo "<input type = \"hidden\" name = \"col2\" value = \"" . $foods[$x - 1]['food_name'] . "\" />";
                        echo "<input type = \"hidden\" name = \"col3\" value = \"" . $foods[$x - 1]['unit_price'] . "\" />";
                        echo "</form>";
                        echo " </div>";
                        echo "</div>";
                    }
                    ?>


                </div>

            </div>

        </div>

        <?php
        include '../nav_bar/footer.php';
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="cookies.js"></script>

        <script >
            var addedFoods = [];
            var addedFoodsCompleteInfo = [];


            $(document).on('click', '.ticket-type-drop-down', function (e) {
                var value = this.options[e.selectedIndex].value;
            });

            $('#toggle-panel-btn').on('click', function () {

                console.log($('#mySidePanel').attr("aria-expanded"));

                if (document.getElementById("foodRows").style.zIndex == "-1") {
                    document.getElementById("foodRows").style.zIndex = "1";
                } else {
                    document.getElementById("foodRows").style.zIndex = "-1";
                }
            });

            $(document).on('click', '.qtyplus', function (e) {
                e.preventDefault();
                var $this = $(this);
                var $target = $this.prev('input[name=' + $this.attr('field') + ']');
                var currentVal = parseInt($target.val());
                if (!isNaN(currentVal)) {
                    if (currentVal < 10) {
                        $target.val(currentVal + 1);
                    }
                } else {
                    $target.val(0);
                }
            });

            $(document).on('click', '.qtyminus', function (e) {
                e.preventDefault();
                var $this = $(this);
                var $target = $this.next('input[name=' + $this.attr('field') + ']');
                var currentVal = parseInt($target.val());
                if (!isNaN(currentVal)) {
                    $target.val((currentVal == 0) ? 0 : currentVal - 1);
                } else {
                    $target.val(0);
                }
            });

            $(document).on('click', '.del-row-food-btn', function () {
                var index = $('.del-row-food-btn').index(this);

                var delFoodID = document.getElementById("food-table").rows[index + 1].cells[0].innerHTML;
                addedFoods.splice(addedFoods.indexOf(delFoodID), 1);

                document.getElementById("food-table").deleteRow(index + 1);
            });

            $('.food-obj').on('submit', function (e) {

                e.preventDefault();
                const data = Object.fromEntries(new FormData(e.target).entries());
                // add to table row
                if (addedFoods.indexOf(data["col1"]) == -1) {
                    addedFoods.push(data["col1"]);

                    var table = document.getElementById("food-table");
                    var foodRow = table.insertRow(1);
                    var minPlusCtrl = "";

                    var y = 0;
                    for (var x = 0; x < 3; x++) {
                        var cell = foodRow.insertCell(x);
                        cell.innerHTML = data["col".concat('', (x + 1))];
                        cell.classList.add("align-middle");
                        y++;
                    }

                    var cell = foodRow.insertCell(y);
                    minPlusCtrl = minPlusCtrl.concat('', "<input type='button' value='-' class='col-lg-12 col-12 qtyminus ' field='quantity'/>");
                    minPlusCtrl = minPlusCtrl.concat('', "<input type='text' onchange='handleChange(this);' name='quantity' value='1' class='qty col-lg-12 col-12 text-center'/>");
                    minPlusCtrl = minPlusCtrl.concat('', "<input type='button' value='+' class='col-lg-12 col-12 qtyplus ' field='quantity'/>");
                    cell.innerHTML = minPlusCtrl;
                    cell.classList.add("col-lg-1");
                    cell.classList.add("col-1");
                    cell.classList.add("align-middle");

                    cell = foodRow.insertCell(y + 1);
                    cell.innerHTML = '<button type="button" class="btn btn-danger del-row-food-btn"><i class="far fa-trash-alt"></i></button>';
                    cell.classList.add("align-middle");
                }
            });

            $('#next-btn').on('click', function () {
                var table = document.querySelector("#food-table");
                for (var i = 1; i < table.tBodies[0].rows.length; i++) {
                    let row = table.rows[i];
                    addedFoodsCompleteInfo.push({"fb_id": row.cells[0].innerHTML, "foodName": row.cells[1].innerHTML, "uniPr": row.cells[2].innerHTML, "foodQty": row.cells[3].getElementsByTagName('input')[1].value});
                }

                createCookie('foodsSelected', JSON.stringify(addedFoodsCompleteInfo), '1');

                window.location = 'payment.php';
            });

            function handleChange(input) {
                if (input.value < 0)
                    input.value = 0;
                if (input.value > 10)
                    input.value = 10;
            }


        </script>



    </body>
</html>
