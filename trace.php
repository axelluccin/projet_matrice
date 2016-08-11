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
      echo "<h2>Trace :</h2>";
    if(isset($_POST['ligneA']) && ($_POST['ligneA'] == $_POST['colonneA'])) {
        echo "<div id=produit>
                <form method='post' action='trace.php'>
                <h3> Matrice A </h3>";
        $k = 0;
        for($i = 0; $i < $_POST['ligneA']; $i++) {
            for($j = 0; $j < $_POST['colonneA']; $j++) {
                echo "<input type='text' name='".$i.$j."A' required>";
                $k++;
            }
            echo "<br/>";
        }
        echo "<input class='btn btn-lg btn-primary' style='float: right;' type='submit' value='Valider'>
                </from>
                </div>";
    }
    elseif(isset($_POST['00A'])) {           
        $ligneA  = 0;
        $number = true;
        while(isset($_POST[$ligneA."0A"]))
            $ligneA++;
        $i = 0;
        
        $resultat = 0;
        while($i != $ligneA) {
            if(is_numeric($_POST[$i.$i."A"]))
                $resultat = $resultat + $_POST[$i.$i."A"];
            else{
                $number = false;
                break;
            }
            $i++;
        }
        if($number){
            echo "<p>Resultat de la trace de la matrice :".$resultat."</p><br/><br/><br/>
                    <FORM>
                    <INPUT TYPE='BUTTON' VALUE=' Retour à accueil ' class='btn btn-primary' onClick=javascript:document.location.href='index.php'>
                </FORM>";
        }
        else{
            echo "<p>erreur lors de l'entrée des données !</p>
                    <FORM>
                        <INPUT TYPE='BUTTON' VALUE=' Retour ' class='btn btn-primary' onClick='history.back()'>
                    </FORM>";
        }
    }
    else{
       echo "<p>la trace n’est calculable que pour une matrice carrée</p>
        <FORM>
<INPUT TYPE='BUTTON' VALUE=' Retour ' class='btn btn-primary' onClick='history.back()'>
</FORM>";
    }
?>
 </div>
</div>
    </body>
</html>