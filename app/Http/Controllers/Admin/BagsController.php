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
        $bag->flag = $request->flag;
        $bag->save();

        $detail = new TopicDetails();
        $detail->detail = $request->detail;
        $detail->topic_id = $bag->id;
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
        $bags = Topics::whereNull("deleted_at")->where("flag", "bags")->get();
        foreach ($bags as $key => $value) {
            $value->detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $value->id)->get()[0];
            $value->images = TopicImages::whereNull("deleted_at")->where("topic_id", $value->id)->get()[0];
        }

        return [
            "status" => Response::$success,
            "data" => $bags,
        ];
    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {
        $bag = Topics::find($request->id);
        if($bag) {
            $bag->delete();
            $detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $bag->id)->delete();
            $images = TopicImages::whereNull("deleted_at")->where("topic_id", $bag->id)->delete();

            return [
                "status" => Response::$success,
            ];
        }

        return [
            "status" => Response::$fail,
        ];
    }
}
