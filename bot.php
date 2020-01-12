<?РНР

включите "vk_api.РНР";



const VK_KEY = "37df4f8760486a2f32b0e3c11662185f1b6fed139e4657de4d62e5bc79c2dd5e3ce5399d19a0d937237fc"; //тот самый длинный ключ доступа сообщества
const ACCESS_KEY = "982d574b"; //например c40b9566, введите сво
const VERSION = "5.103"; //ваша версия используемого api



$vk = new vk_api(VK_KEY, VERSION); // создание экземпляра класса работы с api, принимает ключ и версию api
$data = json_decode(file_get_contents('php://input')); //Получает и декодирует JSON пришедший из ВК
//print_r($data);
if ($data->type == 'confirmation') { //Если vk запрашивает ключ
 exit(ACCESS_KEY); //Завершаем скрипт отправкой ключа
}
$vk->sendOK(); //Говорим vk, что мы приняли callback
// Создаем необходимые переменные
$peer_id = $data->object->peer_id; // Узнаем ИД беседы 2000000.....
$id = $data->object->from_id; // Узнаем ид пользователя который отправляет команду
$message = $data->object->text; // Текст самого сообщения
$is_admin = [87444494, 183657]; // создаем массив с ID's наших будущих админов через запятую
$chat_id = $peer_id-2000000000;

if ($data->type == 'message_new') { // Если это новое сообщение то выполняем код указанный в условии


 if (mb_substr($message,0,5) == '/кик'){ // Обрезаем сообщение и сравниваем что получилось

 if (in_array($id, $is_admin)) { // С помощью in_array проверяем схожесть переменной $id с массивом с ID's

 $kick_id = mb_substr($message ,6); // еще раз обрезаем и получаем все что написано после /kick_
 $kick_id = взрыв ("|", mb_substr ($kick_id, 3)) [0];

 если($kick_id == ""){
 $vk->sendMessage($peer_id, "Вы забыли указать аргумент");

 } еще {

 $vk - >запрос ('сообщения.removeChatUser', ['chat_id' = > $chat_id, 'member_id' = > > $kick_id]);
 $vk->sendMessage($peer_id, "id - {$kick_id} был исключен :-)");

    }
 } еще {
 $vk->sendMessage($peer_id, "У Вас нет доступа к этой команде!");

        }
    }
}
