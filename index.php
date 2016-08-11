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
        <h2>Faites votre choix :</h2>
         
        <form name="choice" method="post" action="sommaire.php">
        <p>
         <input type="radio" name="matrice" value="somme" > Somme<br/>
            <input type="radio" name="matrice" value="produit" > Produit<br/>
            <input type="radio" name="matrice" value="transposée"> Transposée<br/>
            <input type="radio" name="matrice" value="trace" > Trace<br/>
            <input type="radio" name="matrice" value="pivot"> Pivot de gauss<br/><br/>
        </p>
        
          <input class="btn btn-lg btn-primary" style="float: right;" type="submit" value="Valider">
        
        </form>
        </br>
      </div>

    </div>
       
    </body>
</html>