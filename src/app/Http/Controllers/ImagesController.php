<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;

class ImagesController extends Controller
{

    public function show(Request $request)
    {
        $id = $request->input('id');

        $attach = Attachment::find($id);

    }
}
