<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Matrice</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    </head>

    <body> 
    
    <div class="container">
     
        
      <?php include('header.php'); ?>
       <div class="jumbotron">
    <?php
    echo "<h2>Somme :</h2>";
        if ((isset($_POST['ligneA']) && isset($_POST['ligneB'])) && ($_POST['ligneA'] == $_POST['ligneB'] && $_POST['colonneA'] == $_POST['colonneB'])){
            echo "<div id=produit>
                    <form method='post' action='somme.php'>
                    <h3> Matrice A </h3>";
            $k = 0;
            for($i = 0; $i < $_POST['ligneA']; $i++) {
                for($j = 0; $j < $_POST['colonneA']; $j++) {
                    echo "<input type='text' name='".$i.$j."A' required>";
                    $k++;
                }
                echo "<br/>";
            }
            $k = 0;
            echo "<h3> Matrice B </h3>";
            for($i = 0; $i < $_POST['ligneB']; $i++) {
                for($j = 0; $j < $_POST['colonneB']; $j++) {
                    echo "<input type='text' name='".$i.$j."B' required>";
                    $k++;
                }
                echo "<br/>";
            }
            echo "<input class='btn btn-lg btn-primary' style='float: right;' type='submit' value='Valider'>
                </from>
                </div>";
        }
        else if (isset($_POST['00A']) && isset($_POST['00B'])) {
            $ligneA = 0;
            while(isset($_POST[$ligneA."0A"]))
                $ligneA++;
            
            $colonneA = 0;
            while(isset($_POST["0".$colonneA."A"]))
                $colonneA++;
            
            if(est_vraie($_POST, $ligneA, $colonneA)){
                echo "<div id='result' >
                        <h3> Resultat : </h3>
                        <table style='border-collapse: collapse;'>";    

                for($i = 0; $i < $ligneA; $i++) {
                    echo "<tr>";
                    for($j = 0; $j < $colonneA; $j++) {
                        $resultat = $_POST[$i.$j."A"] + $_POST[$i.$j."B"];
                        echo "<td style='padding: 10px 10px 10px 10px;border: 1px solid black;'>".$resultat."</td>";

                    }
                    echo "</tr>";
                }
                echo "</table>
                        </div><br/><br/><br/>
                    <FORM>
                    <INPUT TYPE='BUTTON' VALUE=' Retour à accueil ' class='btn btn-primary' onClick=javascript:document.location.href='index.php'>
                </FORM>";
            }
            else{
                echo "<p> Certaine(s) donnée(s) qui ont été entré ne sont pas valable(s) </p>
                        <FORM>
                        <INPUT TYPE='BUTTON' VALUE=' Retour ' class='btn btn-primary' onClick='history.back()'>
                        </FORM>";
            }
        }
        else{
             echo "<p> Somme A + B non calculable. Les matrices A et B doivent être de même taille</p>
                    <FORM>
                    <INPUT TYPE='BUTTON' VALUE=' Retour ' class='btn btn-primary' onClick='history.back()'>
                    </FORM>";
            }


        function est_vraie($tab, $ligneA, $colonneA){
             for($i = 0; $i < $ligneA; $i++) {
                    for($j = 0; $j < $colonneA; $j++) {
                        if(!(is_numeric($tab[$i.$j."A"]) && is_numeric($tab[$i.$j."B"])))
                            return false;
                    }
             }
            return true;
        }
    ?>
    </div>
    </div>
    </body>
</html>
            