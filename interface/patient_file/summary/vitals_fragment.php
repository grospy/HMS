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
          document.getElementById("noroll"),
          data_temp,
          {
            customBars: true,
            title: 'The normal vs real cardiogramm of the patient.',
            ylabel: 'BPM(Beats Per Minute)',
            legend: 'always',
            showRangeSelector: true
          }
      );
      g2 = new Dygraph(
          document.getElementById("roll14"),
          data_temp,
          {
            rollPeriod: 14,
            showRoller: true,
            customBars: true,
            title: 'Daily Temperatures in New York vs. San Francisco',
            ylabel: 'Temperature (F)',
            legend: 'always',
            xAxisHeight: 14,
            showRangeSelector: true,
            rangeSelectorHeight: 80,
            rangeSelectorPlotStrokeColor: 'purple',
            rangeSelectorPlotFillColor: 'black',
            rangeSelectorBackgroundStrokeColor: 'orange',
            rangeSelectorBackgroundLineWidth: 4,
            rangeSelectorPlotLineWidth: 5,
            rangeSelectorForegroundStrokeColor: 'brown',
            rangeSelectorForegroundLineWidth: 8,
            rangeSelectorAlpha: 0.5,
            rangeSelectorPlotFillGradientColor: 'red'
          }
      );
      g3 = new Dygraph(
          document.getElementById("selectcombined"),
          [
            [0, 1, 4, 10],
            [10, 2, 8, 19],
            [25, 15, 4, 2],
            [35, 0, 3, 2]
          ],
          {
            title: 'Daily Temperatures in New York vs. San Francisco',
            ylabel: 'Temperature (F)',
            showRangeSelector: true,
            labels: ['X', 'Y1', 'Y2', 'Y3'],
            series: {
              'Y1': { showInRangeSelector: true }
            }
          }
      );
      g4 = new Dygraph(
          document.getElementById("nochart"),
          [[0,1],[10,1]],
          {
            xAxisHeight: 30,
            axes : {
              x : {
                drawAxis : false
              }
            },
            labels: ['X', 'Y'],
            showRangeSelector: true,
            rangeSelectorHeight: 30
          }
      );
      g5 = new Dygraph(
          document.getElementById("darkbg1"),
          data_temp,
          {
              rollPeriod: 14,
              showRoller: true,
              customBars: true,
              title: 'Nightly Temperatures in NY vs. SF',
              ylabel: 'Temperature (F)',
              legend: 'always',
              showRangeSelector: true,
              rangeSelectorPlotFillColor: 'MediumSlateBlue',
              rangeSelectorPlotFillGradientColor: 'rgba(123, 104, 238, 0)',
              colorValue: 0.9,
              fillAlpha: 0.4
          }
      );
      g6 = new Dygraph(
          document.getElementById("darkbg2"),
          data_temp,
          {
              rollPeriod: 14,
              showRoller: true,
              customBars: true,
              title: 'Nightly Temperatures in NY vs. SF',
              ylabel: 'Temperature (F)',
              legend: 'always',
              showRangeSelector: true,
              rangeSelectorPlotFillColor: 'MediumSlateBlue',
              colorValue: 0.9,
              fillAlpha: 0.4
          }
      );
      g7 = new Dygraph(document.getElementById("stepplot"),
                      "Date,Idle,Used\n" +
                      "2008-05-07,70,30\n" +
                      "2008-05-08,42,88\n" +
                      "2008-05-09,88,42\n" +
                      "2008-05-10,33,37\n" +
                      "2008-05-11,30,35\n",
                       {
                          stepPlot: true,
                          fillGraph: true,
                          stackedGraph: true,
                          includeZero: true,
                          showRangeSelector: true
                       });
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

 echo "<script type='text/javascript'>
                alert('JavaScript is awesome!');
            </script>";
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
