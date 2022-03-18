<?php
function categories_settings_page_content()
{
    global $wpdb;
    $terms = get_categories( array( 'taxonomy' => 'category'  ) );
    $git = $wpdb->prefix."curlyapp_categories";
    $added_categories = $wpdb->get_results("SELECT * FROM  {$git}");

    if (isset($_GET["add-category"]))
    {
        $category_id = stripslashes_deep($_GET['add-category']);

        $m_check_category = $wpdb->get_results("SELECT * FROM  {$git} WHERE category_id = $category_id");
        if (!$m_check_category)
        {
            $wpdb->insert($wpdb->prefix.'curlyapp_categories', array(
                'category_id' => $category_id
            ));
            echo '<div style="margin-top:20px;" class="updated">Ayarlar güncellendi!</div>';
        }
    }

    if (isset($_GET["delete-category"]))
    {
        $cat_id = $_GET["delete-category"];
        $table = $wpdb->prefix."curlyapp_categories";
        $wpdb->delete( $table, array( 'category_id' => $cat_id ) );
        echo '<div style="margin-top:20px;" class="updated">Ayarlar güncellendi!</div>';
    }
    $added_categories = $wpdb->get_results("SELECT * FROM  {$git}");
    ?>
<div class="curly-box">
    <div class="curly-head">
        <h1>Kategori Ayarları</h1>
        <p>Bu sayfada uygulamanızda görüntülenecek kategorileri ekleyebilirsiniz.</p>
    </div>
    <div class="curly-content">
        <div class="row">
            <div class="col-md-6">
                <span class="h6">Ekleyebileceğiniz kategoriler:</span><br><br>
                <table class="table">
                    <thead>
                    <tr>
                        <td ><b>ID</b></td>
                        <td ><b>İSMİ</b></td>
                        <td ><b>Ekle</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($terms as $key) {
                        $check_category = $wpdb->get_results("SELECT * FROM  {$git} WHERE category_id = $key->term_taxonomy_id");
                        if (!$check_category)
                        {
                            echo '<tr>';
                            echo "<td>".$key->term_taxonomy_id."</td>";
                            echo "<td>".$key->name."</td>";
                            echo "<td><a href='?page=curly-categories&add-category=". $key->term_taxonomy_id ."'><button class='btn btn-primary'>Ekle</button></a></td>";
                            echo '</tr>';
                        }
                    } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <span class="h6">Eklediğiniz kategoriler:</span><br><br>
                <table class="table">
                    <thead>
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>İSMİ</b></td>
                        <td><b>Sil</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($added_categories as $key) {
                        $ne = get_cat_name($key->category_id);
                        echo '<tr>';
                        echo "<td>".$key->category_id."</td>";
                        echo '<td>'.$ne.'</td>';
                        echo "<td><a href='?page=curly-categories&delete-category=". $key->category_id ."'><button class='btn btn-danger'>Sil</button></a></td>";
                        echo '</tr>';
                    }
                    $silid = $_GET['id'];
                    $table = $wpdb->prefix."mobilAppKategorilerSettings";
                    $wpdb->delete( $table, array( 'id' => $silid ) );
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } ?>
