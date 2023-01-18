<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Response;
use App\Models\TopicDetails;
use App\Models\TopicImages;
use App\Models\Topics;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class DesignsController extends Controller
{
    public function store(Request $request)
    {
        $design = new Topics();
        $design->name = $request->name;
        $design->flag = $request->flag;
        $design->save();

        $detail = new TopicDetails();
        $detail->detail = $request->detail;
        $detail->topic_id = $design->id;
        $detail->save();

        $file = $request->file("image");
        $fileId = Str::uuid();
        if($file) {
            $fileName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();

            $image = new TopicImages();
            $image->file_id = $fileId;
            $image->file_name = $fileName;
            $image->file_extension = $fileExtension;
            $image->file_url = env("APP_URL") . "/" . "designs" . "/" . $design->id . "/" . $fileId . "." . $fileExtension;
            $image->topic_id = $design->id;
            $image->save();
        }

        if(!file_exists(public_path("designs"))) {
            mkdir(public_path("designs"), 0777, true);
        }

        if(!file_exists(public_path("designs" . "/" . $design->id . "/"))) {
            mkdir(public_path("designs" . "/" . $design->id . "/"), 0777, true);
        }

        $file->move(public_path("designs" . "/" . $design->id . "/"), $fileId . "." . $fileExtension);

        return [
            "status" => Response::$success,
        ];
    }

    public function findDesign(Request $request)
    {
        $design = Topics::find($request->id);
        $detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $design->id)->get();
        $images = TopicImages::whereNull("deleted_at")->where("topic_id", $design->id)->get();

        return [
            "status" => Response::$success,
            "data" => [
                "design" => $design,
                "detail" => $detail,
                "images" => $images,
            ]
        ];
    }

    public function getAllDesigns(Request $request)
    {
        $design = Topics::whereNull("deleted_at")->where("flag", "designs")->get();
        foreach ($design as $key => $value) {
            $value->detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $value->id)->get()[0];
            $value->images = TopicImages::whereNull("deleted_at")->where("topic_id", $value->id)->get()[0];
        }

        return [
            "status" => Response::$success,
            "data" => $design,
        ];
    }

    public function update(Request $request)
    {

    }

    public function delete($id)
    {
        $design = Topics::find($id);
        if($design) {
            $design->delete();
            $detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $design->id)->delete();
            $images = TopicImages::whereNull("deleted_at")->where("topic_id", $design->id)->delete();
        }

        return back();
    }
}
