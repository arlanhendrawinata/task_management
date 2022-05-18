<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Helpers\UserSystemInfoHelper;

use App\Models\LoginLogs;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class LoginLogsController extends Controller
{
    //
    public function index()
    {
        //
        $title = "Log Login";

        $loginlog["allData"] = LoginLogs::all();

        $x = 0;
        $collection = new Collection();
        foreach ($loginlog["allData"] as $item2) {
            $findnama = User::where('id', $item2->user_id)->first();

            if ($findnama != null) {
                $data["UserData"][$x] = $findnama;
                $data["LoginlogData"][$x] = $item2;

                $collection->push(
                    (object)[
                        'nama' => $data["UserData"][$x]->nama,
                        'email' => $data["UserData"][$x]->email,
                        'id' => $data["LoginlogData"][$x]->id,
                        'user_id' => $data["LoginlogData"][$x]->user_id,
                        'ip_address' => $data["LoginlogData"][$x]->ip_address,
                        'mac_address' => $data["LoginlogData"][$x]->mac_address,
                        'browser' => $data["LoginlogData"][$x]->browser,
                        'created_at' => $data["LoginlogData"][$x]->created_at,
                        'updated_at' => $data["LoginlogData"][$x]->updated_at
                    ]
                );

                $x++;
            }
        };

        $collection = $collection->sortByDesc('id');
        // @dd($collection);

        return view('admin/loglogin', ['Data' => $collection, 'title' => $title]);

        // return view('admin/loglogin', ['Data' => $collection, 'title' => $title]);
    }


    function getusersysteminfo()
    {

        $getip = UserSystemInfoHelper::get_ip();
        $getbrowser = UserSystemInfoHelper::get_browsers();
        $getdevice = UserSystemInfoHelper::get_device();
        $getos = UserSystemInfoHelper::get_os();
        $getmac = $this->getMac();

        $MyUserInfo = ["ip" => $getip, "browser" => $getbrowser, "mac" => $getmac];

        return $MyUserInfo;
        // echo "<center>$getip <br> $getdevice <br> $getbrowser <br> $getos</center>";
        // return view('admin/tester', ['myIP' => $getip, 'getbrowser' => $getbrowser, 'getmac' => $getmac]);
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

    public function rememberMe($id)
    {
        $MyUserInfo = $this->getusersysteminfo();

        $currentTime = Carbon::now();


        $array = array(
            'user_id' => intval($id),
            'ip_address' => $MyUserInfo["ip"],
            'mac_address' => $MyUserInfo["mac"],
            'browser' => $MyUserInfo["browser"],
            'created_at' => $currentTime,
        );


        LoginLogs::create($array);
    }

    // public function forgetMe($id)
    // {
    //     $currentTime = Carbon::now();

    //     $user = LoginLogs::where('user_id', $id)->first();

    //     $array = array('logout_at' => $currentTime);

    //     $user->update($array);
    // }
}
