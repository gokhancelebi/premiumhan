<?php
/*
Plugin Name: Ücretli Abonelik Sistemi
Plugin URI: https://gokhancelebi.net
Description: Wordpress ücretli abonelik sistemi
Author: Gökhan Çelebi
Version: 1
Author URI: https://gokhancelebi.net
*/

add_filter('the_content', 'filter_the_content_in_the_main_loop', 1);

function filter_the_content_in_the_main_loop($content)
{


    if (is_singular() && (get_user_meta(get_current_user_id(), "uyelik_bitis_tarihi", true) == false || time() > get_user_meta(get_current_user_id(), "uyelik_bitis_tarihi", true))) {
        return "Öncelikle abonelik satın almalısını";
    }

    return $content;
}

add_action('admin_menu', 'my_menu');
function my_menu()
{
    add_menu_page("Üyeler", "Üyelik Sistemi", "manage_options", "uye-sayfasi", "uye_sayfasi_fonskiyonu");
}

function uye_sayfasi_fonskiyonu()
{
    $sayfa = isset($_GET["sayfa"]) ? $_GET["sayfa"] : "index";

    echo "<div class='wrap'>";

    include "sayfalar/" . $sayfa . ".php";

    echo "</div>";

}


// ADDING CUSTOM FIELDS TO INDIVIDUAL USER SETTINGS PAGE AND TO USER LIST
add_action('show_user_profile', 'add_extra_user_fields');
add_action('edit_user_profile', 'add_extra_user_fields');

function add_extra_user_fields($user)
{
    if (isset($_GET["user_id"])) {


        $plugin_url = plugin_dir_url(__FILE__);
        ?>
        <h3 id="uyelik-islemleri">Premium Üyelik</h3>
        <table class="form-table">
            <tr class="user-job-title-wrap">
                <th><label for="job_title">Üyelik Durumu</label></th>
                <td>
                    <b>
                        <?php

                        $uyelik = get_user_meta($_GET["user_id"], "uyelik_bitis_tarihi", true);

                        if ($uyelik) {
                            if (time() > $uyelik) {
                                echo "Üyelik Sona ermiş";
                            } else {
                                if ($uyelik < time()){
                                    echo "Normal Üye";
                                }else{
                                    $bitis_tarihi = date("d.m.Y H:i:s", $uyelik);
                                    echo "Premium üye, Bitiş Tarihi : " . $bitis_tarihi;
                                }
                            }
                        } else {
                            echo "Normal Üye";
                        }

                        ?>
                    </b>
                </td>
            </tr>
            <tr class="user-description-wrap">
                <th><label for="description">Üyelik İşlemleri</label></th>
                <td>
                    <button type="button" class="1-yil-uzat">1 Yıl Uzat</button>
                    <button type="button" class="2-yil-uzat">2 Yıl Uzat</button>
                    <button type="button" class="uyeligi-sonlandir">Üyeliği Sonlandır</button>
                </td>
            </tr>
        </table>

        <script src="<?= $plugin_url ?>assets/js/swa/sweetalert.min.js"></script>
        <script>
            jQuery(function ($) {
                $(".1-yil-uzat").click(function () {
                    $.post("<?=$plugin_url?>includes/post/uyelik-islemleri.php", {
                        islem: "1-yil-uzat",
                        user_id:<?=$_GET["user_id"]?>}, function (data) {
                        swal(data);
                    });
                });
                $(".2-yil-uzat").click(function () {
                    $.post("<?=$plugin_url?>includes/post/uyelik-islemleri.php", {
                        islem: "2-yil-uzat",
                        user_id:<?=$_GET["user_id"]?>}, function (data) {
                        swal(data);
                    });
                });
                $(".uyeligi-sonlandir").click(function () {
                    $.post("<?=$plugin_url?>includes/post/uyelik-islemleri.php", {
                        islem: "uyeligi-sonlandir",
                        user_id:<?=$_GET["user_id"]?>}, function (data) {
                        swal(data);
                    });
                });
            });
        </script>
        <?php
    }
}