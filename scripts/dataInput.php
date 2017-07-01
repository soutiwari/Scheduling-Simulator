<?php

  try {

    $schedulingType = $_POST['schedulingType'];

    $selectAlgo = $_POST['selectAlgo'];


    $exeFile = $schedulingType.'/'.$selectAlgo.'.exe';

    $response = null;

    $filename = $selectAlgo.'input.txt';

    $file = fopen($filename, "w");

    if(!$file)
    {
      //print_r("Error opening file");
      exit();
    }

    $noOfJobs = $_POST['noOfJobs'];

    //print_r($noOfJobs);

    fwrite($file,$noOfJobs);

    fwrite($file,"\r\n");

    // for($i=1;$i<=$noOfJobs;$i++)
    // {
    //     fwrite($file,$_POST['Arrival'.$i]);
    //     fwrite($file,"\r\n");
    //     fwrite($file,$_POST['Finish'.$i]);
    //     fwrite($file,"\r\n");
    //     fwrite($file,$_POST['Period'.$i]);
    //     fwrite($file,"\r\n");
    // }


    /*   Input into file */

    if($schedulingType == 'NonRTS')
    {
        if($selectAlgo == 'RR')
        {
          fwrite($file,$_POST['TimeSlice']);
          fwrite($file,"\r\n");
        }

        for($i=1;$i<=$noOfJobs;$i++)
        {
            fwrite($file,$_POST['Arrival'.$i]);
            fwrite($file,"\r\n");
            fwrite($file,$_POST['Finish'.$i]);
            fwrite($file,"\r\n");
        }

    }elseif ($schedulingType == 'RTS')
    {
        if($selectAlgo == 'EDF')
        {
            for($i=1;$i<=$noOfJobs;$i++)
            {
                fwrite($file,$_POST['Arrival'.$i]);
                fwrite($file,"\r\n");
                fwrite($file,$_POST['Finish'.$i]);
                fwrite($file,"\r\n");
                fwrite($file,$_POST['Deadline'.$i]);
                fwrite($file,"\r\n");
            }
        }elseif ($selectAlgo == 'RM')
        {
            for($i=1;$i<=$noOfJobs;$i++)
            {
                fwrite($file,$_POST['Arrival'.$i]);
                fwrite($file,"\r\n");
                fwrite($file,$_POST['Finish'.$i]);
                fwrite($file,"\r\n");
                fwrite($file,$_POST['Period'.$i]);
                fwrite($file,"\r\n");
            }
        }elseif ($selectAlgo == 'DM')
        {
          for($i=1;$i<=$noOfJobs;$i++)
          {
              fwrite($file,$_POST['Arrival'.$i]);
              fwrite($file,"\r\n");
              fwrite($file,$_POST['Period'.$i]);
              fwrite($file,"\r\n");
              fwrite($file,$_POST['Finish'.$i]);
              fwrite($file,"\r\n");
              fwrite($file,$_POST['Deadline'.$i]);
              fwrite($file,"\r\n");
          }
        }elseif ($selectAlgo == 'LST')
        {
          for($i=1;$i<=$noOfJobs;$i++)
          {
              fwrite($file,$_POST['Arrival'.$i]);
              fwrite($file,"\r\n");
              fwrite($file,$_POST['Finish'.$i]);
              fwrite($file,"\r\n");
              fwrite($file,$_POST['Deadline'.$i]);
              fwrite($file,"\r\n");
          }
        }

    }elseif ($schedulingType == 'MultiProcessorRTS')
    {
        fwrite($file,$_POST['noOfNodes']);
        fwrite($file,"\r\n");

        if($selectAlgo == 'MultiEDF')
        {
          for($i=1;$i<=$noOfJobs;$i++)
          {
              fwrite($file,$_POST['Arrival'.$i]);
              fwrite($file,"\r\n");
              fwrite($file,$_POST['Finish'.$i]);
              fwrite($file,"\r\n");
              fwrite($file,$_POST['Deadline'.$i]);
              fwrite($file,"\r\n");
          }
        }elseif ($selectAlgo == 'MultiRM')
        {
          for($i=1;$i<=$noOfJobs;$i++)
          {
              fwrite($file,$_POST['Arrival'.$i]);
              fwrite($file,"\r\n");
              fwrite($file,$_POST['Finish'.$i]);
              fwrite($file,"\r\n");
              fwrite($file,$_POST['Period'.$i]);
              fwrite($file,"\r\n");
          }
        }
    }

    fclose($file);

    $command = 'C:/wamp/www/RTS/cpp'.'/'.$exeFile.' '.$filename;

    exec($command,$output);

  //  print_r($output);

    // $p1 = $output['1'];
    //
    // print_r($p1);
    //
    // $i = 0;
    //
    // while($i<strlen($p1))
    // {
    //   print_r("\r\n".$p1[$i]);
    //   $i++;
    // }

    $response = array("status"=>true,"output"=>$output);

  } catch (Exception $e) {

      $response = array("status"=>false, "errorMessage"=>$e->getMessage());

  }

header("Content-Type: application/json");
echo json_encode($response);

 ?>
