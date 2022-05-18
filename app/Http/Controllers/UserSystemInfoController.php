<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\UserSystemInfoHelper;


class UserSystemInfoController extends Controller
{

    public function index()
    {
        //
        $this->getusersysteminfo();
    }

    function getusersysteminfo()
    {
        $getip = UserSystemInfoHelper::get_ip();
        $getbrowser = UserSystemInfoHelper::get_browsers();
        $getdevice = UserSystemInfoHelper::get_device();
        $getos = UserSystemInfoHelper::get_os();
        $getmac = $this->getMac();

        // echo "<center>$getip <br> $getdevice <br> $getbrowser <br> $getos</center>";
        return view('admin/tester', ['myIP' => $getip, 'getbrowser' => $getbrowser, 'getmac' => $getmac]);
    }

    public function getMac()
    {
        ob_start();
        system('ipconfig/all');
        $mycom = ob_get_contents();
        ob_clean();

        $findme = "Physical";
        $pmac = strpos($mycom, $findme);
        $mac = substr($mycom, ($pmac + 36), 17);

        return $mac;
    }
}
