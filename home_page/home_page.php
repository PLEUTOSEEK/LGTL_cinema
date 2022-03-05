<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Hello, world!</title>
    </head>
    <body>
        <?php
        include '../nav_bar/navigation_bar.php';
        ?>


        <div class="col-lg-12 input-group mt-3 justify-content-center">
            <input type="search" class="form-control rounded mr-3 col-lg-4 srchBar" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-primary srchBtn ">search</button>
        </div>

        <?php
        include '../nav_bar/footer.php';
        ?>

    </body>
</html>
