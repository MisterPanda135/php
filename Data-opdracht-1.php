<!-- 
Opdracht 1

Maak een var_dump() voor elk van de volgende datatypes:

    String:
        Maak een stringvariabele en gebruik var_dump() om de waarde weer te geven.

    Integer:
        Maak een integervariabele en gebruik var_dump().

    Float:
        Maak een floatvariabele en gebruik var_dump().

    Arrays:
        Maak drie verschillende arrays en gebruik var_dump() voor elk:
            Een array met alleen woorden (bijv. array("rood", "blauw", "groen")).
            Een array met alleen nummers (bijv. array(1, 2, 3)).
            Een array met een combinatie van woorden en nummers (bijv. array("appel", 2, "banaan", 3)).

Let op: Resources en objects zijn niet nodig voor deze opdracht.

Gebruik de onderstaande code als voorbeeld:

php

// Voorbeeld voor een string
$s = "Hallo";
var_dump($s);
-->
<?php
        $x = "string";
        $i = 23;
        $f = 33.33;
        $a1 = array("rood", "blauw", "groen");
        $a2 = array(1, 2, 3);
        $a3 = array("geel", 1, "blauw", 2);

        var_dump($x, $i, $f, $a1, $a2, $a3);
        


    ?>