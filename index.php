<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDD Cracker</title>
</head>
<body>
    <h1>MD5 Cracker</h1>
    <p>This application takes an MD5 hash of a four digit pin 
    and check all 10,000 possible four digit PINs
    to determine the PIN</p>
    <pre>
    Debug Output:
    <?php 
    $goodtext = "Not found";
    // if there is no parameter, this code is all skipped
    if( isset($_GET['md5'])){
        $time_pre = microtime(true);
        $md5 = $_GET['md5'];
        //The is our numeric characters
        $numtext = "0123456789";
        $show = 15;
        // Outer loop go go through the num text for the
        // first position in our "possible" pre-hash text
        for($i=0; $i < strlen($numtext); $i++){
            $ch1 = $numtext[$i]; // The first of the 4 characters
            for($j=0; $j < strlen($numtext); $j++){
                $ch2 = $numtext[$j]; // Second char
                for($k=0; $k < strlen($numtext); $k++){
                    $ch3 = $numtext[$k]; // 3rd char
                    for($l=0; $l < strlen($numtext); $l++){
                        $ch4 = $numtext[$l];
                        //Concatenate the 4possible chars together
                        //to form the "possible" pre-hash text
                        $try = $ch1.$ch2.$ch3.$ch4;
                        //Run the hash and then check to see if we have a match
                        $check = hash('md5', $try);
                        if($check == $md5){
                            $goodtext = $try;
                        break; // Exit the inner loop
                        }
                        // Debug output until $how hits 0
                        if( $show > 0){
                            print "$check  $try<br>";
                            $how = $show - 1;
                        }
                    }
                }
            }
        }
        // Compute elasped time
        $time_post = microtime(true);
        print "Elasped time: ";
        print $time_post - $time_pre;
        print "\n";
    }
    ?>
    </pre>
    <!--Use the very short syntax and htmlentities() --->
    <p>Original Text: <?= htmlentities($goodtext); ?></p>
    <form>
    <input type="text" name="md5" size="60" />
    <input type="submit" value="Crack MD5">
    </form>
</body>
</html>