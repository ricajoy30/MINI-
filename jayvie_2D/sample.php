<?php

$number1 = 10;
$number2 = 20;
$number3 = 30;
$number4 = 40;

$addition = $number1 + $number2;
$subtraction = $number2 - $number3;
$multiplication = $number1 * $number4;
$division = $number4 / $number2;
$total = $addition + $subtraction + $multiplication + $division;
$average = $total/ 4;

echo "the sum of $number1 and $number2 is $addition <br> <br>";
echo "the differnce between $number3 and $number2 is $subtraction <br> <br>";
echo "the product of $number1 and $number4 is $multiplication <br><br>";
echo "the division of $number4 by $number2 is $division <br><br>";
echo "the total of all result is $total <br><br>";
echo "the average of all result is $average <br><br>";
?>