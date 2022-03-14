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
        <?php
        include '../nav_bar/navigation_bar.php';
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
                                <th  scope="col">#</th>
                                <th  scope="col">First</th>
                                <th  scope="col">Last</th>
                                <th  scope="col">Handle</th>
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
                    $foodItem = array("ID" => "1001",
                        "Name" => "Sandwitch",
                        "Price" => "RM 1.50");

                    //1 need 12
                    //2 need 4
                    // 3 need 3
                    //
                    $totalCard = 32;

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

                    for ($x = 1; $x <= $totalCard; $x++) {
                        echo "<div class=\"card  col-lg-$cardSize col-md-4 col-$cardSizeSmall mx-4 px-0 my-3\" style=\"height: 23em;width: 17em;\">";
                        echo "<div style=\"height:60%;width:100%;background-color: #5f5f5f\">";
                        echo "<div class = \"card-img-top\" >";
                        echo "<img class = \"card-img-top\" src = \"images/food-sample.jpg\">";
                        echo "</div>";
                        echo "</div>";
                        echo " <div class = \"card-body\">";
                        echo "<h3 class = \"card-title\">" . $foodItem['Name'] . $x . "</h3>";
                        echo "<h5 class = \"card-title\">" . $foodItem['Price'] . $x . "</h5>";
                        echo "<form name = \"foodInfo\" class = \"food-obj py-0\" >";

                        echo "<input type = \"submit\" value = \"Add To Basket\" class = \"btn btn-outline-primary \" />";
                        //add whatever column you want here
                        echo "<input type = \"hidden\" name = \"col1\" value = \"" . $foodItem['Name'] . $x . "\" />";
                        echo "<input type = \"hidden\" name = \"col2\" value = \"" . $foodItem['Price'] . $x . "\" />";
                        echo "</form>";
                        echo " </div>";
                        echo "</div>";
                    }
                    ?>


                </div>

            </div>
            <select class="browser-default custom-select col-1 mx-5 ticket-type-drop-down">
                <option selected="">Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>

        <?php
        include '../nav_bar/footer.php';
        ?>

        <script >
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
                document.getElementById("food-table").deleteRow(index + 1);
            });

            $('.food-obj').on('submit', function (e) {
                e.preventDefault();
                const data = Object.fromEntries(new FormData(e.target).entries());
                console.log(data);


                // add to table row
                var table = document.getElementById("food-table");
                var foodRow = table.insertRow(1);
                var minPlusCtrl = "";

                var y = 0;
                for (var x = 0; x < 2; x++) {
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
