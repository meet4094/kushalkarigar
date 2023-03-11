<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Api\General_helper;

class Main extends Model
{
    use HasFactory;

    protected $General_helper;

    public function __construct()
    {
        $this->General_helper = new General_helper();
    }

    public function Login($req)
    {
        $phone_number = $req->phone_number;
        $userData = DB::table('user_login')->where('phone_number', $phone_number)->first();
        if (empty($userData)) {
            $auth_token = Str::random(15);
        } else {
            $auth_token = $userData->auth_token;
        }

        $employeeformdata = DB::table('employee_data')
            ->where('auth_token', $auth_token)
            ->first();
        $employerformdata = DB::table('employer_data')
            ->where('auth_token', $auth_token)
            ->first();

        if (empty($employeeformdata) && empty($employerformdata)) {
            $profile_status = 1;
        } else {
            $profile_status = 0;
        }

        $Data = array(
            'uid' => $req['uid'],
            'phone_number' => $req['phone_number'],
            'auth_token' => $auth_token,
            'profile_status' => $profile_status,
        );
        if (empty($userData)) {
            $Add_Data = array(
                'uid' => $req['uid'],
                'phone_number' => $req['phone_number'],
                'auth_token' => $auth_token,
            );
            DB::table('user_login')
                ->insert($Add_Data);
            $iRes = $this->General_helper->success_res("success");
            $iRes['data'] = $Data;
            return $iRes;
        } else {
            $iRes = $this->General_helper->success_res("success");
            $iRes['data'] = $Data;
            return $iRes;
        }
    }

    public function addEmployeeForm($req)
    {
        $auth_token = $req->header('auth_token');
        $Add_Data = array(
            'phone_number' => $req->phone_number,
            'auth_token' => $auth_token,
            'latitude' => $req->latitude,
            'longitude' => $req->longitude,
            'type_of_job_required' => $req->type_of_job_required,
            'skill_set' => $req->skill_set,
            'work_experience' => $req->work_experience,
            'name' => $req->name,
            'gender' => $req->gender,
            'self_picture' => "",
            'age' => "",
            'education' => "",
            'documents' => "",
            'type_of_employement' => "",
            'expected_salary_range' => "",
        );
        DB::table('employee_data')
        ->insert($Add_Data);
        $Data = array(
            'phone_number' => $req->phone_number,
            'latitude' => $req->latitude,
            'longitude' => $req->longitude,
            'type_of_job_required' => json_decode($req->type_of_job_required),
            'skill_set' => json_decode($req->skill_set),
            'work_experience' => $req->work_experience,
            'name' => $req->name,
            'gender' => $req->gender,
        );
        $iRes = $this->General_helper->success_res("success");
        $iRes['data'] = $Data;
        return $iRes;
    }

    public function updateEmployeeForm($req)
    {
        $auth_token = $req->header('auth_token');

        $self_picture = $req->self_picture;
        $self_pictureextension = $self_picture->extension();
        $self_picturefileName = md5(uniqid() . time()) . '.' . $self_pictureextension;
        $self_picturefileNamefile = file_get_contents($self_picture);
        file_put_contents(public_path('images/selfpicture/') . $self_picturefileName, $self_picturefileNamefile);

        $documents = $req->documents;
        $documentsextension = $documents->extension();
        $documentsfileName = md5(uniqid() . time()) . '.' . $documentsextension;
        $documentsfileNamefile = file_get_contents($documents);
        file_put_contents(public_path('images/documents/') . $documentsfileName, $documentsfileNamefile);
        $AddData = array(
            'phone_number' => $req->phone_number,
            'latitude' => $req->latitude,
            'longitude' => $req->longitude,
            'type_of_job_required' => $req->type_of_job_required,
            'skill_set' => $req->skill_set,
            'work_experience' => $req->work_experience,
            'name' => $req->name,
            'gender' => $req->gender,
            'self_picture' => $self_picturefileName,
            'age' => $req->age,
            'education' => $req->education,
            'documents' => $documentsfileName,
            'type_of_employement' => $req->type_of_employement,
            'expected_salary_range' => $req->expected_salary_range,
        );
        DB::table('employee_data')
            ->where('auth_token', $auth_token)
            ->update($AddData);
        $Data = array(
            'phone_number' => $req->phone_number,
            'latitude' => $req->latitude,
            'longitude' => $req->longitude,
            'type_of_job_required' => json_decode($req->type_of_job_required),
            'skill_set' => json_decode($req->skill_set),
            'work_experience' => $req->work_experience,
            'name' => $req->name,
            'gender' => $req->gender,
            'self_picture' => asset('images/selfpicture') . '/' . $self_picturefileName,
            'age' => $req->age,
            'education' => $req->education,
            'documents' => asset('images/documents') . '/' . $documentsfileName,
            'type_of_employement' => $req->type_of_employement,
            'expected_salary_range' => $req->expected_salary_range,
        );
        $iRes = $this->General_helper->success_res("success");
        $iRes['data'] = $Data;
        return $iRes;
    }

    public function addEmployerForm($req)
    {
        $auth_token = $req->header('auth_token');
        $AddData = array(
            'phone_number' => $req->phone_number,
            'auth_token' => $auth_token,
            'latitude' => $req->latitude,
            'longitude' => $req->longitude,
            'employer_name' => $req->employer_name,
            'designation' => $req->designation,
            'organization_name' => $req->organization_name,
            'organization_type' => $req->organization_type,
            'organization_email_id' => "",
            'gst_number' => "",
            'gst_certificate' => "",
            'organization_headquarters' => "",
            'organization_size' => "",
            'product_type' => "",
            'categories_hiring' => "",
            'cities_hiring' => "",
            'unit_hiring_for' => "",
            'unit_name' => "",
            'unit_address' => "",
            'unit_poc_name' => "",
            'unit_poc_contact_number' => "",
            'unit_poc_email_id' => "",
            'unit_gst_number' => "",
            'unit_location' => "",
        );
        DB::table('employer_data')
            ->insert($AddData);
        $Data = array(
            'phone_number' => $req->phone_number,
            'latitude' => $req->latitude,
            'longitude' => $req->longitude,
            'employer_name' => $req->employer_name,
            'designation' => $req->designation,
            'organization_name' => $req->organization_name,
            'organization_type' => $req->organization_type,
            // 'organization_email_id' => $req->organization_email_id,
            // 'gst_number' => $req->gst_number,
            // 'gst_certificate' => $req->gst_certificate,
            // 'organization_headquarters' => $req->organization_headquarters,
            // 'organization_size' => $req->organization_size,
            // 'product_type' => $req->product_type,
            // 'categories_hiring' => $req->categories_hiring,
            // 'cities_hiring' => $req->cities_hiring,
            // 'unit_hiring_for' => $req->unit_hiring_for,
            // 'unit_name' => $req->unit_name,
            // 'unit_address' => $req->unit_address,
            // 'unit_poc_name' => $req->unit_poc_name,
            // 'unit_poc_contact_number' => $req->unit_poc_contact_number,
            // 'unit_poc_email_id' => $req->unit_poc_email_id,
            // 'unit_gst_number' => $req->unit_gst_number,
            // 'unit_location' => $req->unit_location,
        );
        $iRes = $this->General_helper->success_res("success");
        $iRes['data'] = $Data;
        return $iRes;
    }

    public function addPostJobForm($req)
    {
        $auth_token = $req->header('auth_token');
        $Add_Data = array(
            'auth_token' => $auth_token,
            'job_role' => $req->job_role,
            'specialization' => $req->specialization,
            'no_of_job_openings_for_this_role' => $req->no_of_job_openings_for_this_role,
            'salary_range' => $req->salary_range,
            'job_type' => $req->job_type,
            'job_location' => $req->job_location,
            'do_you_want_to_share_contact_no_with_employee' => $req->do_you_want_to_share_contact_no_with_employee,
            'mode_of_contact' => $req->mode_of_contact,
            'organization_name' => $req->organization_name,
            'state_domicile' => $req->organization_name,
            'poc_name' => $req->poc_name,
            'poc_contact_number' => $req->poc_contact_number,
            'poc_email_id' => $req->poc_email_id,
        );
        DB::table('post_job_data')
            ->insert($Add_Data);
        $Data = array(
            'job_role' => $req->job_role,
            'specialization' => $req->specialization,
            'no_of_job_openings_for_this_role' => $req->no_of_job_openings_for_this_role,
            'salary_range' => $req->salary_range,
            'job_type' => $req->job_type,
            'job_location' => $req->job_location,
            'do_you_want_to_share_contact_no_with_employee' => $req->do_you_want_to_share_contact_no_with_employee,
            'mode_of_contact' => $req->mode_of_contact,
            'organization_name' => $req->organization_name,
            'state_domicile' => $req->state_domicile,
            'poc_name' => $req->poc_name,
            'poc_contact_number' => $req->poc_contact_number,
            'poc_email_id' => $req->poc_email_id,
        );
        $iRes = $this->General_helper->success_res("success");
        $iRes['data'] = $Data;
        return $iRes;
    }

    public function updateEmployerForm($req)
    {
        $auth_token = $req->header('auth_token');
        $AddData = array(
            'phone_number' => $req->phone_number,
            'latitude' => $req->latitude,
            'longitude' => $req->longitude,
            'employer_name' => $req->employer_name,
            'designation' => $req->designation,
            'organization_name' => $req->organization_name,
            'organization_type' => $req->organization_type,
            'organization_email_id' => $req->organization_email_id,
            'gst_number' => $req->gst_number,
            'gst_certificate' => $req->gst_certificate,
            'organization_headquarters' => $req->organization_headquarters,
            'organization_size' => $req->organization_size,
            'product_type' => $req->product_type,
            'categories_hiring' => $req->categories_hiring,
            'cities_hiring' => $req->cities_hiring,
            'unit_hiring_for' => $req->unit_hiring_for,
            'unit_name' => $req->unit_name,
            'unit_address' => $req->unit_address,
            'unit_poc_name' => $req->unit_poc_name,
            'unit_poc_contact_number' => $req->unit_poc_contact_number,
            'unit_poc_email_id' => $req->unit_poc_email_id,
            'unit_gst_number' => $req->unit_gst_number,
            'unit_location' => $req->unit_location,
        );
        DB::table('employer_data')
            ->where('auth_token', $auth_token)
            ->update($AddData);
        $Data = array(
            'phone_number' => $req->phone_number,
            'latitude' => $req->latitude,
            'longitude' => $req->longitude,
            'employer_name' => $req->employer_name,
            'designation' => $req->designation,
            'organization_name' => $req->organization_name,
            'organization_type' => $req->organization_type,
            'organization_email_id' => $req->organization_email_id,
            'gst_number' => $req->gst_number,
            'gst_certificate' => $req->gst_certificate,
            'organization_headquarters' => $req->organization_headquarters,
            'organization_size' => $req->organization_size,
            'product_type' => $req->product_type,
            'categories_hiring' => $req->categories_hiring,
            'cities_hiring' => $req->cities_hiring,
            'unit_hiring_for' => $req->unit_hiring_for,
            'unit_name' => $req->unit_name,
            'unit_address' => $req->unit_address,
            'unit_poc_name' => $req->unit_poc_name,
            'unit_poc_contact_number' => $req->unit_poc_contact_number,
            'unit_poc_email_id' => $req->unit_poc_email_id,
            'unit_gst_number' => $req->unit_gst_number,
            'unit_location' => $req->unit_location,
        );
        $iRes = $this->General_helper->success_res("success");
        $iRes['data'] = $Data;
        return $iRes;
    }

    public function getUserData($req)
    {
        $auth_token = $req->auth_token;
        $employeeformdata = DB::table('employee_data')->where('auth_token', $auth_token)
            ->first();
        $employerformdata = DB::table('employer_data')->where('auth_token', $auth_token)
            ->first();

        if (empty($employeeformdata)) {
            $Data = array(
                'user_type' => 1,
                'phone_number' => $employerformdata->phone_number,
                'latitude' => $employerformdata->latitude,
                'longitude' => $employerformdata->longitude,
                'employer_name' => $employerformdata->employer_name,
                'designation' => $employerformdata->designation,
                'organization_name' => $employerformdata->organization_name,
                'organization_type' => $employerformdata->organization_type,
                'organization_email_id' => $employerformdata->organization_email_id,
                'gst_number' => $employerformdata->gst_number,
                'gst_certificate' => $employerformdata->gst_certificate,
                'organization_headquarters' => $employerformdata->organization_headquarters,
                'organization_size' => $employerformdata->organization_size,
                'product_type' => $employerformdata->product_type,
                'categories_hiring' => $employerformdata->categories_hiring,
                'cities_hiring' => $employerformdata->cities_hiring,
                'unit_hiring_for' => $employerformdata->unit_hiring_for,
                'unit_name' => $employerformdata->unit_name,
                'unit_address' => $employerformdata->unit_address,
                'unit_poc_name' => $employerformdata->unit_poc_name,
                'unit_poc_contact_number' => $employerformdata->unit_poc_contact_number,
                'unit_poc_email_id' => $employerformdata->unit_poc_email_id,
                'unit_gst_number' => $employerformdata->unit_gst_number,
                'unit_location' => $employerformdata->unit_location,
                'profile_status' => $employerformdata->is_del
            );
            $iRes = $this->General_helper->success_res("success");
            $iRes['data'] = $Data;
            return $iRes;
        } else {
            $Data = array(
                'user_type' => 0,
                'phone_number' => $employeeformdata->phone_number,
                'latitude' => $employeeformdata->latitude,
                'longitude' => $employeeformdata->longitude,
                'type_of_job_required' => json_decode($employeeformdata->type_of_job_required),
                'skill_set' => json_decode($employeeformdata->skill_set),
                'work_experience' => $employeeformdata->work_experience,
                'name' => $employeeformdata->name,
                'gender' => $employeeformdata->gender,
                'self_picture' => $employeeformdata->self_picture ? asset('images/selfpicture') . '/' . $employeeformdata->self_picture : '',
                'age' => $employeeformdata->age,
                'education' => $employeeformdata->education,
                'documents' => $employeeformdata->documents ? asset('images/documents') . '/' . $employeeformdata->documents : '',
                'type_of_employement' => $employeeformdata->type_of_employement,
                'expected_salary_range' => $employeeformdata->expected_salary_range,
                'profile_status' => $employeeformdata->is_del
            );
            $iRes = $this->General_helper->success_res("success");
            $iRes['data'] = $Data;
            return $iRes;
        }
    }

    public function getOtherData($req)
    {
        if ($req->type == 1) {
            $Jobs_Data = DB::table('jobs')
                ->select('id', 'job_name')
                ->where('is_deleted', '0')
                ->get();
            $iRes = $this->General_helper->success_res("success");
            $iRes['type_of_job_required'] = $Jobs_Data;
            return $iRes;
        } else if ($req->type == 2) {
            $Skills_Data = DB::table('skills')
                ->select('id', 'skill_name')
                ->where('is_deleted', '0')
                ->get();
            $iRes = $this->General_helper->success_res("success");
            $iRes['skill_set'] = $Skills_Data;
            return $iRes;
        } else if ($req->type == 3) {
            $Skills_Data = DB::table('work_experiences')
                ->select('id', 'experience')
                ->where('is_deleted', '0')
                ->get();
            $iRes = $this->General_helper->success_res("success");
            $iRes['work_experience'] = $Skills_Data;
            return $iRes;
        } else if ($req->type == 4) {
            $Skills_Data = DB::table('expected_salary_range')
                ->select('id', 'salary_range')
                ->where('is_deleted', '0')
                ->get();
            $iRes = $this->General_helper->success_res("success");
            $iRes['expected_salary_range'] = $Skills_Data;
            return $iRes;
        }
    }
}
