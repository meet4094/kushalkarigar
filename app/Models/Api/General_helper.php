<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class General_helper extends Model
{
    use HasFactory;

    protected $ApiMessage;

    public function __construct()
    {
        $this->ApiMessage = new ApiMessage();
    }

    public function RequestToken($req)
    {
        $request_token = $req->header('request-token');
        $data = DB::table('users')->where('request_token', $request_token)->first();
        if (empty($request_token) || empty($data->request_token)) {
            $iRes = $this->req_token_missing_res('request_token_invalid');
            return $iRes;
        }
    }

    public function AuthToken($req)
    {
        if ($req->header('auth-token')) {
            $Authtoken = $req->header('auth-token');
        } else {
            $Authtoken = $req->auth_token;
        }
        $AuthTokenData = DB::table('user_login')->where('auth_token', $Authtoken)->first();
        if (empty($Authtoken) || empty($AuthTokenData->auth_token)) {
            $iRes = $this->auth_token_missing_res('auth_token_invalid');
            return $iRes;
        }
    }

    function _email($str)
    {
        return !filter_var($str, FILTER_VALIDATE_EMAIL);
    }

    function success_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "query_ok" : $msg;
        $msg = "success_" . $msg;
        $converted = $this->ApiMessage->messages($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 1, 'msg' => $msg);
    }

    function parameter_error_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "parameter_missing" : $msg;
        $msg = "error_" . $msg;
        $converted = $this->ApiMessage->messages($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 4, 'msg' => $msg);
    }

    function req_token_missing_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "request_token_invalid" : $msg;
        $msg = "error_" . $msg;
        $converted = $this->ApiMessage->messages($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 7, 'msg' => $msg);
    }

    function auth_token_missing_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "auth_token_invalid" : $msg;
        $msg = "error_" . $msg;
        $converted = $this->ApiMessage->messages($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 8, 'msg' => $msg);
    }
}
