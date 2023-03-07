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
                $update_btn = '<button title="' . $row->employer_name . '" class="btn btn-link" onclick="edit_employer(this)" data-val="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                $delete_btn = '<button data-toggle="modal" target="_blank"  title="' . $row->employer_name . '" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '"><i class="fa fa-trash-alt tx-danger"></i></button>';
                return $update_btn . $delete_btn;
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
                $update_btn = '<button title="' . $row->name . '" class="btn btn-link" onclick="edit_employee(this)" data-val="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                $delete_btn = '<button data-toggle="modal" target="_blank"  title="' . $row->name . '" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '"><i class="fa fa-trash-alt tx-danger"></i></button>';
                return $update_btn . $delete_btn;
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

    public function GetEmployeeData($req)
    {
        if (!empty($req)) {
            $data = DB::table('employee_data')->where(array('id' => $req->employee_id))
                ->select('*')
                ->first();
            $response = array('st' => "success", "msg" => $data);
            return response()->json($response);
        }
    }

    public function edit_employee($req)
    {
        $rules = array(
            'name' => 'required',
            'phone_number' => 'required',
            'required_job' => 'required',
            'skill_set' => 'required',
            'work_experience' => 'required',
            'visible' => 'required',
        );
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);
        } else {
            $data = array(
                'name' => $req->name,
                'email_id' => $req->email_id ? $req->email_id : ' ',
                'phone_number' => $req->phone_number,
                'type_of_job_required' => $req->required_job,
                'skill_set' => $req->skill_set,
                'work_experience' => $req->work_experience,
                'gender' => $req->visible,
                'age' => $req->age ? $req->age : ' ',
                'type_of_employement' => $req->type_of_employement ? $req->type_of_employement : ' '
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
        $data = DB::table('work_experiences')->where(array('is_del' => 0))
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
}
