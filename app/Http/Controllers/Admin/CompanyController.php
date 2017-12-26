<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\User;
use App\CompanyInfo;

use DB;
use Exception;
use View;
use Auth;
use Redirect;
use Response;
use Validator;

class CompanyController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            // menu_id要確認
            $menu_id = 6;
            $user_id = Auth::user()->id;

            $role_menus = User::able_page($user_id, $menu_id);

            if (count($role_menus)==0) {
                return Redirect::action('AuthController@login');
            } else {
                return View::make('admin/company',['menu_id' => $menu_id]);
            }
            
        } else {
            return Redirect::action('AuthController@login');
        }
    }

    public function findOne()
    {
        $company = CompanyInfo::find(1);

        return response()->json($company);
    }

    public function update(data_request $request)
    {
        try {
            $company = [
                'id' => 1,
                'name' => $request["name"],
                'tax' => $request["tax"],
                'website' => $request["website"],
                'email' => $request["email"],
                'fax' => $request["fax"],
                'telephone' => $request["telephone"],
                'address' => $request["address"],
                'ceo' => $request["ceo"]
            ];

            $validator = Validator::make($company, CompanyInfo::validate($company["id"]));
            
            if ($validator->fails())
            {
                $error_msg = "";
                $error = $validator->errors();
                foreach ($error->all() as $message) {
                    $error_msg = $error_msg . $message;
                }

                $data['result'] = false;
                $data['message'] = $error_msg;
                
            } else {
                $updateCompany =  CompanyInfo::find($company["id"]);

                $updateCompany -> name = $company["name"];
                $updateCompany -> tax = $company["tax"];
                $updateCompany -> website = $company["website"];
                $updateCompany -> email = $company["email"];
                $updateCompany -> fax = $company["fax"];
                $updateCompany -> telephone = $company["telephone"];
                $updateCompany -> address = $company["address"];
                $updateCompany -> ceo = $company["ceo"];
                $updateCompany -> save();

                $data["result"] = true;
                $data["message"] = "公司資料修改成功";
            }
            
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }
}
