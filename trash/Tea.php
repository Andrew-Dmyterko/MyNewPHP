<?php

class Tea
{
    public function addTea()
    {
        var_dump('Добавить щепотку чая.');
        return $this;
    }

    protected  function addHotWater()
    {
        var_dump('Добавить горячей воды.');
        return $this;
    }

    protected  function addSugar()
    {
        var_dump('Добавить ложку сахара.');
        return $this;
    }

    protected function addMilk()
    {
        var_dump('Добавить молоко.');
        return $this;
    }

    public function make()
    {
        return $this
            ->addHotWater()
            ->addSugar()
            ->addTea()
            ->addMilk();
    }
}
$tea = new Tea();
$tea->make(); // завариваем чай

//$tea1 = $tea->addTea();
//
//$tea1->addTea();
//$tea1->make();
