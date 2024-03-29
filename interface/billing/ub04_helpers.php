<?php
/**
 * Helper for UB04 form.
 *
 */
require_once("../globals.php");
require_once("ub04_codes.inc.php");

$lookup = isset($_GET["code_group"]) ? filter_input(INPUT_GET, 'code_group') : "";
$term = isset($_GET["term"]) ? filter_input(INPUT_GET, 'term') : '';
if ($lookup != "") {
    lookup_codes($lookup, $term);
    exit();
}

// Falling through for user dialog.
$users = sqlStatementNoLog("SELECT id,fname,lname,npi,taxonomy FROM users WHERE " . "authorized=? AND active=?", array(1,1));
?>
<html>
<head>
<script>
function sendSelection(value)
{
    var parentId = <?php echo json_encode($_GET['formid']); ?>;
    //window.opener.updateValue(parentId, value);
    //window.close();
    updateProvider(parentId, value);
    eModal.close();
}
</script>
</head>
<body>
<table class="table table-striped">
    <thead>
        <tr>
            <th><?php echo xlt('Provider')?></th>
            <th><?php echo xlt('User Id') ?></th>
            <th><?php echo xlt('NPI') ?></th>
            <th><?php echo xlt('Taxonomy') ?></th>
        </tr>
    </thead>
    <tbody>
<?php
while ($row = sqlFetchArray($users)) {
    $data = json_encode($row);
?>
<tr>
    <td><button onclick='sendSelection(<?php echo $data;?>)'><?php echo text($row['fname'] . ' ' . $row['lname'])?></button></td>
    <td><?php echo text($row['id']) ?></td>
    <td><?php echo text($row['npi']) ?></td>
    <td><?php echo text($row['taxonomy']) ?></td>
 </tr>
<?php } ?>
</tbody>
</table>
</body>
</html>
<?php
function lookup_codes($group, $term)
{
    global $ub04_codes;
    $gotem = array();

    foreach ($ub04_codes as $k => $v) {
        if ($v['code_group'] != $group) {
            continue;
        }
        $s = "/" . $term . "/i";
        $label = $v['code'] . " : " . $v['desc'] . ($v['desc1'] ? (" :: " . $v['desc1']) : "");
        if (preg_match($s, $label)) {
            $gotem[] = array(
                'label' => htmlspecialchars($label, ENT_QUOTES),
                'value' => $v['code']
            );
        }
    }
    echo json_encode($gotem);
}
/**
 * Lookup lists
* @param lookup group string $group
* @param search string $term
*/
function get_codes_list($group, $term)
{
    $term = "%" . $term . "%";
    $response = sqlStatement("SELECT CONCAT_WS(': ', isc.code, isc.primary_desc, isc.desc1) as label, isc.code as value, isc.code_group as cg FROM inst_support_codes as isc
HAVING label LIKE ? And cg = ? ORDER BY code ASC", array($term, $group ));

    while ($row = sqlFetchArray($response)) {
        $resultpd[] = $row;
    }

    echo json_encode($resultpd);
}
