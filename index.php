<?php
class FakeAPI{
    function get_users(){
        // Инициализация сеанса cURL
        $ch = curl_init();
        // Установка URL
        curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/users");
        // Установка CURLOPT_RETURNTRANSFER (вернуть ответ в виде строки)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Выполнение запроса cURL
        //$res содержит полученную строку
        $res = curl_exec($ch);
        $data = json_decode($res);
        // закрытие сеанса curl для освобождения системных ресурсов
        curl_close($ch);
        return $data;
    }

    function get_posts(){
        // Инициализация сеанса cURL
        $ch = curl_init();
        // Установка URL
        curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/posts");
        // Установка CURLOPT_RETURNTRANSFER (вернуть ответ в виде строки)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Выполнение запроса cURL
        //$res содержит полученную строку
        $output = curl_exec($ch);
        $data = json_decode($output);
        // закрытие сеанса curl для освобождения системных ресурсов
        curl_close($ch);
        return $data;
    }

    function get_todos(){
        // Инициализация сеанса cURL
        $ch = curl_init();
        // Установка URL
        curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/todos");
        // Установка CURLOPT_RETURNTRANSFER (вернуть ответ в виде строки)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Выполнение запроса cURL
        //$res содержит полученную строку
        $res = curl_exec($ch);
        $data = json_decode($res);
        // закрытие сеанса curl для освобождения системных ресурсов
        curl_close($ch);
        return $data;
    }


    function send_post($title,$body,$user_id){
        $data = array(
            'title'  => $title,
            'body' => $body,
            'user_id' => $user_id
        );

        $ch = curl_init('https://jsonplaceholder.typicode.com/posts');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','charset=UTF-8'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //CURLOPT_HEADER может быть установден true если нужно вернуть заголовки
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res ? "$res\nSuccess " : "\nFailed";
    }

    function change_post($post_id,$title,$body,$user_id){
        $data = array(
            'title'  => $title,
            'body' => $body,
            'user_id' => $user_id
        );

        $ch = curl_init("https://jsonplaceholder.typicode.com/posts/$post_id");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','charset=UTF-8'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //CURLOPT_HEADER может быть установден true если нужно вернуть заголовки
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res ? "$res\nSuccess" : "\nFailed";
    }

    function delete_post($post_id)
    {
        $ch = curl_init("https://jsonplaceholder.typicode.com/posts/$post_id");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($ch);
        curl_close($ch);
        return $res ? "\nSuccess" : "\nFailed";
    }

}

$api = new FakeAPI();

//print_r($api -> change_post(1,'Title','Text',1));
//print_r($api -> delete_post(1));
//print_r($api -> send_post('Title','Text',1));
//print_r($api -> get_users()[1]);
//print_r($api -> get_posts()[1]);
//print_r($api -> get_todos()[10]);


?>