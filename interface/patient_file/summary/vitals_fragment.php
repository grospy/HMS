<?php

//include '/Applications/MAMP/htdocs/HMS/interface/patient_file/summary/upload.php';
//echo $target_dir;
//echo $path;
//echo "&nbsp;";
//echo $target_dir;

//echo $target_file;


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

    <p> .csv datanı buradan yüklə </p>
    <input type="file" name="fileToUpload" id="fileToUpload">

  <form action="SecondUpload.php" method="post" enctype="multipart/form-data">
  <input type="file" name="my-file" size="50" maxlength="25"> <br> 
  <input type="submit" name="upload" value="Upload">
 
</form>
&nbsp; &nbsp; &nbsp;
    <h4>Burada göstərilən pasientin kardiqramıdır. (Real Time)</h4>
    <p>
      No roll period.
    </p>
    <div id="baseballdiv" style="width:600px; height:320px;"></div>
   

    <script type="text/javascript" language= ”JavaScript”>
      g1 = new Dygraph(
          document.getElementById("baseballdiv"),'http://localhost:8888/HMS/interface/patient_file/summary/uploads/suzuki-mariners.txt',
          {
            //rollPeriod: 7,
            //showRoller: true

           // fractions: true,
           // errorBars: true,
           // showRoller: true,
           // rollPeriod: 15
/*
           legend: 'always',
          title: 'NYC vs. SF',
          showRoller: true,
          rollPeriod: 14,
          customBars: true,
          ylabel: 'Temperature (F)',
         */

      
        showRangeSelector: true

          }
      );
      /*
       <h2>Stock Chart demo</h2>
  <div id="stock_div" style="width: 600px; height: 320px;"></div>

      g = new Dygraph(document.getElementById("stock_div"),
        stockData,
        {
          customBars: true,
          logscale: true
        }); 

    function setLog(val) {
      g.updateOptions({ logscale: val });
      document.getElementById("linear").disabled = !val;
      document.getElementById("log").disabled = val;
    }*/
      
    </script>
  

    

        



       <h2> Istifadəçi fayyları ilə əməliyatlar şöbəsi : </h2> 

       

    <form action="upload.php" method="post" enctype="multipart/form-data">
  <p> <h4> Serverə yüklənilməsi üçün xəstə datasını seçin (ancaq .txt qəbul edilir): </h4>   <input type="file" name="fileToUpload" id="fileToUpload">   <br> <input type="submit" value="Datanı yüklə" name="submit"> <br>   </p>
    
    <h3> Recording a video for the doctor </h3>

</form>
<a href=" http://localhost:8888/HMS/HMSVideoAudio/index.html"> <button> Record audio & video for the doctor </button> </a>

  </body>
</html>



<?php


//retrieve most recent set of vitals.
$result=sqlQuery("SELECT FORM_VITALS.date, FORM_VITALS.id FROM form_vitals AS FORM_VITALS LEFT JOIN forms AS FORMS ON FORM_VITALS.id = FORMS.form_id WHERE FORM_VITALS.pid=? AND FORMS.deleted != '1' ORDER BY FORM_VITALS.date DESC", array($pid));
    
if (!$result) { //If there are no disclosures recorded
    ?>
  <span class='text'> <?php echo htmlspecialchars(xl("No vitals have been documented."), ENT_NOQUOTES);
?>



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
