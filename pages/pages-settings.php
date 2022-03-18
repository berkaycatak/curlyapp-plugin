<?php
function pages_settings_page_content()
{
    global $wpdb;
    $pages = get_pages( array( 'post_status' => 'publish'  ) );
    $git = $wpdb->prefix."curlyapp_pages";

    if (isset($_GET["add-page"]))
    {
        $page_id = stripslashes_deep($_GET['add-page']);

        $m_check_page = $wpdb->get_results("SELECT * FROM  {$git} WHERE page_id = $page_id");
        if (!$m_check_page)
        {
            $wpdb->insert($wpdb->prefix.'curlyapp_pages', array(
                'page_id' => $page_id
            ));
            echo '<div style="margin-top:20px;" class="updated">Ayarlar güncellendi!</div>';
        }
    }

    if (isset($_GET["delete-page"]))
    {
        $page_id = $_GET["delete-page"];
        $table = $wpdb->prefix."curlyapp_pages";
        $wpdb->delete( $table, array( 'page_id' => $page_id ) );
        echo '<div style="margin-top:20px;" class="updated">Ayarlar güncellendi!</div>';
    }
    $added_pages = $wpdb->get_results("SELECT * FROM  {$git}");
    ?>
<div class="curly-box">
    <div class="curly-head">
        <h1>Sayfa Ayarları</h1>
        <p>Bu sayfada uygulamanızda görüntülenecek sayfaları ekleyebilirsiniz.</p>
        <p><b>Not:</b> harici bir eklenti ile oluşturulmuş sayfaları eklemeyin, sadece içeriğinde HTML etiketleri bulunan sayfaları ekleyebilirsiniz.</p>
    </div>
    <div class="curly-content">
        <div class="row">
            <div class="col-md-6">
                <span class="h6">Sayfalar:</span><br><br>
                <table class="table">
                    <thead>
                    <tr>
                        <td ><b>ID</b></td>
                        <td ><b>İSMİ</b></td>
                        <td ><b>Ekle</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pages as $key) {
                        $check_page = $wpdb->get_results("SELECT * FROM  {$git} WHERE page_id = $key->ID");
                        if (!$check_page)
                        {
                            echo '<tr>';
                            echo "<td>".$key->ID."</td>";
                            echo "<td>".$key->post_title."</td>";
                            echo "<td><a href='?page=curly-pages&add-page=". $key->ID ."'><button class='btn btn-primary'>Ekle</button></a></td>";
                            echo '</tr>';
                        }
                    } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <span class="h6">Eklediğiniz sayfalar:</span><br><br>
                <table class="table">
                    <thead>
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>İSMİ</b></td>
                        <td><b>Sil</b></td>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($added_pages as $key) {
                            $ne = get_the_title($key->page_id);
                            echo '<tr>';
                            echo "<td>".$key->page_id."</td>";
                            echo '<td>'.$ne.'</td>';
                            echo "<td><a href='?page=curly-pages&delete-page=". $key->page_id ."'><button class='btn btn-danger'>Sil</button></a></td>";
                            echo '</tr>';
                        }  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } ?>
