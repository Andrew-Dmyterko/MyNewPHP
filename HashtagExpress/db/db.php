<?php

$orders = [
    [
        'order_id' => 1,
        'order_number' => '98006300258',
        'order_date' => '20.12.2020',
        'from_department' => 15,
        'to_department' => 22,
        'from_city'  => 'Киев',
        'to_city'    => 'Хмельницкий',
        'delivery'  => '25.12.2020',
        'weight'  => '10',
        'describe' => 'Бытовая техника. Телевизор.',
        'price' => 320.80,
        'sender_name' => "Иванов Т.О.",
        'sender_phone' => "+380672569874",
        'reciver_name' => "Петров М.В.",
        'reciver_phone' => "380972581526"

    ],
    [
        'order_id' => 2,
        'order_number' => '98006300259',
        'order_date' => '22.12.2020',
        'from_department' => 1,
        'to_department' => 25,
        'from_city'  => 'Одесса',
        'to_city'    => 'Харьков',
        'delivery'  => '28.12.2020',
        'weight'  => '0,5',
        'describe' => 'Документы',
        'price' => 45.00,
        'sender_name' => "Жлоб А.Т.",
        'sender_phone' => "+380934578265",
        'reciver_name' => "Сидоров С.Л.",
        'reciver_phone' => "+380501472588"
    ],
];

$users = [
    [
        'user_phone' => '+380672569874',
        'user_name' => 'Иванов Т.О.',
        'user_bonus' => '5',
        'user_count' => '10',
        'user_client_card' => '928023558796',
    ],
    [
        'user_phone' => '+380972581526',
        'user_name' => 'Петров М.В.',
        'user_bonus' => '3',
        'user_count' => '7',
        'user_client_card' => '',
    ],
    [
        'user_phone' => '+380934578265',
        'user_name' => 'Жлоб А.Т.',
        'user_bonus' => '1',
        'user_count' => '3',
        'user_client_card' => '99925687593',
    ],
    [
        'user_phone' => '+380501472588',
        'user_name' => 'Сидоров С.Л.',
        'user_bonus' => '5',
        'user_count' => '50',
        'user_client_card' => '',
    ],
];

$staff = [
    [
        'login' => 'oper1',
        'pass'  => '123',
        'name'  => 'Шевчук О.М.',
        'group' => 'oper',
        'point' => '22',
        'address' => 'г.Хмельницкий ул.Шевченко, 11',

    ],
    [
        'login' => 'manager1',
        'pass'  => '123',
        'name'  => 'Костюк В.А.',
        'group' => 'manager',
        'point' => '22',
        'address' => 'г.Хмельницкий ул.Шевченко, 11',

    ],
    [
        'login' => 'sklad1',
        'pass'  => '123',
        'name'  => 'Нестерук Ю.С.',
        'group' => 'sklad',
        'point' => '22',
        'address' => 'г.Хмельницкий ул.Шевченко, 11',

    ],
    [
        'login' => 'oper2',
        'pass'  => '123',
        'name'  => 'Мерзенюк Р.В.',
        'group' => 'oper',
        'point' => '5',
        'address' => 'г.Нетишин ул.Незалежності, 43',

    ],
    [
        'login' => 'manager2',
        'pass'  => '123',
        'name'  => 'Костюк В.А.',
        'group' => 'manager',
        'point' => '5',
        'address' => 'г.Нетишин ул.Незалежності, 43',

    ],
    [
        'login' => 'sklad2',
        'pass'  => '123',
        'name'  => 'Жила Д.С.',
        'group' => 'sklad',
        'point' => '22',
        'address' => 'г.Нетишин ул.Незалежності, 43',

    ],
];

$access = [
    'oper' => ['operator.php','send.php'],
    'sklad' => ['store.php'],
    'manager' => ['manager.php'],
//    'all' => ['index.php']
    'all' => ['index.php', 'login.php']
];

$orders_track = [
    [
        'order_id' => 1,
        'order_status_message' => 'Находится в отделении №15. ожидает отправки',
        'order_status_id' => '1',
        'order_status_data' => '20.12.2020'
    ],
    [
        'order_id' => 1,
        'order_status_message' => 'Посылка отправлена. Находится в г.Киев. Ожидает отправку в город назначения',
        'order_status_id' => '2',
        'order_status_data' => '21.12.2020'
    ],
    [
        'order_id' => 2,
        'order_status_message' => 'Находится в г.Одесса в отделении №1. ожидает отправки',
        'order_status_id' => '2',
        'order_status_data' => '22.12.2020'
    ],
];