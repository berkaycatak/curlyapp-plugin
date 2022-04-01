<?php

function general_settings_page_content()
{
    global $wpdb;

    if (isset($_POST['save'])) {
        if (!isset($_POST['curly_form_check']) || !wp_verify_nonce($_POST['curly_form_check'], 'curly_form_check')) {
            echo "hata";
        }else{
            $app_name = stripslashes_deep($_POST['app_name']);
            $logo_url = stripslashes_deep($_POST['logo_url']);
            $style_id = stripslashes_deep($_POST['style_id']);
            $cloud_messaging_server_key = stripslashes_deep($_POST['cloud_messaging_server_key']);

            $ok = $wpdb->update($wpdb->prefix."curlyapp_settings",
                array(
                    'app_name'      => $app_name,
                    'logo_url'      => $logo_url,
                    'post_style'    => $style_id,
                    'cloud_messaging_server_key' => $cloud_messaging_server_key
                ), array('id'=> 1)
            );

            if ($ok)
                echo '<div style="margin-top:20px;" class="updated">Ayarlar güncellendi!</div>';
            else
                echo '<div style="margin-top:20px;" class="failed">Ayarlar güncellenirken hata meydana geldi!</div>';
        }
    }

    $git = $wpdb->prefix."curlyapp_settings";
    $get_settings = $wpdb->get_results("SELECT * FROM  {$git} WHERE id = 1" );
    foreach ($get_settings as $settings) {
        $id = $settings->id;
        $app_name = $settings->app_name;
        $logo_url = $settings->logo_url;
        $style_id = $settings->post_style;
        $cloud_messaging_server_key = $settings->cloud_messaging_server_key;
    }



    ?>
    <div class="curly-box">
        <div class="curly-head">
            <h1>Genel Ayarlar</h1>
            <p>Bu sayfada uygulamanızın genel ayarlarını değiştirebilirsiniz.</p>
        </div>
        <hr>
        <div class="curly-content">
            <form method="POST">
                <?php wp_nonce_field('curly_form_check','curly_form_check'); ?>
                <div class="form-group">
                    <label class="control-label" for="email">Uygulama ismi:</label>
                    <input type="text" class="form-control" name="app_name" value="<?=$app_name?>" placeholder="Uygulamanızın ismini girin">
                </div>
                <div class="form-group">
                    <label class="control-label" for="pwd">Uygulamada gözükecek logo:</label>
                    <input type="text" name="logo_url" class="form-control" value="<?=$logo_url?>" placeholder="Örnek: https://www.site.com/logo.png">
                </div>
                <div class="form-group">
                    <label class="control-label" for="cloud_messaging_server_key">Firebase Cloud Messaging API (Server Key):</label>
                    <input type="text" name="cloud_messaging_server_key" id="cloud_messaging_server_key" class="form-control" value="<?=$cloud_messaging_server_key?>">
                    <small><b>Nasıl yapılır?:</b> Key'e ulaşmak için: Firebase hesabınıza giriş yapın, oluşturulan projeye girin, Firebase logosu altındaki ayarlar butonuna tıklatın, "project settings" sekmesine girin, "Cloud Messaging" sekmesine geçin "Cloud Messaging API (Legacy)" altında bulunan "Server key"i aşağıya yapıştırın. </small>
                </div>
                <hr>
                <h3>Post Sayfası Ayarları</h3>

                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <h5>
                            <input type="radio" id="no1" name="style_id" value="1" <?=$style_id == 1 ? 'checked' : ''?> >
                            <label for="no1">Görünüm no: 1</label>
                        </h5>
                        <img style="width: 90%" src=/wp-content/plugins/CurlyApp/assets/img/stil1-light.png">
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5>
                            <input type="radio" id="no2" name="style_id" value="2" <?=$style_id == 2 ? 'checked' : ''?> >
                            <label for="no2">Görünüm no: 2</label>
                        </h5>
                        <img style="width: 90%" src="/wp-content/plugins/CurlyApp/assets/img/stil2-light.png">
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5>
                            <input type="radio" id="no3" name="style_id" value="3" <?=$style_id == 3 ? 'checked' : ''?> >
                            <label for="no3">Görünüm no: 3</label>
                        </h5>
                        <img style="width: 90%" src="/wp-content/plugins/CurlyApp/assets/img/stil3-light.png">
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5>
                            <input type="radio" id="no4" name="style_id" value="4" <?=$style_id == 4 ? 'checked' : ''?> >
                            <label for="no4">Görünüm no: 4</label>
                        </h5>
                        <img style="width: 90%" src="/wp-content/plugins/CurlyApp/assets/img/stil4-light.png">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-sm-offset-2 ">
                        <input type="submit" class="btn btn-info" value="Kaydet" name="save"><br>
                        <p><i>Not:</i> Ayarların uygulamanızda aktif olması için uygulamanızda anasayfayı yenilemeyi, uygulamadan çıkıp tekrar girmeyi unutmayın :)</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>
