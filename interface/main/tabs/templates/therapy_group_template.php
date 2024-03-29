<?php

?>

<script type="text/html" id="therapy-group-template">
    <div>
        <span class="patientDataColumn">
            <span style="float:left;"><a data-bind="click: viewTgFinder" href="#" class="btn btn-default btn-sm">
                <i class="fa fa-search" aria-hidden="true"></i>
            </a></span>
            <div class="patientInfo">
                <?php echo xlt("Group"); ?>:
                <!-- ko if: therapy_group -->
                    <a class="ptName" data-bind="click:refreshGroup,with: therapy_group" href="#">
                        <span data-bind="text: gname()"></span>
                        (<span data-bind="text: gid"></span>)
                    </a>
                <!-- /ko -->
                <!-- ko ifnot: therapy_group -->
                    <?php echo xlt("None");?>
                <!-- /ko -->
                <!-- ko if: therapy_group -->
                    <a class="btn btn-xs btn-link" href="#" data-bind="click:clearTherapyGroup" title="<?php echo xla("Clear") ?>">
                        <i class="fa fa-times"></i>
                    </a>
                <!-- /ko -->
            </div>
        </span>
        <span class="patientDataColumn">
        <!-- ko if: therapy_group -->
        <!-- ko with: therapy_group -->
            <a class="btn btn-xs btn-link" data-bind="click: clickNewGroupEncounter" href="#" title="<?php echo xla("New Encounter");?>">
                <i class="fa fa-plus"></i>
            </a>
            <div class="patientCurrentEncounter">
                <span><?php echo xlt("Open Encounter"); ?>:</span>
                <!-- ko if:selectedEncounter() -->
                    <a data-bind="click: refreshEncounter" href="#">
                        <span data-bind="text:selectedEncounter().date()"></span>
                        (<span data-bind="text:selectedEncounter().id()"></span>)
                    </a>
                <!-- /ko -->
                <!-- ko if:!selectedEncounter() -->
                    <?php echo xlt("None") ?>
                <!-- /ko -->
            </div>
            <!-- ko if: encounterArray().length > 0 -->
            <br>
            <div class="btn-group dropdown">
                <button class="btn btn-default btn-sm dropdown-toggle"
                        type="button" id="pastEncounters"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="true">
                    <?php echo xlt("View Past Encounters"); ?>&nbsp;
                    (<span data-bind="text:encounterArray().length"></span>)
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="pastEncounters">
                    <!-- ko foreach:encounterArray -->
                    <li style="display: inline-flex;">
                        <a href="#" data-bind="click:chooseEncounterEvent">
                            <span data-bind="text:date"></span>
                            <span data-bind="text:category"></span>
                        </a>
                        <a href="#" data-bind="click:reviewEncounterEvent">
                            <i class="fa fa-rotate-left"></i>&nbsp;<?php echo xlt("Review");?>
                        </a>
                    </li>
                    <!-- /ko -->
                </ul>
            </div>
            <!-- /ko -->
        <!-- /ko -->
        <!-- /ko -->
        </span>
        <!-- ko if: user -->
        <!-- ko with: user -->
        <!-- ko if:messages() -->
            <span class="messagesColumn">
                <a class="btn btn-default" href="#" data-bind="click: viewMessages" title="<?php echo xla("View Messages");?>">
                    <i class="fa fa-envelope"></i>&nbsp;<span style="display:inline" data-bind="text: messages()"></span>
                </a>
            </span>
        <!-- /ko -->
        <!-- /ko -->
        <!-- /ko -->
    </div>
    <!-- /ko -->
</script>
