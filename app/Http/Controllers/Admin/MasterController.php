<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master;

class MasterController extends Controller
{
    protected $master;
    public function __construct()
    {
        $this->master = new Master();
    }

    public function dashboard(Request $req)
    {
        $data = $this->master->dashboard();
        $data['title'] = 'dashboard';
        return view('Admin.dashboard', $data);
    }

    public function employer_list(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->employer_list();
            return $data;
        }
        $data['title'] = 'employer_list';
        return view('Admin.Master.employer_list', $data);
    }

    public function block_employer(Request $req)
    {
        if ($req->ajax()) {
            $msg = $this->master->block_employer($req);
            return response()->json($msg);
        }
    }

    public function GetEmployerData(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->GetEmployerData($req);
            return $data;
        }
    }

    public function employer_profile_view($req)
    {
        if (!empty($req)) {
            $iData = $this->master->employer_profile_view($req);
            $data['data'] = $iData;
            $data['title'] = 'employer_list';
            return view('Admin.Master.employer_profile_view', $data);
        }
    }

    public function edit_employer(Request $req)
    {
        if (!empty($req)) {
            $data = $this->master->edit_employer($req);
            return $data;
        }
    }

    public function deleteEmployer(Request $req)
    {
        if (!empty($req)) {
            $msg = $this->master->deleteEmployer($req);
            return response()->json($msg);
        }
    }

    public function employee_list(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->employee_list();
            return $data;
        }
        $data['title'] = 'employee_list';
        return view('Admin.Master.employee_list', $data);
    }

    public function block_employee(Request $req)
    {
        if ($req->ajax()) {
            $msg = $this->master->block_employee($req);
            return response()->json($msg);
        }
    }

    public function employee_profile_view($req)
    {
        if (!empty($req)) {
            $iData = $this->master->employee_profile_view($req);
            $data['data'] = $iData;
            $data['title'] = 'employee_list';
            return view('Admin.Master.employee_profile_view', $data);
        }
    }

    public function GetEmployeeData(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->GetEmployeeData($req);
            return $data;
        }
    }

    public function edit_employee(Request $req)
    {
        if (!empty($req)) {
            $data = $this->master->edit_employee($req);
            return $data;
        }
    }

    public function deleteEmployee(Request $req)
    {
        if (!empty($req)) {
            $msg = $this->master->deleteEmployee($req);
            return response()->json($msg);
        }
    }

    public function job_type(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->job_type();
            return $data;
        }
        $data['title'] = 'job_type';
        return view('Admin.Master.jobs', $data);
    }

    public function add_job(Request $req)
    {
        if (!empty($req)) {
            $data = $this->master->insert_edit_job($req);
            return $data;
        }
    }

    public function GetJobData(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->GetJobData($req);
            return $data;
        }
    }
    public function get_type_of_job(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->get_type_of_job($req);
            return $data;
        }
    }

    public function deleteJob(Request $req)
    {
        if (!empty($req)) {
            $msg = $this->master->deleteJob($req);
            return response()->json($msg);
        }
    }

    public function skill_set(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->skill_set();
            return $data;
        }
        $data['title'] = 'skill_set';
        return view('Admin.Master.skills', $data);
    }

    public function add_skill(Request $req)
    {
        if (!empty($req)) {
            $data = $this->master->insert_edit_skill($req);
            return $data;
        }
    }

    public function GetSkillData(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->GetSkillData($req);
            return $data;
        }
    }

    public function get_skill_set(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->get_skill_set($req);
            return $data;
        }
    }

    public function deleteSkill(Request $req)
    {
        if (!empty($req)) {
            $msg = $this->master->deleteSkill($req);
            return response()->json($msg);
        }
    }

    public function work_experience(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->work_experience();
            return $data;
        }
        $data['title'] = 'work_experience';
        return view('Admin.Master.work_experience', $data);
    }

    public function add_experience(Request $req)
    {
        if (!empty($req)) {
            $data = $this->master->insert_edit_experience($req);
            return $data;
        }
    }

    public function deleteExperience(Request $req)
    {
        if (!empty($req)) {
            $msg = $this->master->deleteExperience($req);
            return response()->json($msg);
        }
    }

    public function GetExperienceData(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->GetExperienceData($req);
            return $data;
        }
    }

    public function get_work_experiences(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->get_work_experiences($req);
            return $data;
        }
    }

    public function expected_salary_range(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->expected_salary_range();
            return $data;
        }
        $data['title'] = 'expected_salary_range';
        return view('Admin.Master.expected_salary_range', $data);
    }

    public function add_salary_range(Request $req)
    {
        if (!empty($req)) {
            $data = $this->master->add_salary_range($req);
            return $data;
        }
    }

    public function deleteSelaryRange(Request $req)
    {
        if (!empty($req)) {
            $msg = $this->master->deleteSelaryRange($req);
            return response()->json($msg);
        }
    }

    public function GetSelaryRangeData(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->GetSelaryRangeData($req);
            return $data;
        }
    }

    public function get_expected_salary_range(Request $req)
    {
        if ($req->ajax()) {
            $data = $this->master->get_expected_salary_range($req);
            return $data;
        }
    }
}
