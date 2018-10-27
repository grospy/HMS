<?php
/**
 * Batch list processor, included from batchcom
 *
 */

require_once("../globals.php");
use OpenEMR\Core\Header;

?>
<html>
<head>
<title><?php echo xlt("Phone Call List"); ?></title>
<?php Header::setupHeader(); ?>
</head>
<body class="body_top container">
    <header class="row">
        <?php require_once("batch_navigation.php");?>
        <h1 class="col-md-12">
            <a href="batchcom.php"><?php echo xlt('Batch Communication Tool'); ?></a>
            <small><?php echo xlt('Phone Call List report'); ?></small>
        </h1>
    </header>
    <main class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <?php
                    foreach ([xlt('Name'),xlt('DOB'),xlt('Home'),xlt('Work'),xlt('Contact'),xlt('Cell')] as $header) {
                        echo "<th>$header</th>";
                    }
                    ?>
                </thead>
                <tbody>
                    <?php
                    while ($row = sqlFetchArray($res)) {
                        echo "<tr><td>";
                        echo text($row['title']). ' ' . text($row['fname']) . ' ' . text($row['lname']);
                        echo "</td><td>";
                        echo text($row['DOB']);
                        echo "</td><td>";
                        echo text($row['phone_home']);
                        echo "</td><td>";
                        echo text($row['phone_biz']);
                        echo "</td><td>";
                        echo text($row['phone_contact']);
                        echo "</td><td>";
                        echo text($row['phone_cell']);
                        echo "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
