<?php

namespace App\Http\Utils;

class HttpUtils
{
    public static function randomUserAgent()
    {
        $aBrowser = array('Firefox', 'Safari', 'Opera', 'Flock', 'Internet Explorer', 'Seamonkey', 'Tor Browser', 'GNU IceCat', 'CriOS', 'TenFourFox',
            'SeaMonkey', 'B-l-i-t-z-B-O-T', 'Konqueror', 'Mobile', 'Konqueror', 'Netscape', 'Chrome', 'Dragon', 'SeaMonkey', 'Maxthon', 'IBrowse'
        );

        $aSystem = array('Windows 3.1', 'Windows 95', 'Windows 98', 'Windows 2000', 'Windows NT', 'Linux 2.4.22-10mdk', 'FreeBSD',
            'Windows XP', 'Windows Vista', 'Redhat Linux', 'Ubuntu', 'Fedora', 'AmigaOS', 'BackTrack Linux', 'iPad', 'BlackBerry', 'Unix',
            'CentOS Linux', 'Debian Linux', 'Macintosh', 'Android', 'iPhone', 'Windows NT 6.1', 'BeOS', 'OS 10.5', 'Nokia', 'Arch Linux',
            'Ark Linux', 'BitLinux', 'Conectiva (Mandriva)', 'CRUX Linux', 'Damn Small Linux', 'DeLi Linux', 'Ubuntu', 'BigLinux', 'Edubuntu'
        );

        $locals = array('cs-CZ', 'en-US', 'sk-SK', 'pt-BR', 'sq_AL', 'sq', 'ar_DZ', 'ar_BH', 'ar_EG', 'ar_IQ', 'ar_JO',
            'ar_KW', 'ar_LB', 'ar_LY', 'ar_MA', 'ar_OM', 'ar_QA', 'ar_SA', 'ar_SD', 'ar_SY', 'ar_TN', 'ar_AE', 'ar_YE', 'ar',
            'be_BY', 'be', 'bg_BG', 'bg', 'ca_ES', 'ca', 'zh_CN', 'zh_HK', 'zh_SG', 'zh_TW', 'zh', 'hr_HR', 'hr', 'cs_CZ', 'cs',
            'da_DK', 'da', 'nl_BE', 'nl_NL', 'nl', 'en_AU', 'en_CA', 'en_IN', 'en_IE', 'en_MT', 'en_NZ', 'en_PH', 'en_SG', 'en_ZA',
            'en_GB', 'en_US', 'en', 'et_EE', 'et', 'fi_FI', 'fi', 'fr_BE', 'fr_CA', 'fr_FR', 'fr_LU', 'fr_CH', 'fr', 'de_AT', 'de_DE'
        );

        return $aBrowser[rand(0, count($aBrowser) - 1)] . '/' . rand(1, 20) . '.' . rand(0, 20) . ' (' . $aSystem[rand(0, count($aSystem) - 1)] . ' ' . rand(1, 7) . '.' . rand(0, 9) . '; ' . $locals[rand(0, count($locals) - 1)] . ';)';
    }

    public static function getRandomProxy()
    {
//        $proxyList = [
//            '45.174.70.18:53281', '170.254.224.7:55443', '93.188.161.84:80', '103.133.26.110:8181',
//            '162.144.233.16:80', '80.48.119.28:8080', '178.205.169.210:3128', '103.232.215.194:80',
//            '66.29.154.105:3128', '187.217.54.84:80', '218.250.242.225:80', '45.142.106.194:80',
//            '51.250.80.131:80', '103.149.162.195:80', '195.80.49.237:80', '167.172.158.85:81',
//            '161.35.161.38:80', '198.41.67.18:8080', '103.149.162.194:80', '154.236.189.28:8080',
//            '91.209.11.132:80', '47.241.165.133:443', '45.144.219.165:8080', '47.241.245.186:80'
//        ];

        $proxyList = [
            "177.91.98.252:8080"
        ];
        $index = array_rand($proxyList);
        return $proxyList[$index];
    }
}
