<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Validation;
use App\Models\Api\Main;

class MasterController extends Controller
{

    protected $Main;
    protected $Validation;

    public function __construct()
    {
        $this->Main = new Main();
        $this->Validation = new Validation();
    }

    public function Login(Request $req)
    {
        $validation_data = $this->Validation->Login($req);

        if ($validation_data['statuscode'] != 1)
            return $validation_data;
        $data = $this->Main->Login($req);
        return $data;
    }

    public function addEmployeeForm(Request $req)
    {
        $validation_data = $this->Validation->addEmployeeForm($req);

        if ($validation_data['statuscode'] != 1)
            return $validation_data;

        $data = $this->Main->addEmployeeForm($req);
        return $data;
    }

    public function updateEmployeeForm(Request $req)
    {
        $validation_data = $this->Validation->updateEmployeeForm($req);

        if ($validation_data['statuscode'] != 1)
            return $validation_data;

        $data = $this->Main->updateEmployeeForm($req);
        return $data;
    }

    public function addEmployerForm(Request $req)
    {
        $validation_data = $this->Validation->addEmployerForm($req);

        if ($validation_data['statuscode'] != 1)
            return $validation_data;

        $data = $this->Main->addEmployerForm($req);
        return $data;
    }

    public function updateEmployerForm(Request $req)
    {
        $validation_data = $this->Validation->updateEmployerForm($req);

        if ($validation_data['statuscode'] != 1)
            return $validation_data;

        $data = $this->Main->updateEmployerForm($req);
        return $data;
    }

    public function addPostJobForm(Request $req)
    {
        $validation_data = $this->Validation->addPostJobForm($req);

        if ($validation_data['statuscode'] != 1)
            return $validation_data;
        $data = $this->Main->addPostJobForm($req);
        return $data;
    }

    public function getUserData(Request $req)
    {
        $validation_data = $this->Validation->getUserData($req);

        if ($validation_data['statuscode'] != 1)
            return $validation_data;
        $data = $this->Main->getUserData($req);
        return $data;
    }

    public function getOtherData(Request $req)
    {
        $validation_data = $this->Validation->getOtherData($req);

        if ($validation_data['statuscode'] != 1)
            return $validation_data;
        $data = $this->Main->getOtherData();
        return $data;
    }
}
