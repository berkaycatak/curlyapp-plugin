<?php

function social_media_settings_page_content()
{
    global $wpdb;

    if (isset($_POST['save'])) {
        if (!isset($_POST['curly_form_check']) || !wp_verify_nonce($_POST['curly_form_check'], 'curly_form_check')) {
            echo "hata";
        }else{
            $twitter    = stripslashes_deep($_POST['twitter']);
            $instagram  = stripslashes_deep($_POST['instagram']);
            $pinterest  = stripslashes_deep($_POST['pinterest']);
            $facebook   = stripslashes_deep($_POST['facebook']);

            $ok = $wpdb->update($wpdb->prefix."curlyapp_social",
                array(
                    'twitter'   => $twitter,
                    'instagram' => $instagram,
                    'pinterest' => $pinterest,
                    'facebook'  => $facebook
                ), array('id'=> 1)
            );

            if ($ok)
                echo '<div style="margin-top:20px;" class="updated">Ayarlar güncellendi!</div>';
            else
                echo '<div style="margin-top:20px;" class="failed">Ayarlar güncellenirken hata meydana geldi!</div>';
        }
    }

    $git = $wpdb->prefix."curlyapp_social";
    $get_social = $wpdb->get_results("SELECT * FROM  {$git} WHERE id = 1" );
    foreach ($get_social as $social) {
        $twitter    = $social->twitter;
        $instagram  = $social->instagram;
        $pinterest  = $social->pinterest;
        $facebook   = $social->facebook;
    }




    ?>
    <div class="curly-box">
        <div class="curly-head">
            <h1>Sosyal Medya Ayarları</h1>
            <p>Bu sayfada uygulamanızda görüntülenecek sosyal medya hesaplarınızı ekleyebilirsiniz.</p>
        </div>
        <hr>
        <div class="curly-content">
            <p>Hesabınız yoksa lütfen boş bırakın. Bu sayede icon görünmeyecek.</p>
            <form method="POST">
                <?php wp_nonce_field('curly_form_check','curly_form_check'); ?>
                <div class="form-group">
                    <label class="control-label" for="twitter">Twitter linki:</label>
                    <input type="text" class="form-control" value="<?=$twitter?>" id="twitter" name="twitter" placeholder="https://twitter.com/berkaypng">
                </div>
                <div class="form-group">
                    <label class="control-label" for="instagram">Instagram Linki:</label>
                        <input type="text" class="form-control" value="<?=$instagram?>" id="instagram" name="instagram" placeholder="https://instagram.com/berkaycatakon">
                </div>
                <div class="form-group">
                    <label class="control-label" for="pinterest">Pinterest Linki:</label>
                    <input type="text" class="form-control" value="<?=$pinterest?>" id="pinterest" name="pinterest" placeholder="https://tr.pinterest.com/berkaycatak/">
                </div>
                <div class="form-group">
                    <label class="control-label " for="facebook">Facebook Linki:</label>
                    <input type="text" class="form-control" value="<?=$facebook?>" id="facebook" name="facebook" placeholder="https://www.facebook.com/berkay/">
                </div>
                <div class="form-group">
                    <button type="submit" name="save" class="btn btn-info">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>
