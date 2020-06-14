<?php

namespace Chyis\Imperator\Controllers;


use Chyis\Imperator\Models\Attachment;
use Chyis\Imperator\Models\Setting;
use Illuminate\Http\Request;

class UploadController extends AdminController
{
    //

    public function file()
    {

    }

    public function attachment(Request $request)
    {
        $allowed_extensions  = Setting::getValueByCode('upload_image_ext');

        $file = $request->file('image');//获取图片
        $theme = $request->theme;//主题
        $status = $request->status;//状态
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return response()->json([
                'status' => false,
                'message' => '只能上传 png | jpg | gif格式的图片'
            ]);
        }

        if ($request->hasFile('image')) {

        }

        $destinationPath = 'storage/uploads/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        return Response()->json(
            [
                'status' => true,
                'pic' => asset($destinationPath.$fileName),
                'isMake' => $status,
                'message' => '新增成功！'
            ]
        );
    }

    public function image(Request $request)
    {
        $allowed_extensions  = Setting::getValueByCode('upload_image_ext');

        $file = $request->file('image');//获取图片

        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), explode(',', $allowed_extensions))) {
            return response()->json([
                'status' => false,
                'message' => '只能上传 png | jpg | gif格式的图片'
            ]);
        }

        if ($request->hasFile('image')) {
            $destinationPath = 'storage/uploads/'.date('Ym') .'/';
            $extension = $file->getClientOriginalExtension();
            $fileName = \Str::random(10).'.'.$extension;
            $file->move($destinationPath, $fileName);

            $attach = new Attachment();
            $att = [];
            $att['file_name'] = $file->getClientOriginalName();
            $att['file_url'] = '';
            $att['description'] = '';
            $att['tags'] = '';
            $att['size'] = $file->getSize();
            $att['ext'] = $file->getClientOriginalExtension();
            $att['article_id'] = 0;
            $att['cate_id'] = 0;
            $att['ref_count'] = 0;

            $data = $attach->create($att);
            $res = [];
            $res['id'] = $data->id;
            $res['url'] = asset($destinationPath.$fileName);
            return Response()->json(
                [
                    'errorNo' => 0,
                    'data' => $res,
                    'message' => '图片上传成功！'
                ]
            );
        } else {
            return Response()->json(
                [
                    'errorNo' => 1,
                    'data' => [],
                    'message' => '上传失败！'
                ]
            );
        }
    }
}
