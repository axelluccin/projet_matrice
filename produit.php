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
    echo "<h2>Produit :</h2>";
        if (isset($_POST['ligneA']) && isset($_POST['ligneB']) && (($_POST['colonneA'] == $_POST['ligneB']) || ($_POST['colonneA'] == 1 && $_POST['ligneA'] == 1)) ){
            echo "<div id=produit>
                    <form method='post' action='produit.php'>
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

        elseif(isset($_POST['00A']) && isset($_POST['00B'])){
            $ligneA  = 0;
            while(isset($_POST[$ligneA."0A"]))
                $ligneA++;
            $ligneB  = 0;
            while(isset($_POST[$ligneB."0B"]))
                $ligneB++;
            
            $colonneB = 0;
            while(isset($_POST["0".$colonneB."B"]))
                $colonneB++;
            $colonneA = 0;
            while(isset($_POST["0".$colonneA."A"]))
                $colonneA++;
            
            if(est_vraie($_POST, $ligneA, $colonneA, "A") && est_vraie($_POST, $ligneB, $colonneB, "B") && ($ligneA != 1 && $colonneA != 1)){
                echo "<div id='result' >
                        <h3> Resultat : </h3>
                        <table style='border-collapse: collapse;'>";           

                $resultat = 0;
                for($i = 0; $i < $ligneA; $i++) {  
                    echo "<tr>";
                    for($j =0; $j < $colonneB; $j++) {
                        $resultat = 0;
                        $k = 0;
                        while(isset($_POST[$i.$k."A"])) {
                            $resultat = $resultat + $_POST[$i.$k."A"] * $_POST[$k.$j."B"];
                            $k++;
                        }
                        echo "<td style='padding: 10px 10px 10px 10px;border: 1px solid black;'>".$resultat."</td>";
                    }
                    echo "</tr><br/>";
                }
                echo "</table>
                    </div><br/><br/><br/>
                    <FORM>
                    <INPUT TYPE='BUTTON' VALUE=' Retour à accueil ' class='btn btn-primary' onClick=javascript:document.location.href='index.php'>
                </FORM>";
            }
            /*elseif(est_vraie($_POST, $ligneA, $colonneA, "A") && est_vraie($_POST, $ligneB, $colonneB, "B") && ($ligneA == 1 && $colonneA == 1)){
                echo "<div id='result' >
                        <h3> Resultat : </h3>
                        <table style='border-collapse: collapse;'>";     
                for($i = 0; $i < $ligneB; $i++) {  
                    echo "<tr>";
                    $resultat = 0; 
                    for($j =0; $j < $colonneB; $j++) {  
                        $resultat = $_POST["00A"] * $_POST[$i.$j."B"];
                        echo "<td style='padding: 10px 10px 10px 10px;border: 1px solid black;'>".$resultat."</td>";
                    }
                    echo "</tr><br/>";
                }
                echo "</table>
                    </div><br/><br/><br/>
                    <FORM>
                    <INPUT TYPE='BUTTON' VALUE=' Retour à accueil ' class='btn btn-primary' onClick=javascript:document.location.href='index.php'>
                </FORM>";
            }*/
            else{
                echo "<p> Certaine(s) donnée(s) qui ont été entré ne sont pas valable(s) </p>
                        <FORM>
                        <INPUT TYPE='BUTTON' VALUE=' Retour ' class='btn btn-primary' onClick='history.back()'>
                        </FORM>";
            }
        }
        else {
            	 echo "<p> Produit AB non calculable. Le nombre de lignes de B doit être égal au nombre de colonnes de A </p>
                        <FORM>
                        <INPUT TYPE='BUTTON' VALUE=' Retour ' class='btn btn-primary' onClick='history.back()'>
                        </FORM>";
        }

        function est_vraie($tab, $ligne, $colonne, $l){
             for($i = 0; $i < $ligne; $i++) {
                    for($j = 0; $j < $colonne; $j++) {
                        if(!(is_numeric($tab[$i.$j.$l])))
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