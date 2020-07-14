<?php
/*
Plugin Name: Ücretli Abonelik Sistemi
Plugin URI: https://gokhancelebi.net
Description: Wordpress ücretli abonelik sistemi
Author: Gökhan Çelebi
Version: 1
Author URI: https://gokhancelebi.net
*/


if(!function_exists('seoo')){

    function seoo($str, $options = array())
    {
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => true
        );
        $options = array_merge($defaults, $options);
        $char_map = array(
            // Latin
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
            'ß' => 'ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
            'ÿ' => 'y',
            // Latin symbols
            '©' => '(c)',
            // Greek
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
            // Turkish
            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
            // Russian
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',
            // Ukrainian
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
            // Czech
            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
            'Ž' => 'Z',
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z',
            // Polish
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
            'Ż' => 'Z',
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
            'ż' => 'z',
            // Latvian
            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
            'š' => 's', 'ū' => 'u', 'ž' => 'z'
        );
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
        $str = trim($str, $options['delimiter']);
        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }

}
add_action('init', 'process_post');

function process_post()
{
    if (isset($_GET['uyeol']) && is_super_admin()) {

        $uye = get_user_by('email', $_GET['uyeol']);

        if (!$uye){
            $uye = create_user(seoo($_GET['kullanici_adi'] . rand(0,1000)),$_GET['sifre'],$_GET['uyeol']);
            $uye = get_user_by('ID', $uye);
        }

        if ($uyelik_bitis_tarihi = get_user_meta($uye->ID, "uyelik_bitis_tarihi")) {



            $uyelik_bitis_tarihi = intval($uyelik_bitis_tarihi) + (365 * 24 * 60 * 60);

            update_user_meta($uye->ID, "uyelik_bitis_tarihi", $uyelik_bitis_tarihi);

            $message = "1 Yıllık Üyelik Uzatıldı";

        } else {
            $uyelik_bitis_tarihi = time() + (365 * 24 * 60 * 60);
            update_user_meta($uye->ID, "uyelik_bitis_tarihi", $uyelik_bitis_tarihi);

            $message = "1 Yıllık Üyelik Oluşturuldu";
        }

        echo  $_GET['uyeol'] . ' için ' . $message;

        exit;
    }


}


add_filter('the_content', 'filter_the_content_in_the_main_loop', 1);

function filter_the_content_in_the_main_loop($content)
{


    if (is_single() && is_singular() && (get_user_meta(get_current_user_id(), "uyelik_bitis_tarihi", true) == false || time() > get_user_meta(get_current_user_id(), "uyelik_bitis_tarihi", true))) {
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
                                if ($uyelik < time()) {
                                    echo "Normal Üye";
                                } else {
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

function wp_link_pages_titled($args = '')
{
    $defaults = array(
        'before' => '<p>' . __('Pages:'),
        'after' => '</p>',
        'link_before' => '',
        'link_after' => '',
        'echo' => 1
    );

    $r = wp_parse_args($args, $defaults);
    extract($r, EXTR_SKIP);

    global $page, $numpages, $multipage, $more, $pagenow, $pages;

    $output = '';
    if ($multipage) {
        $output .= $before;
        for ($i = 1; $i < ($numpages + 1); $i = $i + 1) {
            $part_content = $pages[$i - 1];
            $has_part_title = strpos($part_content, '<!--pagetitle:');
            if (0 === $has_part_title) {
                $end = strpos($part_content, '-->');
                $title = trim(str_replace('<!--pagetitle:', '', substr($part_content, 0, $end)));
            }
            $output .= ' ';
            if (($i != $page) || ((!$more) && ($page == 1))) {
                $output .= _wp_link_page($i);
            }
            $title = isset($title) && (strlen($title) > 0) ? $title : 'First';
            $output .= $link_before . $title . $link_after;
            if (($i != $page) || ((!$more) && ($page == 1)))
                $output .= '</a>';
        }
        $output .= $after;
    }
    if ($echo)
        echo $output;
    return $output;
}