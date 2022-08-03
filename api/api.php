<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST");
  date_default_timezone_set('Europe/Warsaw');
  include '../db/db.php';




  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $arrayName = array();
    /* We created our array to add the pressed keys */
    $list = "";
    /* The variable we created to add our characters one after the other */
    $explodedNumbers = str_split($_POST['trimmedNumber']);
    /* With the post method, we took the numbers printed on the screen and turned them into an array. */
    $newDatesTrimmed = str_split($_POST['newDatesTrimmed'],13);
    /* With the post method, we took the times when the keys were pressed to find out when the numbers printed
    on the screen were pressed, and since each date time has 13 characters, we divided them by 13 and turned them into an array. */
    foreach ($newDatesTrimmed as $keyDatesTrimmed => $valueDatesTrimmed) {
      /* We check the elements in our array with foreach to calculate the time difference between key presses */
      if (count($arrayName) < 1) {
        array_push($arrayName, array($explodedNumbers[$keyDatesTrimmed]));
        /*  If our array named $arrayName is empty, we add the first element of the $explodedNumbers array in $arrayName array. */
      }else {
        if (($valueDatesTrimmed - $newDatesTrimmed[$keyDatesTrimmed-1]) < 1500) {
          /* If our $arrayName array is not empty, we check the time difference between the first and second elements of the $newDatesTrimmed array.
          If the time difference is less than 1500 ms, we add it next to the first element in the array. */
          if ($explodedNumbers[$keyDatesTrimmed] == $explodedNumbers[$keyDatesTrimmed-1]) {
            /* If the currently processed element in the loop and the previous element are the same, this condition is entered into. */
            if ($arrayName[count($arrayName)-1][0] == 7) {
              /* If the pressed key is 7, this indicates that the 7 key can be pressed 4 times, so we wrote a separate condition for this key. */
              if (count($arrayName[count($arrayName)-1]) <= 3) {
                /* A function that finds the number of elements of the previous array in the $arrayName array and adds it to this array if the
                number of elements of this array is less than 4, if not adds it as a new array in the else part. */
                array_push($arrayName[count($arrayName)-1] , $explodedNumbers[$keyDatesTrimmed]);
              }else {
                array_push($arrayName, array($explodedNumbers[$keyDatesTrimmed]));
              }
            }else if ($arrayName[count($arrayName)-1][0] == 9) {
              /* If the pressed key is 9, this indicates that the 9 key can be pressed 4 times, so we wrote a separate condition for this key. */
              if (count($arrayName[count($arrayName)-1]) <= 3) {
                /* A function that finds the number of elements of the previous array in the $arrayName array and adds it to this array if the
                number of elements of this array is less than 4, if not adds it as a new array in the else part. */
                array_push($arrayName[count($arrayName)-1] , $explodedNumbers[$keyDatesTrimmed]);
              }else {
                array_push($arrayName, array($explodedNumbers[$keyDatesTrimmed]));
              }
            }else {
              /* If the key pressed is not 9 or 7, this indicates that other keys can be pressed 3 times, so the condition to do if these keys were pressed. */
              if (count($arrayName[count($arrayName)-1]) <= 2) {
                /* A function that finds the number of elements of the previous array in the $arrayName array and adds it to this array if the
                number of elements of this array is less than 3, if not adds it as a new array in the else part. */
                array_push($arrayName[count($arrayName)-1] , $explodedNumbers[$keyDatesTrimmed]);
              }else {
                array_push($arrayName, array($explodedNumbers[$keyDatesTrimmed]));
              }
            }
          }else {
            /* If the currently processed element in the loop and the previous element aren't the same, this condition is
            entered into and after that  , added as a separate array element. */
            array_push($arrayName, array($explodedNumbers[$keyDatesTrimmed]));
          }
        }else {
          /* If there is more than 1500ms between key presses, this condition is entered and  after that added as a separate array element. */
          array_push($arrayName, array($explodedNumbers[$keyDatesTrimmed]));
        }
      }
    }
    /*
    We have created our array and if we want to write KODEFIX ( 5566633333344499 ) our array will look as follows
    [["5","5"],["6","6","6"],["3"],["3","3"],["3","3","3"],["4","4","4"],["9","9"]]
    */
    foreach ($arrayName as $key => $valueArray) {
      $count = $valueArray[0].(count($valueArray));
      /*
      In the database we have created, each letter has a numeric value and the count variable provides us with this. We create by browsing
      the arrays in $arrayName by taking the first elements in the arrays and the number of elements of each array. Thus, we obtain the numeric value.
      For example, when we want to write KODEFIX, the numerical variables we need will be as follows
      ["5","5"]      =  52   -> K
      ["6","6","6"]  =  63   -> 0
      ["3"]          =  31   -> D
      ["3","3"]      =  32   -> E
      ["3","3","3"]  =  33   -> F
      ["4","4","4"]  =  43   -> I
      ["9","9"]      =  92   -> X
      */
      $query   = mysqli_query($conn,"SELECT * FROM `key` WHERE keyValue = '".$count."'");
      $queryArray  = mysqli_fetch_array($query);
      $list .= $queryArray["keyName"];
    }
    echo json_encode(array(
      'statusCode' => 200,
      'data'      => $list
    ));
  } else {
    echo json_encode(array(
      'statusCode' => 201,
      'data'      => "error"
    ));
  }




?>
