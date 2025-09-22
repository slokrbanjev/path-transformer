<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Path Transformer - Mac - Windows - TT Consulting</title>
</head>
<?php

//when submit-button is pressed!
if (isset($_POST['submitbutton-mac'])) {
    //html values in variables
    $mac = $_POST['mac-pfad'];
    //variables
    $result = ""; //final result
    $fehler = "FEHLER!!!";




    if (!empty($_POST['server-choose'])) {
        $serverChoose = $_POST['server-choose'];
        $result = ""; //no errror
    } else {
        echo 'Please select.';
        $result = $fehler;
    }


    // use of explode
    $string = $mac;
    $str_arr = explode("/", $string);
    //print_r($str_arr);



    //checks of user input -> server-choose
    if ($serverChoose == 1) {
        $serverChoose = "office.local";
    }
    if ($serverChoose == 2) {
        $serverChoose = "daten.local";
    }
    if ($serverChoose == 3) {
        $serverChoose = "fotoserver.local";
    }

    $check = strcmp($result, $fehler);
    //  print_r($check);

    if ($check !== 0) {
        //if "Volumes" or "volume1" -> MAC or NAS-standard
        if ((array_search('Volumes', $str_arr)) or (array_search('volume1', $str_arr)) or (str_contains($string, '/'))) {
            $str_arr[1] = $serverChoose;
            $result = (implode("\\", $str_arr));
            $result = substr($result, 0);
            $result = '\\'  . "" . $result;
        } else {
            $result = $fehler;
        }
    }
}

//when submit-button is pressed!
if (isset($_POST['submitbutton-win'])) {
    $win = $_POST['win-pfad'];
    $praefix = $_POST['praefix'];
    //variables
    $resultm = ""; //final result
    $fehler = "FEHLER!!!";
    //$resultm = $fehler;

    //import selected values
    if (!empty($_POST['path-format'])) {
        $pathFormat = $_POST['path-format'];
        $resultm = ""; //no errror
    } else {
        echo 'Please select.';
    }

    // use of explode
    $string = $win;
    $str_arr = explode("\\", $string);
    // print_r($str_arr);

    if ((array_search('office.local', $str_arr)) or (array_search('daten.local', $str_arr)) or (array_search('fotoserver.local', $str_arr))) {
        
        //checks of user input -> path-format
        if ($pathFormat == 1) {
            $pathFormat = "Volumes";
        }
        if ($pathFormat == 2) {
            $pathFormat = "volume1";
        }

        //$check = strcmp($resultm, $fehler);
        // print_r($check);


        // use of implode
        $str_arr[2] = $pathFormat;
        $resultm = (implode("/", $str_arr));
        $resultm = substr($resultm, 1);
        if ($pathFormat !== 0) {
            if (str_contains($pathFormat, 'volume1')){
                $resultm = substr($resultm, 8);
                $resultm = "" . $resultm;
            }else{
                $resultm = "" . $resultm;
            }
        }
        //print_r($str_arr);
    }
    else{
        $resultm = "" . $fehler;
    }
}
?>

<body>
    <!-- FORMULAR MAC OS -->
    <div class="container">
        <div class="container d-flex justify-content-center">
            <img src="logos/nas.ico" alt="" class="rounded float-left" width="100px">
            <img src="logos/slash.png" alt="" class="rounded float-left" height="100px">
            <img src="logos/mac-os-vector-logo.png" alt="" class="rounded float-left" width="100px">
            <img src="logos/arrow-right.png" alt="" class="rounded float-left" width="100px">
            <img src="logos/Windows_logo_and_wordmark_-_2012–2021.svg.png" alt="" class="rounded float-right" width="100px">
        </div>
        <div class="container">
            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="formular-mac" id="formular-mac">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="mac-pfad">MAC/Unix Pfad:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="mac-pfad" id="mac-pfad" placeholder="Pfad einsetzen">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="server-choose">Server auswählen</label>
                    <select multiple class="form-control col-sm-10" id="server-choose" name="server-choose" required>
                        <option value="1">-- OFFICE --</option>
                        <option value="2">-- DATEN --</option>
                        <option value="3">-- FOTOSERVER --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="result">Dein Pfad in Windows:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="result" name="result" value="<?php echo (isset($result)) ? $result : ''; ?>" placeholder="Ausgabe Pfad in Windows" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submitbutton-mac" id="submitbutton-mac" class="btn btn-default">Umwandeln in WIN-PFAD</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- ENDE FORMULAR MAC OS -->
    <div class="container">
        <div class="container d-flex justify-content-center">
            <img src="logos/trennlinie.png" alt="" class="rounded float-right" width="600px">
        </div>
    </div>

    <!-- FORMULAR WINDOWS -->
    <div class="container">
        <div class="container d-flex justify-content-center">
            <img src="logos/Windows_logo_and_wordmark_-_2012–2021.svg.png" alt="" class="rounded float-right" width="100px">
            <img src="logos/arrow-right.png" alt="" class="rounded float-left" width="100px">
            <img src="logos/nas.ico" alt="" class="rounded float-left" width="100px">
            <img src="logos/slash.png" alt="" class="rounded float-left" height="100px">
            <img src="logos/mac-os-vector-logo.png" alt="" class="rounded float-left" width="100px">
        </div>
        <div class="container">
            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="formular-win" id="formular-win">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="mac-pfad">WIN Pfad:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="win-pfad" id="win-pfad" placeholder="Pfad einsetzen">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="path-format">PFAD-Format bzw. Präfix auswählen:</label>
                    <select multiple class="form-control col-sm-10" id="path-format" name="path-format" required>
                        <option value="1">1 - Volumes -> MAC</option>
                        <option value="2">2 - volume1 -> NAS (source, from preferences)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="result">Dein Pfad in MAC:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="result" name="result" value="<?php echo (isset($resultm)) ? $resultm : ''; ?>" placeholder="Ausgabe Pfad in MAC" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submitbutton-win" id="submitbutton-win" class="btn btn-default">Umwandeln in MAC/Unix-PFAD</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- ENDE FORMULAR WINDOWS -->

</body>

</html>