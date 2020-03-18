<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Users_model;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->User = new Users_model;

    }

    public function index()
    {
        return view('User.login');
    }

    public function register()
    {
        return view('User.register');

    }

    public function registered(Request $request)
    {
        $data = [
            'user_name' => $request->name,
            'user_acc'  => $request->acc,
            'user_pwd'  => $request->password,
        ];

        $User = new Users_model;

        try {
            foreach ($data as $key => $value) {
                $this->User->$key = $value;
            }
            $this->User->save();

        } catch (\Throwable $th) {
            echo '已有註冊了';

        }

        $user     = $this->User->get_user_Data($request);
        $userinfo = json_decode(json_encode($user), 1);
        $userinfo = $userinfo[0];

        return view('User.userinfo', ['userinfo' => $userinfo]);

    }

    public function login(Request $request)
    {

        $user     = $this->User->get_user_Data($request);
        $userinfo = json_decode(json_encode($user), 1);
        if (empty($userinfo)) {
            return redirect('register');
        } else {
            $userinfo = $userinfo[0];
            return view('User.userinfo', ['userinfo' => $userinfo]);
        }

    }

}
