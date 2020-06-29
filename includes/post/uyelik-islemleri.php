<?php


include  "../../../../../wp-load.php";

$islem = $_POST["islem"];
$user_id = intval($_POST["user_id"]);
$message = "Mesaj";

if ($islem == "1-yil-uzat"){
    if ($uyelik_bitis_tarihi = get_user_meta($user_id,"uyelik_bitis_tarihi")){
        $uyelik_bitis_tarihi = $uyelik_bitis_tarihi + (365 * 24 * 60 * 60);
        update_user_meta($user_id,"uyelik_bitis_tarihi",$uyelik_bitis_tarihi);

        $message = "1 Yıllık Üyelik Uzatıldı";

    }else{
        $uyelik_bitis_tarihi = time() + (365 * 24 * 60 * 60);
        update_user_meta($user_id,"uyelik_bitis_tarihi",$uyelik_bitis_tarihi);

        $message = "1 Yıllık Üyelik Oluşturuldu";
    }


}

if ($islem == "2-yil-uzat"){
    if ($uyelik_bitis_tarihi = get_user_meta($user_id,"uyelik_bitis_tarihi")){
        $uyelik_bitis_tarihi = $uyelik_bitis_tarihi + (365 * 24 * 60 * 60 * 2);
        update_user_meta($user_id,"uyelik_bitis_tarihi",$uyelik_bitis_tarihi);

        $message = "2 Yıllık Üyelik Oluşturuldu";
    }else{
        $uyelik_bitis_tarihi = time() + (365 * 24 * 60 * 60);
        update_user_meta($user_id,"uyelik_bitis_tarihi",$uyelik_bitis_tarihi);

        $message = "2 Yıllık Üyelik Oluşturuldu";
    }
}

if ($islem == "uyeligi-sonlandir"){
    if ($uyelik_bitis_tarihi = get_user_meta($user_id,"uyelik_bitis_tarihi")){

        $uyelik_bitis_tarihi = time();
        update_user_meta($user_id,"uyelik_bitis_tarihi",$uyelik_bitis_tarihi);

        $message = "Üyelik Sonlandırıldı";
    }else{
        $message = "Zaten Üye Değil";
    }
}


echo $message;