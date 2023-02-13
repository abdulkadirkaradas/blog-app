<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Response;
use App\Models\Contents;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentsController extends Controller
{
    public function store(Request $request)
    {
        $content = new Contents();
        $content->name = $request->name;
        $content->menu_flag = $request->menu_flag;
        $content->save();

        return [
            "status" => Response::$success,
        ];
    }

    public function findContent(Request $request)
    {
        $content = Contents::find($request->id);

        return [
            "status" => $content
        ];
    }

    public function getAllContents(Request $request)
    {
        $contents = Contents::all();

        return [
            "status" => $contents
        ];
    }

    public function update(Request $request)
    {
        $content = Contents::find($request->id);
        $content->name = $request->name ?? $content->name;
        $content->menu_flag = $request->menu_flag ?? $content->menu_flag;
        $content->save();

        return [
            "status" => Response::$success,
        ];
    }

    public function delete(Request $request)
    {
        $content = Contents::find($request->id);
        if($content) {
            $content->delete();

            return [
                "status" => Response::$success,
            ];
        }

        return [
            "status" => Response::$fail,
        ];
    }
}
