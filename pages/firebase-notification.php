<?php

function fcmsend($token, $title, $body){
    $url = "https://fcm.googleapis.com/fcm/send";
    $serverKey = $token;
    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
    $arrayToSend = array('to' => "/topics/all", 'notification' => $notification,'priority'=>'high');
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    //curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    //curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    //Send the request

    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }

    //"multicast_id":2867820107942227442,"success":1,"failure":0,"canonical_ids":0,"results":[{"message_id":"1584799000714742"
    $result = json_decode($response, true);
    curl_close($ch);
    return $result;
    //curl_close($response);
    //header('Content-type: application/json');
    //header('Content-type: text/html; charset=UTF-8');
    //header('content-type application/json charset=utf-8')
    //exit;
}

function firebase_notification_content()
{
    global $wpdb;
    $git = $wpdb->prefix."curlyapp_settings";
    $get_settings = $wpdb->get_results("SELECT * FROM  {$git} WHERE id = 1" );
    foreach ($get_settings as $settings) {
        $id = $settings->id;
        $app_name = $settings->app_name;
        $logo_url = $settings->logo_url;
        $style_id = $settings->post_style;
        $cloud_messaging_server_key = $settings->cloud_messaging_server_key;
    }
    if ($_POST["submit"]) {
        if (!isset($_POST['curly_form_check']) || !wp_verify_nonce($_POST['curly_form_check'], 'curly_form_check')) {
            echo "hata";
        } else {
            print_r(fcmsend($cloud_messaging_server_key, $_POST["title"], $_POST["body"]));
        }
    }
    ?>
    <div class="curly-box">
        <div class="curly-head">
            <h1>Anlık Bildirim</h1>
            <p>Modern CurlyApp uygulamasını eklenti ayarları ile yönet.</p>
        </div>
        <hr>
        <div class="curly-content">
            <form method="POST">
                <?php wp_nonce_field('curly_form_check','curly_form_check'); ?>
                <div class="form-group">
                    <label class="control-label" for="title">Başlık:</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Bildirim başlığını girin" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="body">İçerik:</label>
                    <textarea class="form-control" placeholder="Bildirim içeriğini girin" name="body" id="body" cols="30" required></textarea>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 ">
                        <input type="submit" class="btn btn-info" value="Gönder" name="submit"><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>
