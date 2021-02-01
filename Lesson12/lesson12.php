<?php

//echo preg_replace('#a&b#', '!', 'a&b');
//echo preg_replace('&a\&b#', '!', 'a&b');


//echo preg_replace('#xax#', '!', 'xax xaax'); //выведет '! xaax'
//echo preg_replace('#123#', '!', '123 xaax'); //выведет '! xaax'
//echo preg_replace('#x3x#', '!', 'x3x xaax'); //выведет '! xaax‘
//echo preg_replace('#x.x#', '!', 'xax xsx x&x x-x xaax'); //выведет '! ! ! ! xaax'
//echo preg_replace('#x\.x#', '!', 'xax x.xrrrr xsx x&x x-x xaax'); //выведет '! ! ! ! xaax'
//Обратите внимание на то, что регистр имеет значение:
//echo preg_replace('#A3B#', '!', 'a3b A3B'); //выведет 'a3b !'

//echo preg_replace('#xa?x#', '!', 'xx xax xaax xaaax xdx');

//echo preg_replace('#x(ab)+x#', '!', 'xabx xababx xaabbx');

//echo preg_replace('#a.+?x#', '!', 'a23e4x qw x e');

//echo preg_replace('#a.b#', '!', 'ahb acb aeb aeeb aeeb adcd axeb');
//echo preg_replace('#a.b#', '!', 'ahb acb aeb aeeb aeeb adcd axeb');
//echo preg_replace('#\d+#', '!', '1 12 123 abc @@@');
//echo preg_replace('#[abcv]xx#', '!', 'axx bxx cxx exx mxx vxx');
//echo preg_replace('#[^\^da]xx#', '!', 'axx bxx ^xx exx mxx vxx dxx');

//echo preg_replace('#[а-яА-ЯЁё]яя#u', '!', 'аяя ёяя 2яя');
//echo preg_replace('#^aaa#', '!', 'aaa aaa aaa');
//echo preg_replace('#aaa$#', '!', 'aaa aaa aaa');
//echo preg_replace('#^\w\s+\w+$#', '!', 'aaa aaa aaa');

//echo preg_replace('#\b[a-ї]+#u', '!', 'мама імыла 4раму');

//echo preg_replace('#\bab{2,4}a\b#', "!", "aa aba abba mabbba abbbba abbbbb");

//echo preg_replace('#A#i', '!', 'aAb'); //выведет '!!b'


// Дана строка 'aa aba abba abbba abbbba abbbbba'.
// Напишите регулярку, которая найдет строки abba, abbba, abbbba и только их.
echo preg_replace('#ab{2,4}a#', '!', 'aa aba abba abbba abbbba abbbbba');
echo "<br>";

// Дана строка 'a1a a2a a3a a4a a5a aba aca'.
// Напишите регулярку, которая найдет строки, в которых по краям стоят буквы 'a', а между ними одна цифра.
echo preg_replace('#a\da#', '!', 'a1a a2a a3a a4a a5a aba aca');
echo "<br>";

// Дана строка 'avb a1b a2b a3b a4b a5b abb acb'.
// Напишите регулярку, которая найдет строки следующего вида: по краям стоят буквы 'a' и 'b', а между ними - не число
echo preg_replace('#a\Db#', '!', 'avb a1b a2b a3b a4b a5b abb acb');
echo "<br>";

// Дана строка 'aba aea aca aza axa'.
// Напишите регулярку, которая найдет строки aba, aea, axa, не затронув остальных
echo preg_replace('#a[bex]a#', '!', 'aba aea aca aza axa');
echo "<br>";

// Дана строка 'wйw wяw wёw wqw'.
// Напишите регулярку, которая найдет строки следующего вида: по краям стоят буквы 'w', а между ними - буква кириллицы.
echo preg_replace('#w[а-яА-ЯЁё]w#u', '!', 'wйw wяw wёw wqw');
echo "<br>";

// Дана строка 'aAXa aeffa aGha aza ax23a a3sSa'.
// Напишите регулярку, которая найдет строки следующего вида: по краям стоят буквы 'a',
// а между ними - маленькие латинские буквы, не затронув остальных.
echo preg_replace('#a[a-z]+a#', '!', 'aAXa aeffa aGha aza ax23a a3sSa');
echo "<br>";


// Дана строка 'aaa aaa aaa'.
// Напишите регулярку, которая заменит первое 'aaa' на '!'.
echo preg_replace('#^aaa#', '!', 'aaa aaa aaa');
echo "<br>";

// Дана строка 'xbx aca aea abba adca abea'.
// Напишите регулярку, которая вокруг каждого слова вставит '!'
// (получится '!xbx! !aca! !aea! !abba! !adca! !abea!')
echo preg_replace('#\b#', '!', 'xbx aca aea abba adca abea');
echo "<br>";
