
<?php

if (isset($_POST['action'])) {
    if ($_POST['action'] == "test") {
        test();
    }
    if ($_POST['action'] == "function2") {
        func2();
    }
    if ($_POST['action'] == "function3") {
        func3();
    }
    if ($_POST['action'] == "function4") {
        func4();
    }
}

function test() {
    echo "<h1>TEST</h1>";
}

?>
