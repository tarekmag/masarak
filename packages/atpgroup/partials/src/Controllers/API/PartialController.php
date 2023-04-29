<?php

namespace ATPGroup\Partials\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartialController extends Controller
{
    public function uploadImage(Request $request)
    {
        $v = \Validator::make($request->all(), [
            'file' => 'required|image',
        ]);

        if ($v->fails()) {
            return responseErrorMessage('failed to upload image');
        }

        $allowedfileExtension = ['jpg', 'jpeg', 'gif', 'png'];
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $check = in_array($extension, $allowedfileExtension);
        if ($check) {
            $name = md5(microtime()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $name);
            return responseSuccessData(['name' => $name, 'path' => url('uploads/' . $name)]);
        } else {
            return responseErrorMessage('invalid file format');
        }
    }
}
