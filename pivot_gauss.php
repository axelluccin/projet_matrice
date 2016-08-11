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
                echo "<h2>Pivot de gauss :</h2>";
                
                function produit($tabA, $tabB) {
                    $matA = $tabA;
                    $matB = $tabB;
                    $nblineA = count($tabA);
                    $nbcolumnB = count($tabB);

                    $i = 0;
                    while ($i < $nblineA) {
                        $k = 0;
                        while ($k <= ($nblineA - 1)) {
                            $j = 0;
                            while ($j <= ($nbcolumnB)) {
                                $res = $res + ($matA[$i][$j] * $matB[$j][$k]);
                                $j++;
                            }
                            $val[$i][$k] = $res;
                            $res = 0;
                            $k++;
                        }
                        $i++;
                    }
                    return ($val);
                }

                if (isset($_POST['pivot'])) {
                    
                    echo "<div id=pivot>
                <form method='post' action='pivot_gauss.php'>
                <h3> Matrice A </h3>
                <input type='hidden' name='pivot2' value='".$_POST['pivot']."' /> ";
                    $k = 0;
                    for ($i = 0; $i < $_POST['pivot']; $i++) {
                        for ($j = 0; $j < $_POST['pivot']; $j++) {
                            echo "<input type='number' name='" . $i . $j . "A' required>";
                            $k++;
                        }
                        echo "<br/>";
                    }
                    echo "<h3> Matrice Y </h3>";
                    for ($l = 0; $l < $_POST['pivot']; $l++) {

                        echo "<input type='number' name='" . $l . "Y' required>";

                        echo "<br/>";
                    }
                    echo "<input class='btn btn-lg btn-primary' style='float: right;' type='submit' value='Valider'>
                </from>
                </div>";
                }

                if (isset($_POST['00A'])) {
                    for ($a = 0; $a < $_POST['pivot2']; $a++) {
                        for ($b = 0; $b < $_POST['pivot2']; $b++) {
                            $matriceA[$a][$b] = $_POST[$a . $b . 'A'];
                        }
                    }
                    for ($l = 0; $l < $_POST['pivot2']; $l++) {
                        $matriceY[$l][0] = $_POST[$l . 'Y'];
                    }
                }
                
                if (isset($_POST['pivot2'])) {
// calcul G1
                    $i = 0;
                    $matriceG1 = array();
                    while ($i < count($matriceA)) {
                        $j = 0;
                        while ($j < count($matriceA[0])) {
                            if ($j == 0) {
                                $matriceG1[$i][$j] = -($matriceA[$i][$j] / $matriceA[$j][$j]);
                            } else {
                                $matriceG1[$i][$j] = 0;
                            }
                            $j++;
                        }
                        $matriceG1[$i][$i] = 1;
                        $i++;
                    }

// Affichage G1
                    echo "Matrice G1 : ";
                    echo "<table style='border-collapse: collapse;'>";
                    for ($line = 0; $line < count($matriceG1); $line++) {
                        echo "<tr>";
                        for ($col = 0; $col < count($matriceG1[$line]); $col++) {
                            echo "<td style='padding: 10px 10px 10px 10px;border: 1px solid black;'>" . round($matriceG1[$line][$col], 2) . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";

// Calcul A2 Y2
                    $matriceA2 = produit($matriceG1, $matriceA);
                    $matriceY2 = produit($matriceG1, $matriceY);
                
// affichage A2
                    echo "Matrice A2 : ";
                    echo "<table style='border-collapse: collapse;'>";
                    for ($line = 0; $line < count($matriceA2); $line++) {
                        echo "<tr>";
                        for ($col = 0; $col < count($matriceA2[$line]); $col++) {
                            echo "<td style='padding: 10px 10px 10px 10px;border: 1px solid black;'>" . round($matriceA2[$line][$col], 2) . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";

// affichage Y2
                    echo "Matrice Y2 : ";
                    echo "<table style='border-collapse: collapse;'>";
                    for ($line = 0; $line < count($matriceY2); $line++) {
                        echo "<tr>";
                        for ($col = 0; $col < 1; $col++) {
                            echo "<td style='padding: 10px 10px 10px 10px;border: 1px solid black;'>" . round($matriceY2[$line][$col], 2) . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";

//Solution systeme odre 2
                    if ((int) $_POST['pivot2'] == 2) {
                        if (($matriceA2[1][1] == 0) || ($matriceA2[0][0] == 0)) {
                            echo "Division par 0 impossible, votre système n'est pas valide !";
                        } else {
                            $x2 = round($matriceY2[1][0] / $matriceA2[1][1], 2);
                            $x1 = round(($matriceY2[0][0] - ($matriceA2[0][1] * $x2)) / $matriceA2[0][0], 2);
                            echo "L'ensemble des solutions du système (S) est donc {({$x1},{$x2})}.";
                        }
                    }

// si n = 3, besoin G2 A3 Y3
                    if ((int) $_POST['pivot2'] >= 3) {
// calcul G2
                        $i = 0;
                        $matriceG2 = array();
                        while ($i < count($matriceA2)) {
                            $j = 0;
                            while ($j < count($matriceA2[0])) {
                                if (($j == 1) && ($i > 1)) {
                                    $matriceG2[$i][$j] = -($matriceA2[$i][$j] / $matriceA2[$j][$j]);
                                } else {
                                    $matriceG2[$i][$j] = 0;
                                }
                                $j++;
                            }
                            $matriceG2[$i][$i] = 1;
                            $i++;
                        }

//affichage G2
                        echo "Matrice G2 : ";
                        echo "<table style='border-collapse: collapse;'>";
                        for ($line = 0; $line < count($matriceG2); $line++) {
                            echo "<tr>";
                            for ($col = 0; $col < count($matriceG2[$line]); $col++) {
                                echo "<td style='padding: 10px 10px 10px 10px;border: 1px solid black;'>" . round($matriceG2[$line][$col], 2) . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";

// Calcul A3 Y3
                        $matriceA3 = produit($matriceG2, $matriceA2);
                        $matriceY3 = produit($matriceG2, $matriceY2);

// affichage A3
                        echo "Matrice A3 : ";
                        echo "<table style='border-collapse: collapse;'>";
                        for ($line = 0; $line < count($matriceA3); $line++) {
                            echo "<tr>";
                            for ($col = 0; $col < count($matriceA3[$line]); $col++) {
                                echo "<td style='padding: 10px 10px 10px 10px;border: 1px solid black;'>" . round($matriceA3[$line][$col], 2) . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";

// affichage Y3
                        echo "Matrice Y3 : ";
                        echo "<table style='border-collapse: collapse;'>";
                        for ($line = 0; $line < count($matriceY3); $line++) {
                            echo "<tr>";
                            for ($col = 0; $col < 1; $col++) {
                                echo "<td style='padding: 10px 10px 10px 10px;border: 1px solid black;'>" . round($matriceY3[$line][$col], 2) . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
//Solution systeme odre 3
                    if ((int) $_POST['pivot2'] == 3) {
                        if (($matriceA3[2][2] == 0) || ($matriceA3[1][1] == 0) || ($matriceA3[0][0] == 0)) {
                            echo "Division par 0 impossible, votre système n'est pas valide !";
                        } else {
                            $x3 = round($matriceY3[2][0] / $matriceA3[2][2], 2);
                            $x2 = round(($matriceY3[1][0] - ($matriceA3[1][2] * $x3)) / $matriceA3[1][1], 2);
                            $x1 = round(($matriceY3[0][0] - ($matriceA3[0][2] * $x3) - ($matriceA3[0][1] * $x2)) / $matriceA3[0][0], 2);
                            echo "L'ensemble des solutions du système (S) est donc {({$x1},{$x2},{$x3})}.";
                        }
                    }

// si n = 3, besoin G3 A4 Y4
                    if ((int) $_POST['pivot2'] == 4) {
//calcul G3
                        $i = 0;
                        $matriceG3 = array();
                        while ($i < count($matriceA3)) {
                            $j = 0;
                            while ($j < count($matriceA3[0])) {
                                if (($j == 2) && ($i > 2)) {
                                    $matriceG3[$i][$j] = -($matriceA3[$i][$j] / $matriceA3[$j][$j]);
                                } else {
                                    $matriceG3[$i][$j] = 0;
                                }
                                $j++;
                            }
                            $matriceG3[$i][$i] = 1;
                            $i++;
                        }
//affichage G3
                        echo "Matrice G3 : ";
                        echo "<table style='border-collapse: collapse;'>";
                        for ($line = 0; $line < count($matriceG3); $line++) {
                            echo "<tr>";
                            for ($col = 0; $col < count($matriceG3[$line]); $col++) {
                                echo "<td style='padding: 10px 10px 10px 10px;border: 1px solid black;'>" . round($matriceG3[$line][$col], 2) . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";

// Calcul A4 Y4
                        $matriceA4 = produit($matriceG3, $matriceA3);
                        $matriceY4 = produit($matriceG3, $matriceY3);

// affichage A4
                        echo "Matrice A4 : ";
                        echo "<table style='border-collapse: collapse;'>";
                        for ($line = 0; $line < count($matriceA4); $line++) {
                            echo "<tr>";
                            for ($col = 0; $col < count($matriceA4[$line]); $col++) {
                                echo "<td style='padding: 10px 10px 10px 10px;border: 1px solid black;'>" . round($matriceA4[$line][$col], 2) . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";

// affichage Y4
                        echo "Matrice Y4 : ";
                        echo "<table style='border-collapse: collapse;'>";
                        for ($line = 0; $line < count($matriceY4); $line++) {
                            echo "<tr>";
                            for ($col = 0; $col < 1; $col++) {
                                echo "<td style='padding: 10px 10px 10px 10px;border: 1px solid black;'>" . round($matriceY4[$line][$col], 2) . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";

//Solution systeme odre 4
                        if (($matriceA4[3][3] == 0) || ($matriceA4[2][2] == 0) || ($matriceA4[1][1] == 0) || ($matriceA4[0][0] == 0)) {
                            echo "Division par 0 impossible, votre système n'est pas valide !";
                        } else {
                            $x4 = round($matriceY4[3][0] / $matriceA4[3][3], 2);
                            $x3 = round(($matriceY4[2][0] - ($matriceA4[2][3] * $x4)) / $matriceA4[2][2], 2);
                            $x2 = round(($matriceY4[1][0] - ($matriceA4[1][3] * $x4) - ($matriceA4[1][2] * $x3)) / $matriceA4[1][1], 2);
                            $x1 = round(($matriceY4[0][0] - ($matriceA4[0][3] * $x4) - ($matriceA4[0][2] * $x3) - ($matriceA4[0][1] * $x2)) / $matriceA4[0][0], 2);
                            echo "L'ensemble des solutions du système (S) est donc {({$x1},{$x2},{$x3},{$x4})}.";
                        }
                    }
                }
                ?>

            </div>

        </div>
    </body>
</html>