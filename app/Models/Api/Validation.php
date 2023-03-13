<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Api\General_helper;
use App\Models\Api\ApiMessage;

class Validation extends Model
{
    use HasFactory;

    protected $General_helper;
    protected $ApiMessage;

    public function __construct()
    {
        $this->General_helper = new General_helper();
        $this->ApiMessage = new ApiMessage();
        define('NUMBER_MIN_LENGTH', 10);
        define('NUMBER_MAX_LENGTH', 10);
        define('TYPE_MAX_LENGTH', 4);
    }

    public function Login($req)
    {
        $request_token = $this->General_helper->RequestToken($req);
        if ($request_token) {
            return $request_token;
        } else {
            $param = array_map('trim', $req->all());
            $keys = array_keys($param);
            if (!in_array("phone_number", $keys) || empty($param['phone_number']))
                return $this->General_helper->parameter_error_res('phone_number_missing');
            if (strlen($param['phone_number']) < NUMBER_MIN_LENGTH || strlen($param['phone_number']) > NUMBER_MAX_LENGTH)
                return $this->General_helper->parameter_error_res("phone_number_min_max_length_violate", array(NUMBER_MIN_LENGTH, NUMBER_MAX_LENGTH));
            if (!in_array("uid", $keys) || empty($param['uid']))
                return $this->General_helper->parameter_error_res('uid_missing');
            $iRes = $this->General_helper->success_res('validation_ok');
            return $iRes;
        }
    }

    public function addEmployeeForm($req)
    {
        $request_token = $this->General_helper->RequestToken($req);
        $auth_token = $this->General_helper->AuthToken($req);

        $AuthTokenData = DB::table('employee_data')->where('auth_token', $req->header('auth_token'))->first();
        if ($request_token) {
            return $request_token;
        } else if ($auth_token) {
            return $auth_token;
        } else if (!empty($AuthTokenData)) {
            return $this->General_helper->parameter_error_res('profile_all_ready_created');
        } else {
            $param = array_map('trim', $req->all());
            $keys = array_keys($param);
            if (!in_array("phone_number", $keys) || empty($param['phone_number']))
                return $this->General_helper->parameter_error_res('phone_number_missing');
            if (strlen($param['phone_number']) < NUMBER_MIN_LENGTH || strlen($param['phone_number']) > NUMBER_MAX_LENGTH)
                return $this->General_helper->parameter_error_res("phone_number_min_max_length_violate", array(NUMBER_MIN_LENGTH, NUMBER_MAX_LENGTH));
            if (!in_array("latitude", $keys) || empty($param['latitude']))
                return $this->General_helper->parameter_error_res('latitude_missing');
            if (!in_array("longitude", $keys) || empty($param['longitude']))
                return $this->General_helper->parameter_error_res('longitude_missing');
            if (!in_array("type_of_job_required", $keys) || empty($param['type_of_job_required']))
                return $this->General_helper->parameter_error_res('type_of_job_required_missing');
            if (!in_array("skill_set", $keys) || empty($param['skill_set']))
                return $this->General_helper->parameter_error_res('skill_set_missing');
            if (!in_array("work_experience", $keys) || empty($param['work_experience']))
                return $this->General_helper->parameter_error_res('work_experience_missing');
            if (!in_array("name", $keys) || empty($param['name']))
                return $this->General_helper->parameter_error_res('name_missing');
            if (!in_array("gender", $keys) || empty($param['gender']))
                return $this->General_helper->parameter_error_res('gender_missing');
            $iRes = $this->General_helper->success_res('validation_ok');
            return $iRes;
        }
    }

    public function updateEmployeeForm($req)
    {
        $Authtoken = $req->header('auth-token');

        $AuthTokenData = DB::table('employee_data')->where('auth_token', $Authtoken)->first();

        $request_token = $this->General_helper->RequestToken($req);
        $auth_token = $this->General_helper->AuthToken($req);

        if ($request_token) {
            return $request_token;
        } else if ($auth_token) {
            return $auth_token;
        } else if (empty($Authtoken) || empty($AuthTokenData->auth_token)) {
            return $this->General_helper->parameter_error_res('user_not_register');
        } else {
            $param = array_map('trim', $req->all());
            $keys = array_keys($param);
            if (!in_array("phone_number", $keys) || empty($param['phone_number']))
                return $this->General_helper->parameter_error_res('phone_number_missing');
            if (strlen($param['phone_number']) < NUMBER_MIN_LENGTH || strlen($param['phone_number']) > NUMBER_MAX_LENGTH)
                return $this->General_helper->parameter_error_res("phone_number_min_max_length_violate", array(NUMBER_MIN_LENGTH, NUMBER_MAX_LENGTH));
            if (!in_array("latitude", $keys) || empty($param['latitude']))
                return $this->General_helper->parameter_error_res('latitude_missing');
            if (!in_array("longitude", $keys) || empty($param['longitude']))
                return $this->General_helper->parameter_error_res('longitude_missing');
            if (!in_array("type_of_job_required", $keys) || empty($param['type_of_job_required']))
                return $this->General_helper->parameter_error_res('type_of_job_required_missing');
            if (!in_array("skill_set", $keys) || empty($param['skill_set']))
                return $this->General_helper->parameter_error_res('skill_set_missing');
            if (!in_array("work_experience", $keys) || empty($param['work_experience']))
                return $this->General_helper->parameter_error_res('work_experience_missing');
            if (!in_array("name", $keys) || empty($param['name']))
                return $this->General_helper->parameter_error_res('name_missing');
            if (!in_array("gender", $keys) || empty($param['gender']))
                return $this->General_helper->parameter_error_res('gender_missing');
            if (!isset($_FILES['self_picture']['error']) || $_FILES['self_picture']['error'] != 0)
                return $this->General_helper->parameter_error_res('self_picture_missing');
            if (!in_array("age", $keys) || empty($param['age']))
                return $this->General_helper->parameter_error_res('age_missing');
            if (!in_array("education", $keys) || empty($param['education']))
                return $this->General_helper->parameter_error_res('education_missing');
            if (!in_array("documents", $keys) || empty($param['documents']))
                return $this->General_helper->parameter_error_res('documents_missing');
            if (!in_array("type_of_employement", $keys) || empty($param['type_of_employement']))
                return $this->General_helper->parameter_error_res('type_of_employement_missing');
            if (!in_array("expected_salary_range", $keys) || empty($param['expected_salary_range']))
                return $this->General_helper->parameter_error_res('expected_salary_range_missing');
            if (!in_array("email_id", $keys) || empty($param['email_id']))
                return $this->General_helper->parameter_error_res('email_id_missing');
            if (in_array("email_id", $keys) && $this->General_helper->_email($param['email_id']))
                return $this->General_helper->parameter_error_res("invalid_email");
            $iRes = $this->General_helper->success_res('validation_ok');
            return $iRes;
        }
    }

    public function addEmployerForm($req)
    {
        $request_token = $this->General_helper->RequestToken($req);
        $auth_token = $this->General_helper->AuthToken($req);
        $AuthTokenData = DB::table('employer_data')->where('auth_token', $req->header('auth_token'))->first();
        if ($request_token) {
            return $request_token;
        } else if ($auth_token) {
            return $auth_token;
        } else if (!empty($AuthTokenData)) {
            return $this->General_helper->parameter_error_res('profile_all_ready_created');
        } else {
            $param = array_map('trim', $req->all());
            $keys = array_keys($param);
            if (!in_array("phone_number", $keys) || empty($param['phone_number']))
                return $this->General_helper->parameter_error_res('phone_number_missing');
            if (strlen($param['phone_number']) < NUMBER_MIN_LENGTH || strlen($param['phone_number']) > NUMBER_MAX_LENGTH)
                return $this->General_helper->parameter_error_res("phone_number_min_max_length_violate", array(NUMBER_MIN_LENGTH, NUMBER_MAX_LENGTH));
            if (!in_array("latitude", $keys) || empty($param['latitude']))
                return $this->General_helper->parameter_error_res('latitude_missing');
            if (!in_array("longitude", $keys) || empty($param['longitude']))
                return $this->General_helper->parameter_error_res('longitude_missing');
            if (!in_array("employer_name", $keys) || empty($param['employer_name']))
                return $this->General_helper->parameter_error_res('employer_name_missing');
            if (!in_array("designation", $keys) || empty($param['designation']))
                return $this->General_helper->parameter_error_res('designation_missing');
            if (!in_array("organization_name", $keys) || empty($param['organization_name']))
                return $this->General_helper->parameter_error_res('organization_name_missing');
            if (!in_array("organization_type", $keys) || empty($param['organization_type']))
                return $this->General_helper->parameter_error_res('organization_type_missing');
            $iRes = $this->General_helper->success_res('validation_ok');
            return $iRes;
        }
    }

    public function updateEmployerForm($req)
    {
        $Authtoken = $req->header('auth-token');

        $AuthTokenData = DB::table('employer_data')->where('auth_token', $Authtoken)->first();

        $request_token = $this->General_helper->RequestToken($req);
        $auth_token = $this->General_helper->AuthToken($req);

        if ($request_token) {
            return $request_token;
        } else if ($auth_token) {
            return $auth_token;
        } else if (empty($Authtoken) || empty($AuthTokenData->auth_token)) {
            return $this->General_helper->parameter_error_res('user_not_register');
        } else {
            $param = array_map('trim', $req->all());
            $keys = array_keys($param);
            if (!in_array("phone_number", $keys) || empty($param['phone_number']))
                return $this->General_helper->parameter_error_res('phone_number_missing');
            if (strlen($param['phone_number']) < NUMBER_MIN_LENGTH || strlen($param['phone_number']) > NUMBER_MAX_LENGTH)
                return $this->General_helper->parameter_error_res("phone_number_min_max_length_violate", array(NUMBER_MIN_LENGTH, NUMBER_MAX_LENGTH));
            if (!in_array("latitude", $keys) || empty($param['latitude']))
                return $this->General_helper->parameter_error_res('latitude_missing');
            if (!in_array("longitude", $keys) || empty($param['longitude']))
                return $this->General_helper->parameter_error_res('longitude_missing');
            if (!in_array("employer_name", $keys) || empty($param['employer_name']))
                return $this->General_helper->parameter_error_res('employer_name_missing');
            if (!in_array("designation", $keys) || empty($param['designation']))
                return $this->General_helper->parameter_error_res('designation_missing');
            if (!in_array("organization_name", $keys) || empty($param['organization_name']))
                return $this->General_helper->parameter_error_res('organization_name_missing');
            if (!in_array("organization_email_id", $keys) || empty($param['organization_email_id']))
                return $this->General_helper->parameter_error_res('organization_email_id_missing');
            if (in_array("organization_email_id", $keys) && $this->General_helper->_email($param['organization_email_id']))
                return $this->General_helper->parameter_error_res("invalid_email");
            if (!in_array("gst_number", $keys) || empty($param['gst_number']))
                return $this->General_helper->parameter_error_res('gst_number_missing');
            if (!in_array("gst_certificate", $keys) || empty($param['gst_certificate']))
                return $this->General_helper->parameter_error_res('gst_certificate_missing');
            if (!in_array("organization_headquarters", $keys) || empty($param['organization_headquarters']))
                return $this->General_helper->parameter_error_res('organization_headquarters_missing');
            if (!in_array("organization_size", $keys) || empty($param['organization_size']))
                return $this->General_helper->parameter_error_res('organization_size_missing');
            if (!in_array("product_type", $keys) || empty($param['product_type']))
                return $this->General_helper->parameter_error_res('product_type_missing');
            if (!in_array("categories_hiring", $keys) || empty($param['categories_hiring']))
                return $this->General_helper->parameter_error_res('categories_hiring_missing');
            if (!in_array("cities_hiring", $keys) || empty($param['cities_hiring']))
                return $this->General_helper->parameter_error_res('cities_hiring_missing');
            if (!in_array("unit_hiring_for", $keys) || empty($param['unit_hiring_for']))
                return $this->General_helper->parameter_error_res('unit_hiring_for_missing');
            if (!in_array("unit_name", $keys) || empty($param['unit_name']))
                return $this->General_helper->parameter_error_res('unit_name_missing');
            if (!in_array("unit_address", $keys) || empty($param['unit_address']))
                return $this->General_helper->parameter_error_res('unit_address_missing');
            if (!in_array("unit_poc_name", $keys) || empty($param['unit_poc_name']))
                return $this->General_helper->parameter_error_res('unit_poc_name_missing');
            if (!in_array("unit_poc_contact_number", $keys) || empty($param['unit_poc_contact_number']))
                return $this->General_helper->parameter_error_res('unit_poc_contact_number_missing');
            if (!in_array("unit_poc_email_id", $keys) || empty($param['unit_poc_email_id']))
                return $this->General_helper->parameter_error_res('unit_poc_email_id_missing');
            if (in_array("unit_poc_email_id", $keys) && $this->General_helper->_email($param['unit_poc_email_id']))
                return $this->General_helper->parameter_error_res("invalid_email");
            if (!in_array("unit_gst_number", $keys) || empty($param['unit_gst_number']))
                return $this->General_helper->parameter_error_res('unit_gst_number_missing');
            if (!in_array("unit_location", $keys) || empty($param['unit_location']))
                return $this->General_helper->parameter_error_res('unit_location_missing');
            $iRes = $this->General_helper->success_res('validation_ok');
            return $iRes;
        }
    }

    public function addPostJobForm($req)
    {
        $request_token = $this->General_helper->RequestToken($req);
        $auth_token = $this->General_helper->AuthToken($req);
        if ($request_token) {
            return $request_token;
        } else if ($auth_token) {
            return $auth_token;
        } else {
            $param = array_map('trim', $req->all());
            $keys = array_keys($param);
            if (!in_array("job_role", $keys) || empty($param['job_role']))
                return $this->General_helper->parameter_error_res('job_role_missing');
            if (!in_array("specialization", $keys) || empty($param['specialization']))
                return $this->General_helper->parameter_error_res('specialization_missing');
            if (!in_array("no_of_job_openings_for_this_role", $keys) || empty($param['no_of_job_openings_for_this_role']))
                return $this->General_helper->parameter_error_res('no_of_job_openings_for_this_role_missing');
            if (!in_array("salary_range", $keys) || empty($param['salary_range']))
                return $this->General_helper->parameter_error_res('salary_range_missing');
            if (!in_array("organization_name", $keys) || empty($param['organization_name']))
                return $this->General_helper->parameter_error_res('organization_name_missing');
            if (!in_array("job_type", $keys) || empty($param['job_type']))
                return $this->General_helper->parameter_error_res('job_type_missing');
            if (!in_array("latitude", $keys) || empty($param['latitude']))
                return $this->General_helper->parameter_error_res('latitude_missing');
            if (!in_array("longitude", $keys) || empty($param['longitude']))
                return $this->General_helper->parameter_error_res('longitude_missing');
            if (!in_array("state_domicile", $keys) || empty($param['state_domicile']))
                return $this->General_helper->parameter_error_res('state_domicile_missing');
            if (!in_array("do_you_want_to_share_contact_no_with_employee", $keys) || empty($param['do_you_want_to_share_contact_no_with_employee']))
                return $this->General_helper->parameter_error_res('do_you_want_to_share_contact_no_with_employee_missing');
            if (!in_array("mode_of_contact", $keys) || empty($param['mode_of_contact']))
                return $this->General_helper->parameter_error_res('mode_of_contact_missing');
            if (!in_array("poc_name", $keys) || empty($param['poc_name']))
                return $this->General_helper->parameter_error_res('poc_name_missing');
            if (!in_array("poc_contact_number", $keys) || empty($param['poc_contact_number']))
                return $this->General_helper->parameter_error_res('poc_contact_number_missing');
            if (!in_array("poc_email_id", $keys) || empty($param['poc_email_id']))
                return $this->General_helper->parameter_error_res('poc_email_id_missing');
            if (in_array("poc_email_id", $keys) && $this->General_helper->_email($param['poc_email_id']))
                return $this->General_helper->parameter_error_res("invalid_email");
            $iRes = $this->General_helper->success_res('validation_ok');
            return $iRes;
        }
    }

    public function getUserData($req)
    {
        $Authtoken = $req->auth_token;

        $employeeformdata = DB::table('employee_data')->where('auth_token', $Authtoken)->first();
        $employerformdata = DB::table('employer_data')->where('auth_token', $Authtoken)->first();

        if (empty($employeeformdata)) {
            $AuthTokenData = $employerformdata;
        } else {
            $AuthTokenData = $employeeformdata;
        }

        $request_token = $this->General_helper->RequestToken($req);
        $auth_token = $this->General_helper->AuthToken($req);
        if ($request_token) {
            return $request_token;
        } else if ($auth_token) {
            return $auth_token;
        } else if (empty($Authtoken) || empty($AuthTokenData->auth_token)) {
            return $this->General_helper->parameter_error_res('user_not_register');
        } else {
            $iRes = $this->General_helper->success_res('validation_ok');
            return $iRes;
        }
    }

    public function deleteUserData($req)
    {
        $request_token = $this->General_helper->RequestToken($req);
        if ($request_token) {
            return $request_token;
        } else {
            $param = array_map('trim', $req->all());
            $keys = array_keys($param);
            if (!in_array("phone_number", $keys) || empty($param['phone_number']))
                return $this->General_helper->parameter_error_res('phone_number_missing');
            if (strlen($param['phone_number']) < NUMBER_MIN_LENGTH || strlen($param['phone_number']) > NUMBER_MAX_LENGTH)
                return $this->General_helper->parameter_error_res("phone_number_min_max_length_violate", array(NUMBER_MIN_LENGTH, NUMBER_MAX_LENGTH));
            $data = DB::table('user_login')->where('phone_number', $param['phone_number'])->first();
            if (empty($data)) {
                return $this->General_helper->parameter_error_res("phone_number_not_register");
            }
            $iRes = $this->General_helper->success_res('validation_ok');
            return $iRes;
        }
    }

    public function getOtherData($req)
    {
        $request_token = $this->General_helper->RequestToken($req);
        if ($request_token) {
            return $request_token;
        } else {
            $param = array_map('trim', $req->all());
            $keys = array_keys($param);
            if (!in_array("type", $keys) || empty($param['type']))
                return $this->General_helper->parameter_error_res('type_missing');
            if (($param['type']) > TYPE_MAX_LENGTH)
                return $this->General_helper->parameter_error_res("type_max_length_violate", array(TYPE_MAX_LENGTH));
            $iRes = $this->General_helper->success_res('validation_ok');
            return $iRes;
        }
    }
}
