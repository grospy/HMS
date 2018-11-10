<?php

?>

<script type="text/html" id="user-data-template">
    <!-- ko with: user -->
        <div id="username" class="appMenu">
            <div class="menuSection userSection">
                <div class='menuLabel' id="username" title="<?php echo xla('Current user') ?>">
                    <span data-bind="text:fname"></span>
                    <span data-bind="text:lname"></span>
                </div>
                <ul class="userfunctions menuEntries">
                    <li class="menuLabel" data-bind="click: editSettings"><?php echo xlt("Settings");?></li>
                    <li class="menuLabel" data-bind="click: changePassword"><?php echo xlt("Change Password");?></li>
                    <li class="menuLabel" data-bind="click: logout"><?php echo xlt("Logout");?></li>
                </ul>
            </div>
        </div>
    <!-- /ko -->
</script>
