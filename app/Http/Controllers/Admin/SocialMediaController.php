<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Response;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function store(Request $request)
    {
        $sm = new SocialMedia();
        $sm->title = $request->title;
        $sm->description = $request->description;
        $sm->url = $request->url;
        $sm->save();

        return [
            "status" => Response::$success,
        ];
    }

    public function findSM(Request $request)
    {
        $sm = SocialMedia::find($request->id);

        return [
            "status" => Response::$success,
            "data" => $sm,
        ];
    }

    public function getAllSMs(Request $request)
    {
        $sm = SocialMedia::all();

        return [
            "status" => Response::$success,
            "data" => $sm,
        ];
    }

    public function update(Request $request)
    {
        $sm = SocialMedia::find($request->id);
        $sm->title = $request->title;
        $sm->description = $request->description;
        $sm->url = $request->url;
        $sm->save();

        return [
            "status" => Response::$success
        ];
    }

    public function delete($id)
    {
        $sm = SocialMedia::find($id);
        if($sm) {
            $sm->delete();
        }

        return back();
    }
}
