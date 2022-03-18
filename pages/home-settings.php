<?php
function home_settings_page_content()
{
    global $wpdb;

    $terms = get_categories( array( 'taxonomy' => 'category' ) );

    $git = $wpdb->prefix."curlyapp_category_settings";

    if (isset($_POST['save'])) {
        if (!isset($_POST['curly_form_check']) || !wp_verify_nonce($_POST['curly_form_check'], 'curly_form_check')) {
            echo "hata";
        }else{
            $id = 1;
            $mansetid       = stripslashes_deep($_POST['mansetid']);
            $mansetaltid    = stripslashes_deep($_POST['mansetaltid']);
            $hikayebuyukid  = stripslashes_deep($_POST['hikayebuyukid']);
            $hikayealtid    = stripslashes_deep($_POST['hikayealtid']);

            $wpdb->update($git, array(
                'manset' => $mansetid,
                'mansetAlt' => $mansetaltid,
                'hikayeBuyuk' => $hikayebuyukid,
                'hikayeAlt' => $hikayealtid
            ), array("id" => "1"));
            echo '<div style="margin-top:20px;" class="updated">Ayarlar güncellendi!</div>';
        }
    }


    $get_categories = $wpdb->get_results("SELECT * FROM  {$git}");
    foreach ($get_categories as $category) {
        $id          = $category->id;
        $manset      = $category->manset;
        $mansetAlt   = $category->mansetAlt;
        $hikayeBuyuk = $category->hikayeBuyuk;
        $hikayeAlt   = $category->hikayeAlt;
    }
    ?>
    <div class="curly-box">
        <div class="curly-head">
            <h1>Anasayfa Bölüm Ayarları</h1>
            <p>CurlyApp uygulamasının anasayfasında bulunan alanlara ilgili kategorileri ekle.</p>
        </div>
        <hr>
        <div class="curly-content">
            <form method="POST">
                <?php wp_nonce_field('curly_form_check','curly_form_check'); ?>
                <div class="form-group">
                    <label class="control-label" for="email">Manşet:</label>
                    <div class="col-sm-12">
                        <select name="mansetid">
                            <?php foreach ($terms as $key): ?>
                                <option <?=$key->term_taxonomy_id == $manset ? "selected" : ""?> value="<?=$key->term_taxonomy_id?>"><?=$key->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label class="control-label " for="email">Manşet Alt:</label>
                    <div class="col-sm-10">
                        <select name="mansetaltid">
                            <?php foreach ($terms as $key): ?>
                                <option <?=$key->term_taxonomy_id == $mansetAlt ? "selected" : ""?> value="<?=$key->term_taxonomy_id?>"><?=$key->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label class="control-label " for="email">Hikaye Büyük:</label>
                    <div class="col-sm-10">
                        <select name="hikayebuyukid">
                            <?php foreach ($terms as $key): ?>
                                <option <?=$key->term_taxonomy_id == $hikayeBuyuk ? "selected" : ""?> value="<?=$key->term_taxonomy_id?>"><?=$key->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label class="control-label " for="email">Hikaye Alt:</label>
                    <div class="col-sm-10">
                        <select name="hikayealtid">
                            <?php foreach ($terms as $key): ?>
                                <option <?=$key->term_taxonomy_id == $hikayeAlt ? "selected" : ""?> value="<?=$key->term_taxonomy_id?>"><?=$key->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 ">
                        <input type="submit" class="btn btn-info" value="Güncelle" name="save">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>
