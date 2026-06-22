<!-- 
Opdracht 3: Type Controle zonder loops
Schrijf een PHP-script dat een array met verschillende waarden bevat (bijv. een integer, een float en een string). 
Gebruik de functies is_int(), is_float(), en is_double() om het type van elke waarde afzonderlijk te controleren en geef de resultaten weer.
Deze opdracht kan vrij pittig zijn, maar er wordt van je verwacht je ook onderzoek gaat doen als je iets niet snapt of weet.
-->
<?php
        $a = array("string", 1, 2.45);
        
        echo 'int? <br>';
        var_dump($a[0], is_int($a[0]), $a[1], is_int($a[1]), $a[2], is_int($a[2]));
        echo '<br> float? <br>';
        var_dump($a[0], is_float($a[0]), $a[1], is_float($a[1]), $a[2], is_float($a[2]));
        echo '<br> string? <br>';
        var_dump($a[0], is_string($a[0]), $a[1], is_string($a[1]), $a[2], is_string($a[2]));
        


    ?>