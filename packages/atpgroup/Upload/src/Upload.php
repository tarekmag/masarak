<?php

namespace ATPGroup\Upload;

use App\Http\Controllers\Controller;

class Upload extends Controller {

    static function image($config=[]) {
        if(!isset($config['name']))
            return "<span style='color:red'>Name Attribute Missing</span>";
        if(!isset($config['name']))
            return "<span style='color:red'>Name Attribute Missing</span>";
        return view('Upload::image' , ['config'=>$config])->render();
    }

    static function images($config=[]) {
        if(!isset($config['name']))
            return "<span style='color:red'>Name Attribute Missing</span>";
        return view('Upload::images' , ['config'=>$config])->render();
    }

    static function file($config=[]) {
        if(!isset($config['name']))
            return "<span style='color:red'>Name Attribute Missing</span>";
        if(!isset($config['ext']))
            $config['ext'] = 'csv,xlsx,xls,pdf,doc,docx,jpg,gif,jpeg,png' ;

        return view('Upload::file' , ['config'=>$config])->render();
    }

    static function files($config=[]) {
        if(!isset($config['name']))
            return "<span style='color:red'>Name Attribute Missing</span>";
        if(!isset($config['ext']))
            $config['ext'] = 'csv,xlsx,xls,pdf,doc,docx,jpg,gif,jpeg,png' ;

        return view('Upload::files' , ['config'=>$config])->render();
    }

    function upload($file='' , $return_name=false) {
        if($file=='')
            $file = request()->file('file');
        $input['file'] = $file;
        if(!request()->has('is_file')){
            $v = \Validator::make($input, [
                'file' => 'image',
            ]);

            if ($v->fails()) {
                return response()->json([
                    'status' => 'error',
                    'error' => 'failed to upload image'
                ]);
            }
            $fileExtensions = ['jpg', 'jpeg', 'gif', 'png'];
        }else{
            $ext = ['csv','xlsx','xls','pdf','doc','docx','jpg','gif','jpeg','png' ];
            $fileExtensions = explode(',',request('ext'));
            $fileExtensions = array_intersect($ext ,$fileExtensions);
        }


        if(!in_array(strtolower($file->getClientOriginalExtension()), $fileExtensions))
        {
            return response()->json([
                'status' => 'error',
                'error' => 'this extinsion '.$file->getClientOriginalExtension().' is not allowed'
            ]);
        }

        $name = md5(microtime()) . '.' . $file->getClientOriginalExtension();
        if(request()->has('folder'))
            $folder = request('folder');
        else
            $folder = request('uploads');
        $file->move(public_path($folder), $name);
        if($return_name)
            return $name ;
        return response()->json([
            'status' => 'success',
            'name' => $name,
        ]);

    }
    function uploads(){
        $files = request()->file('file');
        foreach($files as $file)
            $names[] = $this->upload($file , true) ;
        return response()->json([
            'status' => 'success',
            'names' => $names,
        ]);
    }



}

?>
