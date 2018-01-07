<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public function upload(data_request $request)
    {
        $file = Input::file($request['input_file_sign']);
        $destination_path = "/image/products/";
			           
		$extension = $file->getClientOriginalExtension();
        $file_name = strval(time()).str_random(5).'.'.$extension;

		$file->move(base_path().'/public'.$destination_path, $file_name);

        $data["result"] = true;
        $data["message"] = "圖片上傳成功";
        $data["path"] = $destination_path.$file_name;

        return response()->json($data);
    }
}
