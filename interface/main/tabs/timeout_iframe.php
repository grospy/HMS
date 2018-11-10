<?php


// Tell auth.inc that this is the daemon script; this is so that
// inactivity timeouts will still work, and to avoid logging an
// event every time we run.
$GLOBALS['DAEMON_FLAG'] = true;

require_once(dirname(__FILE__)) . "/../../globals.php";

$daemon_interval = 120; // Interval in seconds between reloads.
?>

<html>
<body>
<script type="text/javascript">

function timerint() {
    top.restoreSession();
    location.reload();
    return;
}

setTimeout('timerint()', <?php echo $daemon_interval * 1000; ?>);

</script>
</body>
</html>
