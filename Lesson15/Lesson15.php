<pre>
<?php
class Form
{ // допустимые значения формы
    protected $verifyArray = [
        'input' =>
            [
                'type' => ['text','submit','password','radio','reset','image','checkbox','button','file','hidden'],
                'value'=> "",
                'size' => "",
                'placeholder' => "",
                'name' => "",
                'disabled',
                'checked',
                'textForInput' => ""
            ],
        'textarea' =>
            [
                'value'=> "",
                'placeholder' => "",
                'name' => "",
                'disabled' => "",
                'rows' => "",
                'cols' => ""
            ],
        'select' =>
            [
                'name' => "",
                'disabled',
                'selected',
                'value'=> "",
                'textForSelect' => ""
            ]
    ];
    // массив для тегов select
    protected $selectArr;
}

class Forma extends Form
{
    public function open($param) {
        $forma = "<form method=".$param['method']." action='".$param['action']."' enctype='multipart/form-data'>";
        return $forma;
    }

    public function close() {
        $forma = "</form>";
        return $forma;
    }

    public function input($param) {
        $this->verifyParam($param,__FUNCTION__) or die ("fuck"); // обработка ошибок до конца не реализована поэтому die
        if (isset($param['textForInput'])) {
            $value = $param['textForInput'];
            unset($param['textForInput']);
        } else {
            $value = '';
        }
        $str_param = $this->getParam($param);
        return "<div><input $str_param>$value</div>";
    }

    public function submit($param) {
        $param['type'] = 'submit';
        return  $this->input($param);
    }

    public function password($param) {
       $param['type'] = 'password';
       return $this->input($param);
    }
    public function checkbox($param) {
       $param['type'] = 'checkbox';
       return $this->input($param);
    }

    public function radio($param) {
        $param['type'] = 'radio';
        return $this->input($param);
    }

    public function goSelect($nameSelect) {
        echo "<select name=\"".$nameSelect.'">'."\n";
        foreach ($this->selectArr[$nameSelect] as $key => $value) {

            $str_param = $this->getParam($value);

                echo '<option '.$str_param.">".$value['textForSelect'].'</option>';

        }
        echo  "</select>";
    }

    public function select($param) {
        $this->verifyParam($param,__FUNCTION__) or die ("fuck"); // обработка ошибок до конца не реализована поэтому die

        if (isset($param['name'])){
            $selectName = $param['name'];
            unset($param['name']);
        } else die("no select name"); // нет имя селекта умираем
        $row = @count($this->selectArr[$selectName]); // подавил варнинги когда массива еще нет

        foreach ($param as $key => $value) {
            $this->selectArr[$selectName][$row][$key] = $value;
        }
    }

    public function textarea($param) {
        $this->verifyParam($param,__FUNCTION__) or die ("fuck"); // обработка ошибок до конца не реализована поэтому die
        if (isset($param['value'])){
            $value = $param['value'];
            unset($param['value']);
        } else {
            $value = '';
        }
        $str_param = $this->getParam($param);
        return "<div><textarea $str_param>$value</textarea></div>";
    }

    public function verifyParam($param, $tegName) {
        foreach ($param as $key => $value) {
                if (( (isset($this->verifyArray[$tegName][$key])) && !is_numeric($key)) || (is_numeric($key) && in_array($value, $this->verifyArray[$tegName]) )){
                    if (is_array($this->verifyArray[$tegName][$key])) {
                        if (in_array($value, $this->verifyArray[$tegName][$key])) {
                            continue;
                        } else return false;
                    }
                } else return false;
        }
        return true;
    }

//принимать какой-то набор параметров и формировать строку с ними для html кода
    public function getParam($param) {
        $str = "";
        foreach ($param as $key => $value) {
            if (is_numeric($key)) {
                $str .= " $value";
            } else $str .= " $key='$value'";
        }
        return $str;
    }
}

$f1 = new Forma();

echo $f1->open(['action'=>'form.php', 'method'=>"POST"]);
echo $f1->input(['type'=>'text', 'name'=>"text", "value"=>"11111222"]);
echo $f1->radio(['type'=>'radio', 'name'=>"alco", "value"=>"beer", "textForInput" => "Пиво"]);
echo $f1->radio(['type'=>'radio', 'name'=>"alco", "value"=>"whiskey", "textForInput" => "Виски" , 'checked']);

echo $f1->checkbox(['type' => "checkbox", 'name' => "lessons[]", 'value' => "PHP", 'textForInput' => 'PHP' , 'checked']);
echo $f1->checkbox(['type' => "checkbox", 'name' => "lessons[]", 'value' => "JavaScript", 'textForInput' => 'JavaScript', 'checked', 'disabled']);
echo $f1->checkbox(['type' => "checkbox", 'name' => "lessons[]", 'value' => "Java", 'textForInput' => 'Java', 'checked']);

echo $f1->password(['value'=>'!!!']);
echo $f1->textarea(['placeholder'=>'123', 'value'=>'!!!']);

echo $f1->select(['name' => "job", 'disabled', 'selected', 'value'=> "", 'textForSelect' => "Выберите сферу деятельности"]);
echo $f1->select(['name' => "job", 'value' => "developer", 'textForSelect' => 'Разработчик']);
echo $f1->select(['name' => "job", 'value' => "developer1", 'textForSelect' => 'Разработчик1']);
echo $f1->select(['name' => "job", 'value' => "designer" , 'textForSelect' => 'Дизайнер']);
echo $f1->select(['name' => "job", 'value' => "system admin", 'textForSelect' => 'Сисадмин']);
echo $f1->select(['name' => "job", 'value' => "teacher" , 'textForSelect' => 'Учитель']);
echo $f1->goSelect("job");
// select 2
echo $f1->select(['name' => "job1", 'disabled', 'selected', 'value'=> "", 'textForSelect' => "Выберите сферу деятельности1"]);
echo $f1->select(['name' => "job1", 'value' => "developer1", 'textForSelect' => 'Разработчик1']);
echo $f1->select(['name' => "job1", 'value' => "designer1" , 'textForSelect' => 'Дизайнер1']);
echo $f1->select(['name' => "job1", 'value' => "system admin1", 'textForSelect' => 'Сисадмин1']);
echo $f1->select(['name' => "job1", 'value' => "teacher1" , 'textForSelect' => 'Учитель1']);
echo $f1->goSelect("job1");

//echo $f1->verifyParam((['type'=>'text', 'name'=>"text", "value"=>"11111222"]), "input");

echo $f1->submit(['value'=>'go']);
echo $f1->close();