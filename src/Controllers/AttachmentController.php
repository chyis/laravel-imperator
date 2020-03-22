<?php

namespace Chyis\Imperator\Controllers;

use App\Http\Controllers\Controller;
use Chyis\Imperator\Models\Setting;
use Illuminate\Http\Request;
use Chyis\Imperator\Models\Attachment;

/**
 * @package App\Http\Controllers\Admin
 * @name AttachmentController
 *     附件及图片管理功能
 *
 * @funtions index,uploadImage,uploadFile
 * @copyright
 * @author Jerry Li
 * @version
 *
 * @return \Illuminate\Http\Response
 */

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @access public
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyWord = $request->input('keyword');
        $condition = [];

        if ($keyWord != '')
        {
            $condition[] = ['title', $keyWord];
        }
        $query = Link::orderBy('sort', 'asc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('admin.tools.perPage'));

        return view('Imperator::attachment.index')
            ->with('pageName', '附件管理')
            ->with('lists', $list)
            ->with('request', $request->toArray());
    }

    /**
     * Upload Image resource to Server.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        if($request->hasFile('file') && $request->file('file')->isValid())
        {
            $file=$request->file('file');
            $allowed_extensions = explode(',', Setting::getValueByCode('upload_image_ext'));
            if (!in_array($file->getClientOriginalExtension(), $allowed_extensions))
            {

                return $this->returnResult("false", "文件不符合系统要求");
            } else {
                $destinationPath = 'storage/uploads/'; //public 文件夹下面建 storage/uploads 文件夹
                $extension = $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $origName = $file->getClientOriginalName();;

                $fileName = md5(time().rand(1,1000)).'.'.$extension;
                $file->move($destinationPath, $fileName);
                $filePath = asset($destinationPath.$fileName);
                Attachment::create([
                    'file_name'=>$origName,
                    'file_url'=>$filePath,
                    'description'=>'',
                    'tags'=>'',
                    'size'=>$fileSize,
                    'ext'=>$extension,
                    'article_id'=>'',
                    'cate_id'=>'',
                ]);

                return $this->returnResult("true", "上传成功", $filePath);
            }
        } else {

            return $this->returnResult("false", "文件上传失败");
        }
    }

    /**
     * Upload Document file resource to Server.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadFile(Request $request)
    {
        if($request->hasFile('file') && $request->file('file')->isValid())
        {
            $file=$request->file('file');
            $allowed_extensions = explode(',', Setting::getValueByCode('upload_file_ext'));
            if (!in_array($file->getClientOriginalExtension(), $allowed_extensions))
            {

                return $this->returnResult("false", "附件文件不符合系统要求");
            } else {
                $destinationPath = 'storage/uploads/'; //public 文件夹下面建 storage/uploads 文件夹
                $extension = $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $origName = $file->getClientOriginalName();;

                $fileName = md5(time().rand(1,1000)).'.'.$extension;
                $file->move($destinationPath, $fileName);
                $filePath = asset($destinationPath.$fileName);
                Attachment::create([
                    'file_name'=>$origName,
                    'file_url'=>$filePath,
                    'description'=>'',
                    'tags'=>'',
                    'size'=>$fileSize,
                    'ext'=>$extension,
                    'article_id'=>'',
                    'cate_id'=>'',
                ]);

                return $this->returnResult("true", "上传成功", $filePath);
            }
        } else {

            return $this->returnResult("false", "文件上传失败");
        }
    }

    private function returnResult($isUploaded, $msg, $fileUrl = '')
    {
        return ["uploaded"=>"{$isUploaded}", "url"=>$fileUrl, "msg"=>$msg];
    }

}
