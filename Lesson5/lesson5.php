<pre>
<?php

echo phpversion();

echo '<pre>'; // say you have an array something like this $multidimentional_array= array( array( array("rose", 1.25, 15), array("daisy", 0.75, 25), array("orchid", 4, 7) ), array( array("rose", 1.25, 15), array("daisy", 0.75, 25), array("orchid", 5, 7) ), array( array("rose", 1.25, 15), array("daisy", 0.75, 25), array("orchid", 8, 7) ) ); // serialize $serialized_array=serialize($multidimentional_array); print_r($serialized_array);

$a = [1,2,3,4,5,'kkjjhn,olkkjik'];

echo serialize($a);

$b = unserialize(serialize($a));

var_dump($b);

echo "<hr>";

function foo()
{
    $numargs = func_num_args();
    echo "Колличество аргументов : $numargs \n";
}



foo(1, ‘str’, array(1,2)); // Скрипт выведет 'Колличество аргументов: 3’


echo "<hr>";


function foo1()
{
    $numargs = func_num_args();
    echo "Колличество аргументов: $numargs<br>\n";
    if ($numargs >= 2) {
        echo "Второй аргумент : ".func_get_arg(1)."<br>\n";
    }
}

foo1(1, ‘str’, array(1,2));

echo "<hr>";

function foo2()
{
    $numargs = func_num_args();
    echo "Колличество аргументов: $numargs<br>\n";

    $arg_list = func_get_args();
    var_dump($arg_list);
}

foo2(1, ‘str’, array(1,2));