<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Master extends Model
{
    public function dashboard()
    {
        $data['employer_data'] = DB::table('employer_data')->where(array('is_del' => 0))->count('id');
        $data['employee_data'] = DB::table('employee_data')->where(array('is_del' => 0))->count('id');
        $data['jobs'] = DB::table('jobs')->where(array('is_deleted' => 0))->count('id');
        $data['skills'] = DB::table('skills')->where(array('is_deleted' => 0))->count('id');
        $data['work_experiences'] = DB::table('work_experiences')->where(array('is_deleted' => 0))->count('id');
        $data['expected_salary_range'] = DB::table('expected_salary_range')->where(array('is_deleted' => 0))->count('id');
        return $data;
    }

    public function employer_list()
    {
        $data = DB::table('employer_data')->where(array('is_del' => 0))
            ->select('id', 'employer_name', 'phone_number', 'is_block')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('is_block', function ($row) {

                $blockarray = array("1" => "Blocked", "0" => "Unblock");
                $color = array("1" => "danger", "0" => "success");
                $blockresult = '<a style="cursor: pointer; border-radius: 20px; padding: 8px 12px;" class="badge badge-' . $color[$row->is_block] . '" target="_blank"   title="Name : ' . $row->employer_name . '" onclick="editable_block(this)"  data-val="' . $row->is_block . '"  data-id="' . $row->id . '" tabindex="-1"  >' . $blockarray[$row->is_block] . '</a>';

                return $blockresult;
            })
            ->addColumn('action', function ($row) {
                $view_btn = '<a href="employer_profile_view/' . $row->id . '" title="' . $row->employer_name . '" class="btn btn-link"><i class="fas fa-eye "></i></a>';
                $update_btn = '<button title="' . $row->employer_name . '" class="btn btn-link" onclick="edit_employer(this)" data-val="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                $delete_btn = '<button data-toggle="modal" target="_blank"  title="' . $row->employer_name . '" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '"><i class="fa fa-trash-alt tx-danger"></i></button>';
                return $view_btn . $update_btn . $delete_btn;
            })
            ->rawColumns(['is_block', 'action'])
            ->make(true);
    }

    public function block_employer($req)
    {
        if ($req->type == 'Block' && !empty($req->employer_id)) {
            $employer_id = $req->post('employer_id');
            if ($req->data_val == 0) {
                DB::table('employer_data')->where('id', $employer_id)->update(array('is_block' => 1));
                $response['success'] = 1;
                $response['title'] = 'Blocked!';
                $response['msg'] = 'Blocked successfully';
            } else if ($req->data_val == 1) {
                DB::table('employer_data')->where('id', $employer_id)->update(array('is_block' => 0));
                $response['success'] = 1;
                $response['title'] = 'Unblocked!';
                $response['msg'] = 'Unblocked successfully';
            } else {
                $response['success'] = 0;
                $response['msg'] = 'Failed';
            }
            return $response;
        }
    }

    public function GetEmployerData($req)
    {
        if (!empty($req)) {
            $data = DB::table('employer_data')->where(array('id' => $req->employer_id))
                ->select('*')
                ->first();
            $response = array('st' => "success", "msg" => $data);
            return response()->json($response);
        }
    }

    public function employer_profile_view($req)
    {
        if (!empty($req)) {
            $data = DB::table('employer_data')->where(array('id' => $req))
                ->select('*')
                ->first();
            return $data;
        }
    }

    public function edit_employer($req)
    {
        $rules = array(
            'employer_name' => 'required',
            'phone_number' => 'required',
            'designation' => 'required',
            'organization_name' => 'required',
            'organization_type' => 'required',
            'organization_email_id' => 'required',
            'organization_headquarters' => 'required',
            'organization_size' => 'required',
            'gst_number' => 'required',
            'gst_certificate' => 'required',
            'product_type' => 'required',
            'categories_hiring' => 'required',
            'cities_hiring' => 'required',
            'unit_hiring_for' => 'required',
            'unit_name' => 'required',
            'unit_address' => 'required',
            'unit_poc_name' => 'required',
            'unit_poc_contact_number' => 'required',
            'unit_poc_email_id' => 'required',
            'unit_gst_number' => 'required',
            'unit_location' => 'required',
        );
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);
        } else {
            $data = array(
                'employer_name' => $req->employer_name,
                'phone_number' => $req->phone_number,
                'designation' => $req->designation,
                'organization_name' => $req->organization_name,
                'organization_type' => $req->organization_type,
                'organization_email_id' => $req->organization_email_id,
                'organization_headquarters' => $req->organization_headquarters,
                'organization_size' => $req->organization_size,
                'gst_number' => $req->gst_number,
                'gst_certificate' => $req->gst_certificate,
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
            if (!empty($req->employer_id)) {
                DB::table('employer_data')->where('id', $req->employer_id)->update($data);
                return response()->json(['st' => 'success', 'msg' => 'Employer update successfully']);
            }
        }
    }

    public function deleteEmployer($req)
    {
        $employer_id = $req->post('employer_id');
        $employer_data = DB::table('employer_data')->where('id', $employer_id)->delete();
        if ($employer_data) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Failed to delete';
        }
        return $response;
    }

    public function employee_list()
    {
        $data = DB::table('employee_data')->where(array('is_del' => 0))
            ->select('id', 'name', 'is_block', 'phone_number', 'email_id')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('is_block', function ($row) {

                $blockarray = array("1" => "Blocked", "0" => "Unblock");
                $color = array("1" => "danger", "0" => "success");
                $blockresult = '<a style="cursor: pointer; border-radius: 20px; padding: 8px 12px;" class="badge badge-' . $color[$row->is_block] . '" target="_blank"   title="Name : ' . $row->name . '" onclick="editable_block(this)"  data-val="' . $row->is_block . '"  data-id="' . $row->id . '" tabindex="-1"  >' . $blockarray[$row->is_block] . '</a>';

                return $blockresult;
            })
            ->addColumn('action', function ($row) {
                $view_btn = '<a href="employee_profile_view/' . $row->id . '" title="' . $row->name . '" class="btn btn-link"><i class="fas fa-eye "></i></a>';
                $update_btn = '<button title="' . $row->name . '" class="btn btn-link" onclick="edit_employee(this)" data-val="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                $delete_btn = '<button data-toggle="modal" target="_blank"  title="' . $row->name . '" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '"><i class="fa fa-trash-alt tx-danger"></i></button>';
                return $view_btn . $update_btn . $delete_btn;
            })
            ->rawColumns(['is_block', 'action'])
            ->make(true);
    }

    public function block_employee($req)
    {
        if ($req->type == 'Block' && !empty($req->employee_id)) {
            $employee_id = $req->post('employee_id');
            if ($req->data_val == 0) {
                DB::table('employee_data')->where('id', $employee_id)->update(array('is_block' => 1));
                $response['success'] = 1;
                $response['title'] = 'Blocked!';
                $response['msg'] = 'Blocked successfully';
            } else if ($req->data_val == 1) {
                DB::table('employee_data')->where('id', $employee_id)->update(array('is_block' => 0));
                $response['success'] = 1;
                $response['title'] = 'Unblocked!';
                $response['msg'] = 'Unblocked successfully';
            } else {
                $response['success'] = 0;
                $response['msg'] = 'Failed';
            }
            return $response;
        }
    }

    public function employee_profile_view($req)
    {
        if (!empty($req)) {
            $alldata = DB::table('employee_data as ed')
                ->join('work_experiences as w', 'w.id', '=', 'ed.work_experience')
                ->where(array('ed.id' => $req))
                ->select('ed.*', 'w.experience')
                ->first();

            $jobtypes = json_decode($alldata->type_of_job_required);
            $skills = json_decode($alldata->skill_set);

            $jobtypesdata = array();
            foreach ($jobtypes as $jobtype) {
                $data = DB::table('jobs')
                    ->where(array('id' => $jobtype))
                    ->select('id', 'job_name')
                    ->first();
                $jobtypesdata[] = $data;
            }

            $skillsdata = array();
            foreach ($skills as $skill) {
                $data = DB::table('skills')
                    ->where(array('id' => $skill))
                    ->select('id', 'skill_name')
                    ->first();
                $skillsdata[] = $data;
            }
            $data = array();
            $data = [
                'id' => $alldata->id,
                'phone_number' => $alldata->phone_number,
                'latitude' => $alldata->latitude,
                'longitude' => $alldata->longitude,
                'type_of_job_required' => $jobtypesdata,
                'skill_set' => $skillsdata,
                'work_experience' => $alldata->work_experience,
                'experience' => $alldata->experience,
                'name' => $alldata->name,
                'gender' => $alldata->gender,
                'self_picture' => asset('images/selfpicture/' . $alldata->self_picture),
                'age' => $alldata->age,
                'education' => $alldata->education,
                'type_of_employement' => $alldata->type_of_employement,
                'expected_salary_range' => $alldata->expected_salary_range,
                'email_id' => $alldata->email_id,
            ];
            return $data;
        }
    }

    public function GetEmployeeData($req)
    {
        if (!empty($req)) {
            $alldata = DB::table('employee_data as ed')
                ->join('work_experiences as w', 'w.id', '=', 'ed.work_experience')
                ->where(array('ed.id' => $req->employee_id))
                ->select('ed.*', 'w.experience')
                ->first();

            $jobtypes = json_decode($alldata->type_of_job_required);
            $skills = json_decode($alldata->skill_set);

            $jobtypesdata = array();
            foreach ($jobtypes as $jobtype) {
                $data = DB::table('jobs')
                    ->where(array('id' => $jobtype))
                    ->select('id', 'job_name')
                    ->first();
                $jobtypesdata[] = $data;
            }

            $skillsdata = array();
            foreach ($skills as $skill) {
                $data = DB::table('skills')
                    ->where(array('id' => $skill))
                    ->select('id', 'skill_name')
                    ->first();
                $skillsdata[] = $data;
            }
            $data = array();
            $data = [
                'id' => $alldata->id,
                'phone_number' => $alldata->phone_number,
                'type_of_job_required' => $jobtypesdata,
                'skill_set' => $skillsdata,
                'work_experience' => $alldata->work_experience,
                'experience' => $alldata->experience,
                'name' => $alldata->name,
                'gender' => $alldata->gender,
                'age' => $alldata->age,
                'education' => $alldata->education,
                'type_of_employement' => $alldata->type_of_employement,
                'expected_salary_range' => $alldata->expected_salary_range,
                'email_id' => $alldata->email_id,
            ];
            $response = array('st' => "success", "msg" => $data);
            return response()->json($response);
        }
    }

    public function edit_employee($req)
    {
        $rules = array(
            'phone_number' => 'required',
            'name' => 'required',
            'email_id' => 'required',
            'type_of_job_required' => 'required',
            'skill_set' => 'required',
            'work_experiences' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'education' => 'required',
            'type_of_employement' => 'required',
            'expected_salary_range' => 'required',
        );
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);
        } else {
            $data = array(
                'phone_number' => $req->phone_number,
                'name' => $req->name,
                'email_id' => $req->email_id ? $req->email_id : ' ',
                'type_of_job_required' => $req->type_of_job_required,
                'skill_set' => $req->skill_set,
                'work_experience' => $req->work_experiences,
                'gender' => $req->gender,
                'age' => $req->age ? $req->age : ' ',
                'education' => $req->education,
                'type_of_employement' => $req->type_of_employement ? $req->type_of_employement : ' ',
                'expected_salary_range' => $req->expected_salary_range,
            );
            if (!empty($req->employee_id)) {
                DB::table('employee_data')->where('id', $req->employee_id)->update($data);
                return response()->json(['st' => 'success', 'msg' => 'Employee update successfully']);
            }
        }
    }

    public function deleteEmployee($req)
    {
        $employee_id = $req->post('employee_id');
        $employee_data = DB::table('employee_data')->where('id', $employee_id)->delete();
        if ($employee_data) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Failed to delete';
        }
        return $response;
    }

    public function job_type()
    {
        $data = DB::table('jobs')->where(array('is_deleted' => 0))
            ->select('*')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $update_btn = '<button title="' . $row->job_name . '" class="btn btn-link" onclick="edit_job(this)" data-val="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                $delete_btn = '<button data-toggle="modal" target="_blank"  title="' . $row->job_name . '" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '"><i class="fa fa-trash-alt tx-danger"></i></button>';
                return $update_btn . $delete_btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function insert_edit_job($req)
    {
        $rules = array(
            'job_name' => 'required',
        );
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);
        } else {
            $data = array(
                'job_name' => $req->job_name
            );
            if (empty($req->job_id)) {
                $data['created_at'] = date('Y-m-d H:i');
                $data['created_by'] = Auth::User()->id;
                DB::table('jobs')->insert($data);
                return response()->json(['st' => 'success', 'msg' => 'Job has been added',]);
            } else {
                $data['updated_at'] = date('Y-m-d H:i');
                $data['updated_by'] = Auth::User()->id;
                DB::table('jobs')->where('id', $req->job_id)->update($data);
                return response()->json(['st' => 'success', 'msg' => 'Job update successfully']);
            }
        }
    }

    public function GetJobData($req)
    {
        if (!empty($req)) {
            $data = DB::table('jobs')->where(array('id' => $req->job_id))
                ->select('*')
                ->first();
            $response = array('st' => "success", "msg" => $data);
            return response()->json($response);
        }
    }

    public function get_type_of_job($req)
    {
        $search = $req->searchTerm;
        if ($search == '') {
            $jobs = DB::table('jobs')->where(array('is_deleted' => 0))->select('id', 'job_name')->get();
        } else {
            $jobs = DB::table('jobs')->select('id', 'job_name')->where('job_name', 'like', '%' . $search . '%')->where('is_deleted', 0)->limit(10)->get();
        }

        $response = array();
        foreach ($jobs as $data) {
            $response[] = array(
                "id" => $data->id,
                "text" => $data->job_name
            );
        }
        return response()->json($response);
    }

    public function deleteJob($req)
    {
        $job_id = $req->post('job_id');
        $job_data = DB::table('jobs')->where('id', $job_id)->delete();
        if ($job_data) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Failed to delete';
        }
        return $response;
    }

    public function skill_set()
    {
        $data = DB::table('skills')->where(array('is_deleted' => 0))
            ->select('*')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $update_btn = '<button title="' . $row->skill_name . '" class="btn btn-link" onclick="edit_skill(this)" data-val="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                $delete_btn = '<button data-toggle="modal" target="_blank"  title="' . $row->skill_name . '" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '"><i class="fa fa-trash-alt tx-danger"></i></button>';
                return $update_btn . $delete_btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function insert_edit_skill($req)
    {
        $rules = array(
            'skill_name' => 'required',
        );
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);
        } else {
            $data = array(
                'skill_name' => $req->skill_name
            );
            if (empty($req->skill_id)) {
                $data['created_at'] = date('Y-m-d H:i');
                $data['created_by'] = Auth::User()->id;
                DB::table('skills')->insert($data);
                return response()->json(['st' => 'success', 'msg' => 'Skill has been added',]);
            } else {
                $data['updated_at'] = date('Y-m-d H:i');
                $data['updated_by'] = Auth::User()->id;
                DB::table('skills')->where('id', $req->skill_id)->update($data);
                return response()->json(['st' => 'success', 'msg' => 'Skill update successfully']);
            }
        }
    }

    public function GetSkillData($req)
    {
        if (!empty($req)) {
            $data = DB::table('skills')->where(array('id' => $req->skill_id))
                ->select('*')
                ->first();
            $response = array('st' => "success", "msg" => $data);
            return response()->json($response);
        }
    }

    public function get_skill_set($req)
    {
        $search = $req->searchTerm;
        if ($search == '') {
            $skills = DB::table('skills')->where(array('is_deleted' => 0))->select('id', 'skill_name')->get();
        } else {
            $skills = DB::table('skills')->select('id', 'skill_name')->where('skill_name', 'like', '%' . $search . '%')->where('is_deleted', 0)->limit(10)->get();
        }

        $response = array();
        foreach ($skills as $data) {
            $response[] = array(
                "id" => $data->id,
                "text" => $data->skill_name
            );
        }
        return response()->json($response);
    }

    public function deleteSkill($req)
    {
        $skill_id = $req->post('skill_id');
        $skill_data = DB::table('skills')->where('id', $skill_id)->delete();
        if ($skill_data) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Failed to delete';
        }
        return $response;
    }

    public function work_experience()
    {
        $data = DB::table('work_experiences')->where(array('is_deleted' => 0))
            ->select('id', 'experience')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $update_btn = '<button title="' . $row->experience . '" class="btn btn-link" onclick="edit_exprience(this)" data-val="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                $delete_btn = '<button data-toggle="modal" target="_blank"  title="' . $row->experience . '" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '"><i class="fa fa-trash-alt tx-danger"></i></button>';
                return $update_btn . $delete_btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function insert_edit_experience($req)
    {
        $rules = array(
            'experience' => 'required',
        );
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);
        } else {
            $data = array(
                'experience' => $req->experience
            );
            if (empty($req->experience_id)) {
                $data['created_at'] = date('Y-m-d H:i');
                $data['created_by'] = Auth::User()->id;
                DB::table('work_experiences')->insert($data);
                return response()->json(['st' => 'success', 'msg' => 'Experience has been added',]);
            } else {
                $data['updated_at'] = date('Y-m-d H:i');
                $data['updated_by'] = Auth::User()->id;
                DB::table('work_experiences')->where('id', $req->experience_id)->update($data);
                return response()->json(['st' => 'success', 'msg' => 'Experience update successfully']);
            }
        }
    }

    public function GetExperienceData($req)
    {
        if (!empty($req)) {
            $data = DB::table('work_experiences')->where(array('id' => $req->experience_id))
                ->select('*')
                ->first();
            $response = array('st' => "success", "msg" => $data);
            return response()->json($response);
        }
    }

    public function deleteExperience($req)
    {
        $experience_id = $req->post('experience_id');
        $experience_data = DB::table('work_experiences')->where('id', $experience_id)->delete();
        if ($experience_data) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Failed to delete';
        }
        return $response;
    }

    public function get_work_experiences($req)
    {
        $search = $req->searchTerm;
        if ($search == '') {
            $work_experiences = DB::table('work_experiences')->where(array('is_deleted' => 0))->select('id', 'experience')->get();
        } else {
            $work_experiences = DB::table('work_experiences')->select('id', 'experience')->where('experience', 'like', '%' . $search . '%')->where('is_deleted', 0)->limit(10)->get();
        }

        $response = array();
        foreach ($work_experiences as $data) {
            $response[] = array(
                "id" => $data->id,
                "text" => $data->experience
            );
        }
        return response()->json($response);
    }

    public function expected_salary_range()
    {
        $data = DB::table('expected_salary_range')->where(array('is_deleted' => 0))
            ->select('id', 'salary_range')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $update_btn = '<button title="' . $row->salary_range . '" class="btn btn-link" onclick="edit_salary_range(this)" data-val="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                $delete_btn = '<button data-toggle="modal" target="_blank"  title="' . $row->salary_range . '" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '"><i class="fa fa-trash-alt tx-danger"></i></button>';
                return $update_btn . $delete_btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function add_salary_range($req)
    {
        $rules = array(
            'salary_range' => 'required',
        );
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);
        } else {
            $data = array(
                'salary_range' => $req->salary_range
            );
            if (empty($req->salary_id)) {
                $data['created_at'] = date('Y-m-d H:i');
                $data['created_by'] = Auth::User()->id;
                DB::table('expected_salary_range')->insert($data);
                return response()->json(['st' => 'success', 'msg' => 'Salary range has been added',]);
            } else {
                $data['updated_at'] = date('Y-m-d H:i');
                $data['updated_by'] = Auth::User()->id;
                DB::table('expected_salary_range')->where('id', $req->salary_id)->update($data);
                return response()->json(['st' => 'success', 'msg' => 'Salary range update successfully']);
            }
        }
    }

    public function GetSelaryRangeData($req)
    {
        if (!empty($req)) {
            $data = DB::table('expected_salary_range')
                ->where(array('id' => $req->salary_id))
                ->select('*')
                ->first();
            $response = array('st' => "success", "msg" => $data);
            return response()->json($response);
        }
    }

    public function deleteSelaryRange($req)
    {
        $salary_id = $req->post('salary_id');
        $experience_data = DB::table('expected_salary_range')->where('id', $salary_id)->delete();
        if ($experience_data) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Failed to delete';
        }
        return $response;
    }

    public function get_expected_salary_range($req)
    {
        $search = $req->searchTerm;
        if ($search == '') {
            $expected_salary_range = DB::table('expected_salary_range')->where(array('is_deleted' => 0))->select('id', 'salary_range')->get();
        } else {
            $expected_salary_range = DB::table('expected_salary_range')->select('id', 'salary_range')->where('salary_range', 'like', '%' . $search . '%')->where('is_deleted', 0)->limit(10)->get();
        }

        $response = array();
        foreach ($expected_salary_range as $data) {
            $response[] = array(
                "id" => $data->id,
                "text" => $data->salary_range
            );
        }
        return response()->json($response);
    }
}
