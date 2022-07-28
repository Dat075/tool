<?PHP
error_reporting(0);
session_start();
$cls = "-";
echo $cls;
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
$Ngay = date("d/m/Y");
$Gio = date("h:i:s");
$BBlack = "\033[1;30m";
$BRed = "\033[1;31m";
$BGreen = "\033[1;32m";
$BYellow = "\033[1;33m";
$BBlue = "\033[1;34m";
$BPurple = "\033[1;35m";
$BCyan = "\033[1;36m";
$BWhite = "\033[1;37m";
$Blue = "\033[0;34m";
$lime = "\033[1;32m";
$red = "\033[1;31m";
$xanh = "\033[1;32m";
$cyan = "\033[1;36m";
$yellow = "\033[1;33m";
$turquoise = "\033[1;34m";
$maugi = "\033[1;35m";
$white = "\033[1;37m";
$xnhac = "\033[1;96m";
$den = "\033[1;90m";
$do = "\033[1;91m";
$luc = "\033[1;92m";
$vang = "\033[1;33m";
$xduong = "\033[1;94m";
$hong = "\033[1;95m";
$trang = "\033[1;97m";
$do = "\033[1;91m";

$useragent = "Mozilla/5.0 (Linux; Android 10; SM-J610F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.1.4472.202 Mobile Safari/537.36";

$plus = "" . $btrang . "~" . $bdo . "[" . $bxla . "@" . $bdo . "] " . $btrang . "=>";
$plus2 = $trang . "~" . $do . "[" . $bxla . "@" . $do . "] " . $trang . "=> $luc";
$plus3 = "" . $btrang . "=>";

$k = "0";
$vt = "0";
echo $cls;

if (file_exists('tds.txt')) {
    @system('rm tds.txt');
}
function post($url, $tsm, $data)
{
    $mr = curl_init();
    curl_setopt_array($mr, array(
        CURLOPT_PORT => "443",
        CURLOPT_URL => "$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_COOKIEFILE => "cookietdstt.txt",
        CURLOPT_HTTPHEADER => $tsm));
    $mr2 = curl_exec($mr);
    curl_close($mr);
    $json = json_decode($mr2, true);
    return $mr2;
}
function get_link($url, $tsm)
{
    $mr = curl_init();
    curl_setopt_array($mr, array(
        CURLOPT_PORT => "443",
        CURLOPT_URL => "$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_HTTPGET => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_COOKIEFILE => "cookietdstt.txt",
        CURLOPT_HTTPHEADER => $tsm,
        CURLOPT_ENCODING => true));
    $mr2 = curl_exec($mr);
    curl_close($mr);
    $json = json_decode($mr2, true);
    return $mr2;
}
echo $cls;

function logo($sleep)
{
    echo "  \033[1;36m ██╗░░██╗██╗███████╗██╗░░░██╗
            \033[1;32m ██║░░██║██║██╔════╝██║░░░██║
            \033[1;33m ███████║██║█████╗░░██║░░░██║
            \033[1;31m ██╔══██║██║██╔══╝░░██║░░░██║   \033[1;36m▀█▀ █▀█ █▀█ █░░
            \033[1;95m ██║░░██║██║███████╗╚██████╔╝   \033[1;32m░█░ █▄█ █▄█ █▄▄
            \033[1;94m ╚═╝░░╚═╝╚═╝╚══════╝░╚═════╝░ ";
}
function line($sleep)
{
    for ($i = 0; $i <= 27; $i++) {
        echo "\033[91m-";
        usleep($sleep);
        echo "\033[97m-";
    }
    echo "\033[91m-\n";
}
logo(500);
line(10000);
if (file_exists('tktdstt.txt')) {
    $_SESSION["checktk"] = file_get_contents('tktdstt.txt');
    echo $do . "$plus " . $luc . "Bấm $vang Enter$luc Để Chạy TK $vang{$_SESSION["checktk"]}\n";
    echo $do . "$plus " . $luc . "Nhập $vang No $luc Để Nhập Nick Mới: $vang";
    $choice = trim(fgets(STDIN));

    if ($choice == 'no' or $choice == 'No') {
        @system('rm tktdstt.txt');
        @system('rm mktdstt.txt');

        echo $cls;
        logo(0);
        line(0);
        echo "$plus Tài Khoản TDS : \033[93m";
        $_SESSION["username"] = trim(fgets(STDIN));
        echo "$plus Mật Khẩu  TDS : \033[93m";
        $_SESSION['password'] = trim(fgets(STDIN));

        //goi ham nhap tk mk
    } else {
        $_SESSION["username"] = file_get_contents('tktdstt.txt');
        $_SESSION['password'] = file_get_contents('mktdstt.txt');
    }

} else {
    echo "$plus Tài Khoản TDS : \033[93m";
    $_SESSION["username"] = trim(fgets(STDIN));
    echo "$plus Mật Khẩu  TDS : \033[93m";
    $_SESSION['password'] = trim(fgets(STDIN));
}

testInternet();

do {
    if ($source == "1" || $_SESSION["username"] == "" || $_SESSION['password'] == "") {
        if (file_exists('tktdstt.txt')) {
            @system('rm tktdstt.txt');
            @system('rm mktdstt.txt');
        }
        echo "     \033[1;31mĐĂNG NHẬP THẤT BẠI ! \n";
        line(0);
        echo "$plus Tài Khoản TDS : \033[93m";
        $_SESSION["username"] = trim(fgets(STDIN));
        echo "$plus Mật Khẩu  TDS : \033[93m";
        $_SESSION['password'] = trim(fgets(STDIN));
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, 'https://traodoisub.com/scr/login.php');
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cookietdstt.txt");
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; Android 10; SM-J600G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Mobile Safari/537.36');
    $login = array('username' => $_SESSION['username'], 'password' => $_SESSION['password'], 'submit' => ' Đăng Nhập');
    curl_setopt($ch, CURLOPT_POST, count($login));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $login);
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookietdstt.txt");
    $source = curl_exec($ch);
    curl_close($ch);
} while ($source == "1" || $_SESSION["username"] == "" || $_SESSION['password'] == "");

$xxtk = fopen("tktdstt.txt", "w");
fwrite($xxtk, $_SESSION["username"]);
fclose($xxtk);

$xxmk = fopen("mktdstt.txt", "w");
fwrite($xxmk, $_SESSION['password']);
fclose($xxmk);

echo $cls;

$url = "https://traodoisub.com/scr/user.php";
$head = array("Host: traodoisub.com", "accept: application/json, text/javascript, */*; q=0.01", "x-requested-with: XMLHttpRequest", "save-data: on", "user-agent: Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.93 Mobile Safari/537.36", "sec-fetch-site: same-origin", "sec-fetch-mode: cors", "sec-fetch-dest: empty", "referer: https://traodoisub.com/home/");
$ch = curl_init();
curl_setopt_array($ch,
    array(CURLOPT_URL => $url,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_HTTPGET => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_COOKIEFILE => "cookietdstt.txt",
        CURLOPT_HTTPHEADER => $head,
        CURLOPT_ENCODING => true));
$data = curl_exec($ch);
curl_close($ch);
$json = json_decode($data, true);
$sodu = $json["xu"];
logo(0);
line(0);

$tktt = $json["idtt"];
echo $plus . "Tài Khoản   :\033[1;33m  " . $_SESSION["username"] . " \n";
echo $plus . "Xu Hiện Tại :\033[1;33m  $sodu\n";
line(0);

/// url
$url_1 = "https://traodoisub.com/view/chtiktok/";
$url_2 = "https://traodoisub.com/scr/tiktok_datnick.php";

$tsm_1 = array(
    "Host:traodoisub.com",
    "upgrade-insecure-requests:1",
    "user-agent:Mozilla/5.0 (Linux; Android 8.1.0; CPH1912 Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/97.0.4692.70 Mobile Safari/537.36",
    "accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
    "referer:https://traodoisub.com/view/setting/",

);
$tsm_2 = array(
    "Host:traodoisub.com",
    "content-length:25",
    "x-requested-with:XMLHttpRequest",
    "user-agent:Mozilla/5.0 (Linux; Android 8.1.0; CPH1912 Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/97.0.4692.70 Mobile Safari/537.36",
    "content-type:application/x-www-form-urlencoded; charset=UTF-8",
    "sec-fetch-site:same-origin",
    "sec-fetch-mode:cors",
    "sec-fetch-dest:empty",
    "referer:https://traodoisub.com/view/chtiktok/",

);

echo "\e>1;34m┌[\033[92mBạn Muốn Chạy Bằng \033[93mid Tiktok\033[92m Nào:
\e[1;34m>\033[91m[\033[93mEnter\033[91m] \033[92mTự Nhập \033[93mid \033[92mThủ Công
\e[1;34m>\033[91m[\033[93m1\033[91m] \033[92mChọn Trong Danh Sách
\e[1;34m>\033[92mChọn: \033[93m";

do {
    $kieucauhinh = trim(fgets(STDIN));
    if ($kieucauhinh != 1 && $kieucauhinh != "") {
        echo "\033[91mNhập Sai!, Nhập Lại : \033[93m";
    }
} while ($kieucauhinh != 1 && $kieucauhinh != "");

if ($kieucauhinh == 1) {
    line(0);
    while (true) {

        testInternet();

        $k++;
        $t = $t + 1;
        $ch = get_link($url_1, $tsm_1);
        $link = explode('"', explode('<th class="align-middle text-center white-space-nowrap id"><a href="', $ch)[$k])[0];
        if ($link == "") {
            break;
        } else {

            $tk = explode(' ', explode('https://www.tiktok.com/@', $link)[1])[0];
            echo $plus . "" . $luc . "Tài Khoản " . $do . "" . $k . " " . $luc . ":\033[1;32m " . $vang . "$tk \n";
        }
    }

    echo $plus . "Bạn Muốn Chạy Tài Khoản Tiktok Số Mấy : " . $do . "";

    do {
        $numch = trim(fgets(STDIN));

        if ($numch < 1 || $numch >= $k) {
            echo "\033[91mNhập Sai!, Nhập Lại : \033[93m";
        }
    } while ($numch < 1 || $numch >= $k);

    while (true) {

        testInternet();

        $k2++;
        $t = $t + 1;
        $ch = get_link($url_1, $tsm_1);
        $link = explode('"', explode('<th class="align-middle text-center white-space-nowrap id"><a href="', $ch)[$k2])[0];
        if ($link == "") {
            break;
        } else {

            if ($numch == $k2) {
                $data_1 = (explode('"', explode('class="align-middle text-center fs-0 white-space-nowrap action" id="', $ch)[$k2])[0]);
                $tkprin = explode(' ', explode('https://us.tiktok.com/@', $link)[1])[0];
                break;
            }

        }
    }
} else {
    echo $plus . "Nhập \033[93mid \033[92mTiktok \033[92m: \033[93m";
    $numch = trim(fgets(STDIN));

}

echo $cls;
logo(0);
line(0);

echo $plus . " Nhập" . $vang . " 1 " . $luc . "Nhiệm Vụ Tim \n";
echo $plus . " Nhập" . $vang . " 2 " . $luc . "Nhiệm Vụ Follow  \n";
echo "\e[1;34m┌─[\e[1;37m\e[1;42mVui Lòng Nhập Nhiệm Vụ \e[0m\e[1;34m]
└──╼[ \e[1;35m=\e[1;36m>\e[1;31m>\e[1;37m> $vang ";

do {

    $chon = trim(fgets(STDIN));
    if ($chon != "1" && $chon != "2") {
        echo "$do Nhập Sai! Nhập Lại : $vang";
    }

} while ($chon != "1" && $chon != "2");

echo "{$plus}" . $luc . "Nhận Xu Sau Bao Nhiêu Job \033[97m(\033[93mEnter = 20\033[97m) :\033[93m ";
do {
    $nxu = trim(fgets(STDIN));
    if ((is_numeric($nxu) && $nxu < 8) || (!is_numeric($nxu) && $nxu != "")) {
        echo "$do Nhập Sai! Nhập Lại (Thấp Nhất Là 8): $vang";
    }
} while ((is_numeric($nxu) && $nxu < 8) || (!is_numeric($nxu) && $nxu != ""));
if ($nxu == "") {
    $nxu = 10;
}

echo "{$plus}" . $luc . "Vui Lòng Nhập Delay \033[97m(\033[93mEnter = 0\033[97m) :\033[93m ";
do {
    $dl = trim(fgets(STDIN));
    if ((is_numeric($dl) && $dl < 0) || (!is_numeric($dl) && $dl != "")) {
        echo "$do Nhập Sai! Nhập Lại : $vang";
    }
} while ((is_numeric($dl) && $dl < 0) || (!is_numeric($dl) && $dl != ""));
if ($dl == "") {
    $dl = 0;
}


testInternet();
$chtt = 1;
do {

    if ($chtt != "1") {
        echo $plus . "Nhập \033[93mid \033[92mTiktok \033[92m: \033[93m";
        $numch = trim(fgets(STDIN));

    }

    while (true) {
        testInternet();
        $k++;
        $t = $t + 1;
        $ch = get_link($url_1, $tsm_1);
        $link = explode('"', explode('<th class="align-middle text-center white-space-nowrap id"><a href="', $ch)[$k])[0];
        if ($link == "") {
            break;
        } else {
            $tk = explode(' ', explode('https://www.tiktok.com/@', $link)[1])[0];

            $id = explode('"', explode('class="align-middle text-center fs-0 white-space-nowrap action" id="', $ch)[$k])[0];

        }

        if ($numch == $tk) {
            $data_1 = explode('"', explode('class="align-middle text-center fs-0 white-space-nowrap action" id="', $ch)[$k])[0];
            $tkprin = explode(' ', explode('https://www.tiktok.com/@', $link)[1])[0];
            break;
        }
    }
    $data_2 = "iddat=" . $data_1;
    $chtt = post($url_2, $tsm_2, $data_2);
    if ($chtt == "1") {
        echo $plus . "Cấu Hình Thành Công id :\033[1;33m $tkprin \n";
        sleep(2);
    } else {
        line(0);
        echo $plus . "Cấu Hình id :$do $data_1 Thất Bại, \033[92mNhập Sai \033[93mid Tiktok \033[92mHoặc
id \033[93m$numch \033[92mChưa Được Thêm Vào Tk \033[93m{$_SESSION["username"]}\n";
        $k = 0;

    }
} while ($chtt != "1");

echo $cls;
logo(0);
line(0);

while (true) {
    testInternet();
    if ($chon == "1") {
        $get = get_job("tiktok_like");
        $linklike = $get["data"][0]["link"];
        $idlike = $get["data"][0]["id"];

        $link = explode('?is_from_webapp=1&sender_device=pc', explode('https://www.tiktok.com/@', $linklike)[1])[0];
        if ($linklike == "") {
            echo "\r" . $plus . "Hết Job Rồi                 ";

        } else {
            $vt++;

            $Giojob = date("h:i:s");
            echo "\r\033[91m|\033[93m{$vt}\033[91m|\033[96m$Giojob\033[91m|\033[93mTIM\033[91m|\033[93m$idlike \n";
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'LIN') {

                echo $plus . "Đang Chuyển Hướng Tới Tiktok";
                @system('xdg-open https://www.tiktok.com/@' . $link);
            } else {
                echo $plus . "Đang Chuyển Hướng Tới Tiktok";
                @system('cmd /c start https://www.tiktok.com/@' . $link);
            }

            $idnhan = nhan_3($idlike);
            // $dem = $idnhan["cache"];

            if ($vt % $nxu == 0) {
                for ($m = 2; $m > -1; $m--) {
                    sleep(1);
                    echo "\r" . $plus . "Nhận Xu Sau $vang $m $luc Giây Nữa      ";

                }
                $nhan = nhan_2("tiktok_like");
                $xong = $nhan["msg"];
                $xu = get_xu();

                if (explode('thành công ', $xong)[0] == 'Nhận ') {
                    echo "\r";
                    line(0);
                    $xujob = $xu - $sodu;
                    $getxu = explode(' xu', explode('Nhận thành công ', $xong)[1])[0];
                    echo "" . $plus . "\033[92mNhận Được: \033[93m+$getxu \033[92mXu \033[91m|\033[92mJob \033[93m+$xujob\033[91m|\033[92mXu \033[93m$xu\033[91m| \n";
                    line(0);
                    if ($xong == "Nhận thành công 0 xu") {
                       
                    }
                } else {
                    line(0);
                    echo "\r \033[91m$xong\n";
                    if ($xong == "Vui lòng công khai danh sách video đã thích trên tài khoản tiktok rồi quay lại nhận!") {
                        echo "\033[92m Enter Để Chạy Tiếp: ";
                        $temp = trim(fgets(STDIN));
                    }
                    line(0);

                }

                if ($dl > 2) {
                    delay($dl - 2);
                }
            } else {
                delay($dl);
            }

        }
    } else {
        $get = get_job("tiktok_follow");
        $linksub = $get["data"][0]["link"];
        $idsub = $get["data"][0]["id"];

        $link = explode(' ', explode('https://www.tiktok.com/@', $linksub)[1])[0];
        if ($link == "") {
            echo "\r" . $plus . "Hết Job Rồi                 ";

        } else {
            $vt++;

            $Giojob = date("h:i:s");
            echo "\r                                                       ";
            echo "\r\033[91m|\033[93m{$vt}\033[91m|\033[96m$Giojob\033[91m|\033[93mFOLLOW\033[91m|\033[93m@$link \n";
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'LIN') {
                echo $plus . "Đang Chuyển Hướng Tới Tiktok";
                @system('xdg-open https://www.tiktok.com/@' . $link);
            } else {
                echo $plus . "Đang Chuyển Hướng Tới Tiktok";
                @system('cmd /c start https://www.tiktok.com/@' . $link);
            }

            $idnhan = nhan_1($idsub, "tiktok_follow", "follow");
            // $dem = $idnhan["cache"];

            if ($vt % $nxu == 0) {

                for ($m = 2; $m > -1; $m--) {
                    sleep(1);
                    echo "\r" . $plus . "Nhận Xu Sau $vang $m $luc Giây Nữa      ";

                }
                $nhan = nhan_2("tiktok_follow");
                $xong = $nhan["msg"];
                $xu = get_xu();

                if (explode('thành công ', $xong)[0] == 'Nhận ') {
                    echo "\r";
                    line(0);
                    $xujob = $xu - $sodu;
                    $getxu = explode(' xu', explode('Nhận thành công ', $xong)[1])[0];
                    echo "" . $plus . "\033[92mNhận Được: \033[93m+$getxu \033[92mXu \033[91m|\033[92mJob \033[93m+$xujob\033[91m|\033[92mXu \033[93m$xu\033[91m| \n";
                    line(0);
                    if ($xong == "Nhận thành công 0 xu") {
                    
                    }
                } else {
                    line(0);
                    echo "\r \033[91m$xong\n";
                    if ($xong == "Vui lòng công khai danh sách video đã thích trên tài khoản tiktok rồi quay lại nhận!") {
                        echo "\033[92m Enter Để Chạy Tiếp: ";
                        $temp = trim(fgets(STDIN));
                    }
                    line(0);

                }

                if ($dl > 2) {
                    delay($dl - 2);
                }
            } else {
                delay($dl);
            }
        }
    }

}

////get job

function get_job($type)
{

    $url = "https://traodoisub.com/ex/" . $type . "/load.php";
    $tsm = array(
        "Host:traodoisub.com",
        "user-agent:Mozilla/5.0 (Linux; Android 8.1.0; CPH1912 Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/97.0.4692.70 Mobile Safari/537.36",
        "accept:*/*",
        "sec-fetch-site:same-origin",
        "sec-fetch-mode:cors",
        "sec-fetch-dest:empty",
        "referer:https://traodoisub.com/ex/" . $type . "/",

    );

    $mr = curl_init();
    curl_setopt_array($mr, array(
        CURLOPT_PORT => "443",
        CURLOPT_URL => "$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_HTTPGET => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_COOKIEFILE => "cookietdstt.txt",
        CURLOPT_HTTPHEADER => $tsm,
        CURLOPT_ENCODING => true));
    $mr2 = curl_exec($mr);
    curl_close($mr);
    $json = json_decode($mr2, true);

    return $json;
}

function nhan_1($id, $type, $loai)
{
    $tsm = array(
        "Host:traodoisub.com",
        "content-length:55",
        "accept:*/*",
        "x-requested-with:XMLHttpRequest",
        "user-agent:Mozilla/5.0 (Linux; Android 8.1.0; CPH1912 Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/97.0.4692.70 Mobile Safari/537.36",
        "content-type:application/x-www-form-urlencoded; charset=UTF-8",
        "sec-fetch-site:same-origin",
        "sec-fetch-mode:cors",
        "sec-fetch-dest:empty",
        "referer:https://traodoisub.com/ex/" . $type . "/",

    );
    $url = "https://traodoisub.com/ex/" . $type . "/cache.php";
    $data = "id=" . $id . "&type=" . $loai . "";
    $mr = curl_init();
    curl_setopt_array($mr, array(
        CURLOPT_PORT => "443",
        CURLOPT_URL => "$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_COOKIEFILE => "cookietdstt.txt",
        CURLOPT_HTTPHEADER => $tsm));
    $mr2 = curl_exec($mr);
    curl_close($mr);
    $json = json_decode($mr2, true);
    return $json;
}
function nhan_2($type)
{
    $tsm = array(
        "Host:traodoisub.com",
        "content-length:18",
        "accept:*/*",
        "x-requested-with:XMLHttpRequest",
        "user-agent:Mozilla/5.0 (Linux; Android 8.1.0; CPH1912 Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/97.0.4692.70 Mobile Safari/537.36",
        "content-type:application/x-www-form-urlencoded; charset=UTF-8",
        "sec-fetch-site:same-origin",
        "sec-fetch-mode:cors",
        "sec-fetch-dest:empty",
        "referer:https://traodoisub.com/ex/" . $type . "/",

    );
    $url = "https://traodoisub.com/ex/" . $type . "/nhantien.php";
    $data = "key=0257272C744254";
    $mr = curl_init();
    curl_setopt_array($mr, array(
        CURLOPT_PORT => "443",
        CURLOPT_URL => "$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_COOKIEFILE => "cookietdstt.txt",
        CURLOPT_HTTPHEADER => $tsm));
    $mr2 = curl_exec($mr);
    curl_close($mr);
    $json = json_decode($mr2, true);
    return $json;
}

function nhan_3($id)
{
    $tsm = array(
        "Host:traodoisub.com",
        "content-length:53",
        "accept:*/*",
        "x-requested-with:XMLHttpRequest",
        "user-agent:Mozilla/5.0 (Linux; Android 8.1.0; CPH1912 Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/97.0.4692.70 Mobile Safari/537.36",
        "content-type:application/x-www-form-urlencoded; charset=UTF-8",
        "sec-fetch-site:same-origin",
        "sec-fetch-mode:cors",
        "sec-fetch-dest:empty",
        "referer:https://traodoisub.com/ex/tiktok_like/",
    );
    $url = "https://traodoisub.com/ex/tiktok_like/cache.php";
    $data = "id=$id&type=love";
    $mr = curl_init();
    curl_setopt_array($mr, array(
        CURLOPT_PORT => "443",
        CURLOPT_URL => "$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_COOKIEFILE => "cookietdstt.txt",
        CURLOPT_HTTPHEADER => $tsm));
    $mr2 = curl_exec($mr);
    curl_close($mr);
    $json = json_decode($mr2, true);
    return $json;
}
function get_xu()
{
    $url = "https://traodoisub.com/scr/user.php";
    $head = array("Host: traodoisub.com", "accept: application/json, text/javascript, */*; q=0.01", "x-requested-with: XMLHttpRequest", "save-data: on", "user-agent: Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.93 Mobile Safari/537.36", "sec-fetch-site: same-origin", "sec-fetch-mode: cors", "sec-fetch-dest: empty", "referer: https://traodoisub.com/home/");
    $ch = curl_init();
    curl_setopt_array($ch,
        array(CURLOPT_URL => $url,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_HTTPGET => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_COOKIEFILE => "cookietdstt.txt",
            CURLOPT_HTTPHEADER => $head,
            CURLOPT_ENCODING => true));
    $data = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($data, true);
    $sodu = $json["xu"];
    return $sodu;
}

function testInternet()
{

    while (!$sock = @fsockopen('www.google.com', 80)) {
        $load = "\r\033[91m Vui Lòng Kiểm Tra Kết Nối Internet";
        $string = strlen($load);for ($j = 0; $j <= $string; $j++) {
            echo $load[$j];
            usleep(5000);}
        sleep(1);
        echo "\r                                   ";
        $load = "\r\033[92m Đang Thử Kết Nối Lại...";
        $string = strlen($load);for ($j = 0; $j <= $string; $j++) {
            echo $load[$j];
            usleep(20000);}
        sleep(3);
        echo "\r                                   ";
        $load = "\r\033[92m Đang Thử Kết Nối Lại...";
        $string = strlen($load);for ($j = 0; $j <= $string; $j++) {
            echo $load[$j];
            usleep(20000);}
        sleep(3);
        echo "\r                        ";
    }

}

function delay($delay)
{
    $a = "111000";
    $b = "112000";
    if ($delay == 0) {
        $a = "0";
        $b = "0";
    }

    $plus = "\033[1;97m~\033[1;91m[\033[1;92m●\033[1;91m] \033[1;97m=> \033[1;92m";
    for ($time = $delay; $time > -1; $time--) {
        echo "\r$plus\033[1;93mHieu299\033[1;96m ~>        \033[1;95mL         \033[1;31m[\033[1;93m $time\033[1;31m ]";
        usleep($a);
        echo "\r$plus\033[1;91mHieu299\033[0;93m  ~>       \033[0;96mLO        \033[0;31m[\033[0;33m $time\033[0;31m ] ";
        usleep($a);
        echo "\r$plus\033[1;92mHieu299\033[0;91m   ~>      \033[0;93mLOA       \033[0;31m[\033[0;33m $time\033[0;31m ]  ";
        usleep($a);
        echo "\r$plus\033[1;93mHieu299\033[0;92m    ~>     \033[0;91mLOAD      \033[0;31m[\033[0;33m $time\033[0;31m ]   ";
        usleep($a);
        echo "\r$plus\033[1;94mHieu299\033[0;93m     ~>    \033[0;92mLOADI     \033[0;31m[\033[0;33m $time\033[0;31m ]    ";
        usleep($a);
        echo "\r$plus\033[1;95mHieu299\033[0;94m      ~>   \033[0;93mLOADIN    \033[0;31m[\033[0;33m $time\033[0;31m ]   ";
        usleep($a);
        echo "\r$plus\033[1;96mHieu299\033[0;95m       ~>  \033[0;94mLOADING.  \033[0;31m[\033[0;33m $time\033[0;31m ]  ";
        usleep($a);
        echo "\r$plus\033[1;93mHieu299\033[0;95m        ~> \033[0;95mLOADING.. \033[0;31m[\033[0;33m $time\033[0;31m ] ";
        usleep($a);
        echo "\r$plus\033[1;91mHieu299\033[0;95m         ~>\033[0;96mLOADING...\033[0;31m[\033[0;33m $time\033[0;31m ]";
        usleep($b);
    }
}