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

    if ($_POST['matrice'] == "somme" ) {
        echo "<h2> Somme :</h2><form method='post' action='somme.php'>
            <h3> Matrice A </h3>
            <p> Ligne : <input type='number' min=1 max=5 name='ligneA'> Colonne : <input type='number' min=1 max=5 name='colonneA'><br/></p>
            <h3> Matrice B </h3>
            <p> Ligne : <input type='number' min=1 max=5 name='ligneB'> Colonne : <input type='number' min=1 max=5 name='colonneB'><br/></p>
            <input class='btn btn-lg btn-primary' style='float: right;' type='submit' value='Valider'>
            </form>";
    }
    elseif ($_POST['matrice'] == "produit" ) {
        echo "<h2> Produit :</h2><form method='post' action='produit.php'>
            <h3> Matrice A </h3>
            <p> Ligne : <input type='number' min=1 max=5 name='ligneA'> Colonne : <input type='number' min=1 max=5 name='colonneA'><br/></p>
            <h3> Matrice B </h3>
            <p> Ligne : <input type='number' min=1 max=5 name='ligneB'> Colonne : <input type='number' min=1 max=5 name='colonneB'><br/></p>
            <input class='btn btn-lg btn-primary' style='float: right;' type='submit' value='Valider'>
            </form>";
    }
    elseif ($_POST['matrice'] == "transposée") {
        echo "<h2> Transposée :</h2><form method='post' action='transpose.php'>
            <h3> Matrice A </h3>
            <p> Ligne : <input type='number' min=1 max=5 name='ligneA'> Colonne : <input type='number' min=1 max=5 name='colonneA'><br/></p>
            <input class='btn btn-lg btn-primary' style='float: right;' type='submit' value='Valider'>
            </form>";
    }
    elseif($_POST['matrice'] == "trace") {
        echo "<h2> Trace :</h2><form method='post' action='trace.php'>
            <h3> Matrice A </h3>
            <p> Ligne : <input type='number' min=1 max=5 name='ligneA'> Colonne : <input type='number' min=1 max=5 name='colonneA'><br/></p>
            <input class='btn btn-lg btn-primary' style='float: right;' type='submit' value='Valider'>
            </form>";
    }
    elseif($_POST['matrice'] == "pivot") {
        echo "<h2> Pivot de gauss :</h2><form method='post' action='pivot_gauss.php'>
                <p>Nombre d'équation du système : n = <input type='number' min=2 max=4 name='pivot'/>
                <br/>
                <input class='btn btn-lg btn-primary' style='float: right;' type='submit' value='Valider'>
                </form>";
    }
    else{
        echo "<p> Erreur de données</p>";
    }
    echo "<br/><br/><br/>
                    <FORM>
                    <INPUT TYPE='BUTTON' VALUE=' Retour à accueil ' class='btn btn-primary' onClick=javascript:document.location.href='index.php'>
                </FORM>";
?>
</br>
</div>
</div>
    </body>
</html>