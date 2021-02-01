<?php
    class Template
    {
        public $values = array(); //переменные шаблона
        public $html; // HTML-код

        function get_tpl($tpl_name){
            if(empty($tpl_name) || !file_exists($tpl_name)){
                return false;
            } else {
                $this->html = implode('', file($tpl_name));
            }
        }
//{METKA} $tpl->set_value('HEADER', $header);
        function set_value($key, $var){
            $key = '{'.$key.'}';
            $this->values[$key] = $var;
        }

        function tpl_parse()
        {
            foreach($this->values as $find=>$replace){
                $this->html = str_replace($find, $replace, $this->html);
            }
        }
    }

    $tpl = new Template();
?>

