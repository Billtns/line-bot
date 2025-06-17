<?php

$channelAccessToken = '8agyzLfpfRb+pm9cUwh0K6EzYBVJSGNXfl24S5ebM5AelI807KTBZb9lqLOr7eko14wezoMz15Wq9Rr+4zLP3SRRF/RSgHQMrLpNKk/S9sQfY6G3yFPzTlqyxmb8rJoQlUb370w1+DMpI7nLjz3TDwdB04t89/1O/w1cDnyilFU='; // Access Token ค่าที่เราสร้างขึ้น

$request = file_get_contents('php://input');   // Get request content

$request_json = json_decode($request, true);   // Decode JSON request
file_put_contents('/tmp/log.txt', print_r($request_json, true)); 
$userId = $request_json['events'][0]['source']['userId'];
file_put_contents('/tmp/userid.txt', $userId);
echo "userId: $userId";

foreach ($request_json['events'] as $event) {
	if ($event['type'] == 'message') {
		if ($event['message']['type'] == 'text') {
			$text = $event['message']['text'];

			//$reply_message = 'ฉันได้รับข้อความ '. $text.' ของคุณแล้ว!';   
			//$reply_message = mySQL_selectAll('http://s61160179.kantit.com/json_select.php');
			//$reply_message = mySQL_selectAll('http://bot.kantit.com/json_select_users.php');
			//$reply_message = mySQL_selectAll('http://bot.kantit.com/json_select_users.php?sid='.$text);
			$arr = explode(" ", $text);
			if ($arr[0] == "@บอท") {

				$reply_message = "กรุณาใช้รูปแบบคำสั่งที่ถูกต้องงงงง!!\n";

				$reply_message .= "ฉันมีบริการให้คุณสั่งได้ ดังนี้...\n";

				$reply_message .= "พิมพ์ว่า \"@บอท ขอรายชื่อนิสิตทั้งหมด\"\n";
				$reply_message .= "พิมพ์ว่า \" @บอท ฉันต้องการค้นหาข้อมูลนิสิตชื่อ xxx\"\n";
				$reply_message .= "พิมพ์ว่า \" @บอท ฉันต้องการค้นหาข้อมูลนิสิตนามสกุล xxx\"\n";

				if ($arr[1] == "ขอรายชื่อนิสิตทั้งหมด") {
					$name = mySQL_selectAll('http://bot.kantit.com/json_select_users.php');
					foreach ($name as $values) {
						$data .= $values["user_stuid"] . " " . $values["user_firstname"] . " " . $values["user_lastname"] . "\r\n";
					}
					$reply_message = $data;
				}

				if ($arr[1] == "ฉันต้องการค้นหาข้อมูลนิสิตนามสกุล") {
					$name = mySQL_selectAll('http://bot.kantit.com/json_select_users.php');
					foreach ($name as $values) {
						if ($values["user_lastname"] == $arr[2]) {
							$data .= "พบชื่อ" . $values["user_firstname"] . " " . $values["user_lastname"] . "\r\n";
						}
					}
					$reply_message = $data;
				}

				if ($arr[1] == "ฉันต้องการค้นหาข้อมูลนิสิตชื่อ") {
					$name = mySQL_selectAll('http://bot.kantit.com/json_select_users.php');
					foreach ($name as $values) {
						if ($values["user_firstname"] == 'นาย' . $arr[2] || $values["user_firstname"] == 'นางสาว' . $arr[2]) {
							$data .= "พบชื่อ" . $values["user_firstname"] . " " . $values["user_lastname"] . "\r\n";
						}
					}
					$reply_message = $data;
				}

				if ($arr[1] == "test") {
					$flexData = [
						"type" => "flex",
						"altText" => "สรุปคำสั่งซื้อ",
						"contents" => [
							"type" => "bubble",
							"hero" => [
								"type" => "image",
								"url" => "https://upload.wikimedia.org/wikipedia/commons/c/c8/Cappuccino_at_Sightglass_Coffee.jpg",
								"size" => "full",
								"aspectRatio" => "20:13",
								"aspectMode" => "cover"
							],
							"body" => [
								"type" => "box",
								"layout" => "vertical",
								"contents" => [
									["type" => "text", "text" => "สินค้า: Cappuccino", "weight" => "bold", "size" => "xl"],
									["type" => "text", "text" => "สถานที่: San Francisco"]
								]
							],
							"footer" => [
								"type" => "box",
								"layout" => "vertical",
								"spacing" => "sm",
								"contents" => [
									[
										"type" => "button",
										"style" => "primary",
										"action" => [
											"type" => "uri",
											"label" => "ดูเพิ่มเติม",
											"uri" => "https://th.m.wikipedia.org/wiki/%E0%B9%84%E0%B8%9F%E0%B8%A5%E0%B9%8C:Cappuccino_at_Sightglass_Coffee.jpg"
										]
									]
								]
							]
						]
					];
					$reply_flex = $flexData;
				}

				if ($arr[1] == "valentine") {
					$flexData = [
						"type" => "flex",
						"altText" => "valentine",
						"contents" => [
							"type" => "bubble",
							"hero" => [
								"type" => "image",
								"url" => "https://snoopn4pnuts.com/cdn/shop/products/flag1010a.jpg?v=1579576740",
								"size" => "full",
								"aspectRatio" => "20:45",
								"aspectMode" => "cover"
							],
							"body" => [
								"type" => "box",
								"layout" => "vertical",
								"contents" => [
									["type" => "text", "text" => "Valentine", "weight" => "bold", "size" => "xl"],
									["type" => "text", "text" => "if you need click button"]
								]
							],
							"footer" => [
								"type" => "box",
								"layout" => "vertical",
								"spacing" => "sm",
								"contents" => [
									[
										"type" => "button",
										"style" => "primary",
										"action" => [
											"type" => "uri",
											"label" => "link",
											"uri" => "https://script.google.com/macros/s/AKfycbw4k2oYRBU-hCtu-k16ystdRoz0ZwUBd9Y6Wg8347x-A06TM8uTA_AFC4NYjAYu7uY6/exec"
										]
									]
								]
							]
						]
					];
					$reply_flex = $flexData;
				}
			}
		} else {
			$reply_message = 'ฉันได้รับ ' . $event['message']['type'] . ' ของคุณแล้ว!';
		}
	} else {
		$reply_message = 'ฉันได้รับ Event ' . $event['type'] . ' ของคุณแล้ว!';
	}

	// reply message
	$post_header = array('Content-Type: application/json', 'Authorization: Bearer ' . $channelAccessToken);
	if($reply_flex){
		$data = ['replyToken' => $event['replyToken'], 'messages' => [$reply_flex]];
	}else{
		$data = ['replyToken' => $event['replyToken'], 'messages' => [['type' => 'text', 'text' => $reply_message]]];
	}
	
	$post_body = json_encode($data);
	//$send_result = replyMessage('https://api.line.me/v2/bot/message/reply', $post_header, $post_body);
	$send_result = send_reply_message('https://api.line.me/v2/bot/message/reply', $post_header, $post_body);
}

function mySQL_selectAll($url)
{
	$result = file_get_contents($url);

	$result_json = json_decode($result, true); //var_dump($result_json);

	//$data = "ผลลัพธ์:\r\n";

	//foreach($result_json as $values) {
	//	$data .= $values["user_stuid"] . " " . $values["user_firstname"] . " " . $values["user_lastname"] . "\r\n";
	//}

	return $result_json;
}

function replyMessage($url, $post_header, $post_body)
{
	$context = stream_context_create([
		'http' => [
			'method' => 'POST',
			'header' => $post_header,
			'content' => $post_body,
		],
	]);

	$result = file_get_contents($url, false, $context);

	return $result;
}

function send_reply_message($url, $post_header, $post_body)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	$result = curl_exec($ch);

	curl_close($ch);

	return $result;
}
