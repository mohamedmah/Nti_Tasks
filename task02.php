<?php


//Write a PHP function to print the next character of a specific character.
function nextCha($cha){
    $next_cha = ++$cha; 
    echo $next_cha."<br>";
}
nextCha('a');
nextCha('z');

/*Output
b
aa
 */




//print All Values Using echo Function
$students = [
    ['name' => 'Root','age' => 20] , 
    ['name' => 'Root2','age' => 25,'gpa' => 3.4] ,
    ['name' => 'Root3','age' => 30]
];

foreach($students as $key => $values){
    foreach($students[$key] as $keys => $value){
     
   echo $value."<br>";

    }

 }

 /*Output
Root
20
Root2
25
3.4
Root3
30
 */


?>