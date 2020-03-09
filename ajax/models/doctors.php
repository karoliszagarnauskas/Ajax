<?php

// prisijungimas prie duomenu bazes
define('DB_HOST', 'localhost'); //define konstanta - nekintantis kintamasis
define('DB_MYSQL_USER', 'root');
define('DB_MYSQL_PASSWORD', 'root');
define('DB_NAME', 'hospital2');

$prisijungimas = mysqli_connect( DB_HOST, DB_MYSQL_USER, DB_MYSQL_PASSWORD, DB_NAME);
// jeigu MAMP'e pakeitet MYSQL porta is 3306 i kitoki, privalot ji nurodyti
//$prisijungimas = mysqli_connect( $DB_HOST, $DB_MYSQL_USER, $DB_MYSQL_PASSWORD, $DB_NAME, 3307);

if ($prisijungimas) {
    // echo "pavyko prisijungti prie DB <br>";
} else {
    echo "ERROR: nepavyko prisijungti prie DB:" . mysqli_connect_error($prisijungimas);
}
function getPrisijungimas() {
  global $prisijungimas; //isvardini globalisu kintamuosius kuriuos nori naudotif-jos viduje
  // globals $prisijungimas;    //!!! sioje eiluteje globaliu kint negalima keisti, bet zemiau negalima
  return $prisijungimas;
}
function deleteDoctor($nr){
  $manoSQL = "DELETE FROM doctors WHERE id = '$nr' LIMIT 1 ";
  $arPavyko = mysqli_query( getPrisijungimas(), $manoSQL);
  if (!$arPavyko == false) {    //!$arPavyko
    echo "ERROR nepavyko atelisti gydytojo nr: $nr <br>";
  }
}

// deleteDoctor(7);    //test

//$nr - id numeris duomenu bazeje
//irasysim i duomenu baze
//$vardas - gyv vardas
//$pavarde - gyv pavarde
//$zona - gyv zona kurioj dirba

function createDoctor($vardas, $pavarde, $zona){
  $manoSQL = "INSERT INTO  doctors VALUES(NULL, '$vardas','$pavarde','$zona') ";
  $arPavyko = mysqli_query( getPrisijungimas(), $manoSQL);
  if (!$arPavyko == false) {    //!$arPavyko
    echo "ERROR nepavyko sukurti gydytojo vardas: $vardas,$pavarde, $zona <br>";
  }
}

//test
// createDoctor("Jurgis", "Jurgaitis", "A3");
// createDoctor("Tadas", "Tadauskas", "B2");
function editDoctor($nr, $vardas, $pavarde, $zona) {
    $manoSQL = "UPDATE  doctors SET
                                    name= '$vardas',
                                    lastname = '$pavarde',
                                    area = '$zona'
                                WHERE id = '4'
                                LIMIT 1
                ";
    $arPavyko = mysqli_query( getPrisijungimas(),  $manoSQL  );
    if ( $arPavyko == false) {   // !$arPavyko
        echo "ERROR nepavyko redaguoti gydytojo nr:$nr, $vardas, $pavarde, $zona <br>";
    }
}
//test
// editDoctor(4,'Litas', 'Litaite',  'Z2');

/* paima gydytoja is //
$nr - gydytojo id is //
return - (type: ARRAY)
*/

function getDoctor( $nr ) {
    $manoSQL = "SELECT * FROM doctors  WHERE id = '$nr';  ";
    // $rezultataiOBJ -  Mysql Objektas
    $rezultataiOBJ = mysqli_query(getPrisijungimas(), $manoSQL);
    // ar radom gydytoja
    if (mysqli_num_rows($rezultataiOBJ) > 0) {     // print_r( $rezultataiOBJ ); // test
        // is Objekto paimam viena eilute ir paverciam i asociatyvu array
        $resultARRAY = mysqli_fetch_assoc( $rezultataiOBJ  );
        // print_r($resultARRAY); // test
        return $resultARRAY;
    } else {
        echo "Atleiskite , tokio gydytojo nera";
        return NULL;
    }

}
//test
// $gyd1 = getDoctor(1);
// print_r( $gyd1 );
function getDoctors(){
    $manoSQL = "SELECT * FROM doctors  ";
      $rezultataiOBJ = mysqli_query(getPrisijungimas(), $manoSQL);
      return $rezultataiOBJ;
}
$visiGyditojai = getDoctors();
   // is Myqsl obj. paima vina eilute ir pavecia i array.
$gydytojas1 = mysqli_fetch_assoc($visiGyditojai);
// $gydytojas2 = mysqli_fetch_assoc($visiGyditojai);
// $gydytojas3 = mysqli_fetch_assoc($visiGyditojai);
//gmp_test
// print_r($gydytojas1);
//---------------

while($gydytojas1){
  echo "<h2>".$gydytojas1['name'].$gydytojas1['lastname']."</h2>";
  $gydytojas1 = mysqli_fetch_assoc($visiGyditojai);

}
