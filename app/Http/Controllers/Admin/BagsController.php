<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Response;
use App\Models\TopicDetails;
use App\Models\TopicImages;
use App\Models\Topics;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BagsController extends Controller
{
    public function store(Request $request)
    {
        $bag = new Topics();
        $bag->name = $request->name;
        $bag->flag = "bag";
        $bag->save();

        $detail = new TopicDetails();
        $detail->detail = $request->detail;
        $detail->topic_id = $bag->id;
        $detail->save();

        $file = $request->file("images");
        $fileId = Str::uuid();
        if($file) {
            $fileName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();

            $image = new TopicImages();
            $image->file_id = $fileId;
            $image->file_name = $fileName;
            $image->file_extension = $fileExtension;
            $image->file_url = env("APP_URL") . "/" . "bags" . "/" . $bag->id . "/" . $fileId . "." . $fileExtension;
            $image->topic_id = $bag->id;
            $image->save();
        }

        if(!file_exists(public_path("bags"))) {
            mkdir(public_path("bags"), 0777, true);
        }

        if(!file_exists(public_path("bags" . "/" . $bag->id . "/"))) {
            mkdir(public_path("bags" . "/" . $bag->id . "/"), 0777, true);
        }

        $file->move(public_path("bags" . "/" . $bag->id . "/"), $fileId . "." . $fileExtension);

        return [
            "status" => Response::$success,
        ];
    }

    public function findBag(Request $request)
    {
        $bag = Topics::find($request->id);
        $detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $bag->id)->get();
        $images = TopicImages::whereNull("deleted_at")->where("topic_id", $bag->id)->get();

        return [
            "status" => Response::$success,
            "data" => [
                "bag" => $bag,
                "detail" => $detail,
                "images" => $images,
            ]
        ];
    }

    public function getAllBags(Request $request)
    {
        $bag = Topics::find($request->id);

        foreach ($bag as $key => $value) {
            $detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $bag->id)->get();
            $images = TopicImages::whereNull("deleted_at")->where("topic_id", $bag->id)->get();

            $value->detail = $detail[0];
            $value->image = $images[0];
        }

        return [
            "status" => Response::$success,
            "data" => $bag,
        ];
    }

    public function update(Request $request)
    {

    }

    public function delete($id)
    {
        $bag = Topics::find($id);
        if($bag) {
            $bag->delete();
            $detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $bag->id)->delete();
            $images = TopicImages::whereNull("deleted_at")->where("topic_id", $bag->id)->delete();
        }

        return back();
    }
}
