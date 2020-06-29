<style>


    <?php

    $dir = plugin_dir_path( __FILE__ );

    include $dir."../assets/css/index.css";

    $kullanıcılar = get_users();


    ?>
</style>
<div class="arama-filtreleri">
    <a href="" class="tumu">Tümü</a>
    <a href="" class="tumu">Abone Olanlar</a>
    <a href="" class="tumu">Normal Üyeler</a>
</div>
<div class="arama-sayfasi">
    <div class="sonuc-basliklari">
        <a href="" class="tumu">Resim</a>
        <a href="" class="tumu">Kullanıcı Adı</a>
        <a href="" class="tumu">Üyelik Durumu</a>
    </div>
    <div class="sonuclar">
        <?php foreach ($kullanıcılar as $kullanici): ?>
            <div class="sonuc">
                <div class="sonuc-sutun"><img src="<?= get_avatar_url($kullanici->ID) ?>"></div>
                <div class="sonuc-sutun"><a href="/wp-admin/user-edit.php?user_id=<?=$kullanici->ID?>"><?= ($kullanici->user_login) ?></a></div>
                <div class="sonuc-sutun"><?php

                    $uyelik = get_user_meta($kullanici->ID,"uyelik_bitis_tarihi");

                    if($uyelik){
                        if (time() > $uyelik){
                            echo "Üyelik Sona ermiş";
                        }else{
                            echo "Premium üye";
                        }
                    }else{
                        echo "Normal Üye";
                    }

                    ?></div>
            </div>
        <?php endforeach; ?>

    </div>
</div>