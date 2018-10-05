<?php
/*******************************************************************************\
 * Copyright (C) Brady Miller (brady.g.miller@gmail.com)                                *
 *                                                                              *
 * This program is free software; you can redistribute it and/or                *
 * modify it under the terms of the GNU General Public License                  *
 * as published by the Free Software Foundation; either version 2               *
 * of the License, or (at your option) any later version.                       *
 *                                                                              *
 * This program is distributed in the hope that it will be useful,              *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of               *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                *
 * GNU General Public License for more details.                                 *
 *                                                                              *
 * You should have received a copy of the GNU General Public License            *
 * along with this program; if not, write to the Free Software                  *
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.  *
 ********************************************************************************/


require_once("../../globals.php");

?>
<div id='vitals' style='margin-top: 3px; margin-left: 10px; margin-right: 10px'><!--outer div-->
<br>

<html>
  <head>
    <link rel="stylesheet" href="http://localhost:8888/HMS/dygraphs/dist/dygraph.css">
    <title>Temperatures with Range Selector</title>
    <script type="text/javascript" src="http://localhost:8888/HMS/dygraphs/dist/dygraph.js"></script>

    <script type="text/javascript" src="http://localhost:8888/HMS/dygraphs/tests/data.js"></script>
    <style type="text/css">
    #bordered {
      border: 1px solid red;
    }
    #dark-background {
      background-color: #101015;
      color: white;
    }
    #darkbg1 .dygraph-axis-label, #darkbg2 .dygraph-axis-label {
      color: white;
    }
    #noroll .dygraph-legend,
    #roll14 .dygraph-legend,
    #darkbg1 .dygraph-legend,
    #darkbg2 .dygraph-legend {
      text-align: right;
    }
    #darkbg1 .dygraph-legend {
      background-color: #101015;
    }
    #darkbg2 .dygraph-legend {
      background-color: #101015;
    }
    </style>
  </head>
  <body>
    <p>Burada göstərilən pasientin kardiqramıdır. (Real Time)</p>
    <p>
      No roll period.
    </p>
    <div id="noroll" style="width:800px; height:320px;"></div>

    

    <script type="text/javascript" language= ”JavaScript”>
      g1 = new Dygraph(
          document.getElementById("noroll"),"http://localhost:8888/HMS/interface/patient_file/summary/temperatures.csv",
          {
            rollPeriod: 7,
            showRoller: true
          }
      );
      
    </script>
  </body>
</html>



<?php
//retrieve most recent set of vitals.
$result=sqlQuery("SELECT FORM_VITALS.date, FORM_VITALS.id FROM form_vitals AS FORM_VITALS LEFT JOIN forms AS FORMS ON FORM_VITALS.id = FORMS.form_id WHERE FORM_VITALS.pid=? AND FORMS.deleted != '1' ORDER BY FORM_VITALS.date DESC", array($pid));
    
if (!$result) { //If there are no disclosures recorded
    ?>
  <span class='text'> <?php echo htmlspecialchars(xl("No vitals have been documented."), ENT_NOQUOTES);
?>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Yüklənilməsi üçün faylı seçin:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

  </span> 
<?php
} else {
?> 
  <span class='text'><b>
    <?php echo htmlspecialchars(xl('Most recent vitals from:')." ".$result['date'], ENT_NOQUOTES); ?>
  </b></span>
  <br />
  <br />
    <?php include_once($GLOBALS['incdir'] . "/forms/vitals/report.php");
    call_user_func("vitals_report", '', '', 2, $result['id']);
    ?>  <span class='text'>
  <br />
  <a href='../encounter/trend_form.php?formname=vitals' onclick='top.restoreSession()'><?php echo htmlspecialchars(xl('Click here to view and graph all vitals.'), ENT_NOQUOTES);?></a>
  </span><?php
} ?>
<br />
<br />
</div>
