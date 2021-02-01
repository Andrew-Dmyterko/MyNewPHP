<?php
echo preg_replace('#([a-z]+)@([a-z]+)#', "$2@$1", 'a@b aa@bb');
//b@a bb@aa

echo preg_replace('#()#', "$2@$1", 'a@b aa@bb');
