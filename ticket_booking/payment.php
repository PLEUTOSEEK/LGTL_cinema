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
        include "back_end/back_end.php";
        ?>

        <link rel="stylesheet" type="text/css" href="payment.css"/>


        <div class="container-fluid  ">
            <div class="container-fluid  col-lg-4 invoice-box rounded p-3 mt-2">
                <form>
                    <div class="container-fluid /*border border-success*/ col-12 ">

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0 font-weight-bold m-0 ">Movie Name</p>
                        </div>
                        <div class="row   rounded py-2 content-div mx-auto">
                            <p  class= " rounded px-3 py-2 mx-0  font-weight-bold m-0 content">Try</p>
                        </div>
                    </div>
                    <div class="container-fluid  /*border border-success*/ col-12">

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0 ">Location</p>
                        </div>
                        <div class="row  rounded py-2 content-div  mx-auto">
                            <p  class= " rounded px-3 py-2 mx-0  font-weight-bold m-0 content">Try</p>
                        </div>
                    </div>

                    <div class="container-fluid /*border border-success*/ col-12">

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0 ">Date & Time</p>
                        </div>
                        <div class="row   rounded py-2 content-div  mx-auto">
                            <p  class= " rounded px-3 py-2 mx-0  font-weight-bold m-0 content">Try</p>
                        </div>
                    </div>

                    <hr >
                    <div class="container-fluid /*border border-success*/ col-12">

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0">Adult Ticket</p>
                        </div>
                        <div class="row drag-zone  rounded content-div  mx-auto" id="qw1" ondrop="handleDrop(event);" ondragstart="onDragStart(event);"ondragover="onDragOver(event);">

                            <div draggable="true" class="box m-2" id="er1">                        <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D12" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form></div>
                            <div draggable="true" class="box m-2" id="er2">                        <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D13" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form></div>
                            <div draggable="true" class="box m-2" id="er3">
                                <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D14" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid /*border border-success*/ col-12">
                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0">Child Ticket</p>
                        </div>
                        <div class="row drag-zone  rounded content-div  mx-auto" id="qw2" ondrop="handleDrop(event);" ondragstart="onDragStart(event);" ondragover="onDragOver(event);">
                            <div draggable="true" class="box m-2" id="er4">                        <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D15" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form></div>
                            <div draggable="true" class="box m-2" id="er5">                        <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D16" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form></div>
                            <div draggable="true" class="box m-2" id="er6">
                                <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D17" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form>
                            </div>

                            <div draggable="true" class="box m-2" id="er7">
                                <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D17" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form>
                            </div>

                            <div draggable="true" class="box m-2" id="er8">
                                <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D17" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form>
                            </div>

                            <div draggable="true" class="box m-2" id="er9">
                                <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D17" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form>
                            </div>

                            <div draggable="true" class="box m-2" id="er14">
                                <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D17" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form>
                            </div>

                            <div draggable="true" class="box m-2" id="er10">
                                <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D17" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form>
                            </div>

                            <div draggable="true" class="box m-2" id="er11">
                                <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D17" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form>
                            </div>

                            <div draggable="true" class="box m-2" id="er12">
                                <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D17" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form>
                            </div>

                            <div draggable="true" class="box m-2" id="er13">
                                <form name = "foodInfo" class = "seat py-0 mx-auto" >
                                    <input type = "submit" value = "D17" class = "btn btn-outline-primary font-weight-bold" />
                                    <input type = "hidden" name = "col1" value = "" />
                                    <input type = "hidden" name = "col2" value = "" />
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr >
                    <div class="container-fluid /*border border-success*/ col-12">

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0">Food & Beverage</p>
                        </div>
                        <div class="row   rounded py-2 content-div  mx-auto">
                            <p  class= " rounded px-3 py-2 mx-0  font-weight-bold m-0 content">Try</p>
                        </div>
                    </div>

                    <div class="container-fluid /*border border-success*/ col-12">

                        <div class= "d-flex justify-content-start clearfix col-12 text-left px-0 py-3 ">
                            <p  class= "label rounded px-3 py-2 mx-0  font-weight-bold m-0">Total Price</p>
                        </div>
                        <div class="row   rounded py-2 content-div  mx-auto">
                            <p  class= " rounded px-3 py-2 mx-0  font-weight-bold m-0 content">Try</p>
                        </div>
                    </div>
                </form>
                <div class=" container-fluid justify-content-end align-items-right clearfix">
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

    <script src = "dragADrop.js" type="text/javascript"></script>

</body>
</html>
