<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class UploaderController extends Controller
{
   /* //文件上传的处理
    public function webuploader(Request $request)
    {
    	//判断文件上传是否成功
    	if($request->hasFile('file') && $request->file('file')->isValid())
    	{
    		//获取文件路径并保存
    		$filename=sha1(time().$request->file('file')->getClientOriginalName()) . '.' . $request->file('file')->getClientOriginalExtension();
    		//dd($filename);
            //文件保存/移动
            Storage::disk('public')->put($filename,file_get_contents($request->file->path()));
    		//获取文件扩展名
    		//$path = $request->file->storeAs('images', 'filename.jpg');
    		//返回数据
    		$result=
    		[
    			'errCode'	=>	'0',
    			'errMsg'	=>	'',
    			'succMsg'	=>	'文件上传成功',
    			'path'	=>	'/storage/'.$filename,
    		];
    	}
    	else
    	{
    		$result=
    		[
    			'errCode'	=>	'01',
    			'errMsg'	=>	$request->file('file')->getErrorMessage(),
    		];
    	}
    	//返回信息
    	return response()->json($result);
    }
*/
     //文件上传云存储的处理
    public function qiniu(Request $request)
    {
        //判断文件上传是否成功
        if($request->hasFile('file') && $request->file('file')->isValid())
        {
            //获取文件路径并保存
            $filename=sha1(time().$request->file('file')->getClientOriginalName()) . '.' . $request->file('file')->getClientOriginalExtension();
           // dd($filename);    
            Storage::disk('qiniu')->put($filename,file_get_contents($request->file->path()));
            //返回数据
            $result=
            [
                'errCode'   =>  '0',
                'errMsg'    =>  '',
                'succMsg'   =>  '文件上传成功',
                'path'       =>   Storage::disk('qiniu')->getDriver()->downloadUrl($filename),
            ];
        }
        else
        {
            $result=
            [
                'errCode'   =>  '01',
                'errMsg'    =>  $request->file('file')->getErrorMessage(),
            ];
        }
        //返回信息
        return response()->json($result);
    }






}
