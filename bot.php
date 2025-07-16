<?php

// Check Member if Join or Left the Group
// حذف جوین و لفت دادن ممبرا در گروه

$input = file_get_contents("php://input");
$update = json_decode($input, true);
$printData = print_r($update, true);

define("API_TOKEN", "");

$type = $update['message']['chat']['type'];
$message_id = $update['message']['message_id'];
$chat_id = $update['message']['chat']['id'];
$first_name = $update['message']['from']['first_name'];
$new_chat_member = $update['message']['new_chat_member'];
$left_chat_member = $update['message']['left_chat_member'];
$goroup_name = $update['message']['chat']['title'];
$text = $update['message']['text'];
$admin_bot = 303898395;

function bot(string $methods, array $params)
{
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://api.telegram.org/bot" . API_TOKEN . "/$methods",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $params,
    ]);
    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data, true);
}

function sendMessage(int|string $chat_id, string $text, int $message_thread_id = null, string $parse_mode = null, mixed $entities = null, mixed $link_preview_options = null, bool $disable_notification = null, bool $protect_content = null, mixed $reply_parameters = null, mixed $reply_markup = null)
{
    $params = [
        'chat_id' => $chat_id,
        'text' => $text
    ];
    if ($message_thread_id !== null) {
        $params['message_thread_id'] = $message_thread_id;
    }
    if ($parse_mode !== null) {
        $params['parse_mode'] = $parse_mode;
    }
    if ($entities !== null) {
        $params['entities'] = $entities;
    }
    if ($link_preview_options !== null) {
        $params['link_preview_options'] = $link_preview_options;
    }
    if ($disable_notification !== null) {
        $params['disable_notification'] = $disable_notification;
    }
    if ($protect_content !== null) {
        $params['protect_content'] = $protect_content;
    }
    if ($reply_parameters !== null) {
        $params['reply_parameters'] = $reply_parameters;
    }
    if ($reply_markup !== null) {
        $params['reply_markup'] = $reply_markup;
    }

    return bot('sendMessage', $params);
}

function debug(mixed $data)
{
    $printData = print_r($data, true);
    bot('sendMessage', [
        'chat_id' => 303898395,
        'text' => $printData
    ]);
}

function deleteMessage(int|string $chat_id, int $message_id)
{
    $params = [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
    ];

    return bot('deleteMessage', $params);
}

if ($type == 'group' or $type == 'supergroup') {
    if ($new_chat_member) {
        $new_user_id = $new_chat_member['id'];
        $new_user_username = $new_chat_member['username'];
        $new_user_first_name = $new_chat_member['first_name'];
        $new_user_last_name = $new_chat_member['last_name'];
        $group_name = $update['message']['chat']['title'];
        $txt = "😐 یک نفر داخل گروه جوین شد!

🔻 اسم گروه: $group_name
🔻 ایدی عددی: `$new_user_id`
🔻 نام: $new_user_first_name
🔻 نام خانوادگی: $new_user_last_name
🔻 نام کاربری: @$new_user_username";
        sendMessage(chat_id: $admin_bot, text: $txt, parse_mode: 'markdown');
        deleteMessage(chat_id: $chat_id, message_id: $message_id);
        $txt = "سلام $first_name عزیز
به گروه $goroup_name خوش امدی 💖";
        sendMessage(chat_id: $chat_id, text: $txt);
    }
    if ($left_chat_member) {
        deleteMessage(chat_id: $chat_id, message_id: $message_id);
        $group_name = $update['message']['chat']['title'];
        $left_user_id = $left_chat_member['id'];
        $left_user_first_name = $left_chat_member['first_name'];
        $left_user_last_name = $left_chat_member['last_name'];
        $left_user_username = $left_chat_member['username'];
        $txt = "😐 یک نفر از گروه فرار کرد!

🔻 اسم گروه: $group_name
🔻 ایدی عددی شخص: `$left_user_id`
🔻 نام شخص: $left_user_first_name
🔻 نام خانوادگی: $left_user_last_name
🔻 نام کاربری: @$left_user_username";
        sendMessage(chat_id: $admin_bot, text: $txt, parse_mode: 'markdown');
    }

}

// AtaDevPro