<?php

/**
 * Дадена е низа со производи, која треба да се обработи со крајна цел да се добие и испечати низа која ќе ги задоволува следните услови:
 *
 * 1. Секој зеленчук треба да остане
 * 2. Само овошјето кое е поефтино од 10 денари треба да остане
 * 3. Само зачините кои почнуваат на буквата "К" треба да останат независно од дали буквата е голема или мала.
 *
 * На крај доколку сумата од цените на останатите продукти ви изнесува повеќе од 40 сортирајте ги производите по
 * цена во опаѓачки редослед и отстранете продукти почнувајќи од оние со најниска цена се додека вкупната сума не е еднаква или помала од 40
 */

$produkti = [
    "Banana" => [
        "vid" => "ovosje",
        "cena" => 8
    ],
    "jabolko" => [
        "vid" => "ovosje",
        "cena" => 11
    ],
    "Jagoda" => [
        "vid" => "ovosje",
        "cena" => 6
    ],
    "brokula" => [
        "vid" => "zelencuk",
        "cena" => 9
    ],
    "Morkov" => [
        "vid" => "zelencuk",
        "cena" => 14
    ],
    "kari" => [
        "vid" => "zacin",
        "cena" => 4
    ],
    "Kurkuma" => [
        "vid" => "zacin",
        "cena" => 6
    ],
    "bukovec" => [
        "vid" => "zacin",
        "cena" => 8
    ]
];

$niza = array(); // definiranje na prazna niza

foreach($produkti as $x => $y)
{
    if($produkti[$x]["vid"] == "zelencuk")      // dodavanje na zelencucite vo nizata
    {
       $niza[$x] = [ 
               "vid" => $produkti[$x]["vid"], 
               "cena" => $produkti[$x]["cena"]
            ];
    }
    else if($produkti[$x]["vid"] == "ovosje" && $produkti[$x]["cena"] < 10)     // dodavanje na ovosjata koi se poeftini od 10 vo nizata
    {
        $niza[$x] = [ 
               "vid" => $produkti[$x]["vid"], 
               "cena" => $produkti[$x]["cena"]
            ];
    }
    else if($produkti[$x]["vid"] == "zacin" && ($x[0] == 'k' || $x[0] == 'K'))  // dodavanje na zacini koi pocnuvaat na k vo nizata
    {
        $niza[$x] = [ 
               "vid" => $produkti[$x]["vid"], 
               "cena" => $produkti[$x]["cena"]
            ];
    }
}

$suma = 0;

foreach($niza as $x => $y)
{
    $suma += $niza[$x]["cena"];    // sobiranje na cenite na site produkti vo nizata
}

uasort($niza, function($a, $b)  
{
    return $b["cena"] <=> $a["cena"];
});    // sortiranje na nizata

while($suma > 40)
{    
    $suma -= $niza[array_key_last($niza)]["cena"]; // odzemanje na cenata na produktot so najniska cena od vkupnata cena
    
    array_pop($niza);   // odstranuvanje na produktot so najniska cena
}

foreach($niza as $x => $x_value)
{
    echo "produkt = " . $x;
    echo "</br>";
    echo "vid = ". $niza[$x]["vid"];
    echo "</br>";
    echo "cena = ". $niza[$x]["cena"];
    echo "</br>";
    echo "</br>";
}   // pecatenje na nizata

echo "vkupna suma = " . $suma;

?>