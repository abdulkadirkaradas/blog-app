<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Response;
use App\Models\TopicDetails;
use App\Models\TopicImages;
use App\Models\Topics;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopicsController extends Controller
{
    public function store(Request $request)
    {
        $topic = new Topics();
        $topic->name = $request->name;
        $topic->flag = $request->flag;
        $topic->save();

        $detail = new TopicDetails();
        $detail->detail = $request->detail;
        $detail->topic_id = $topic->id;
        $detail->save();

        $folderName = $request->flag;
        $file = $request->file("image");
        $fileId = Str::uuid();
        if($file) {
            $fileName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();

            $image = new TopicImages();
            $image->file_id = $fileId;
            $image->file_name = $fileName;
            $image->file_extension = $fileExtension;
            $image->file_url = env("APP_URL") . `/` . `` + $folderName + `` . `/` . $topic->id . `/` . $fileId . `.` . $fileExtension;
            $image->topic_id = $topic->id;
            $image->save();
        }

        if(!file_exists(public_path(`` + $folderName + ``))) {
            mkdir(public_path(`` + $folderName + ``), 0777, true);
        }

        if(!file_exists(public_path(`` + $folderName + `` . `/` . $topic->id . `/`))) {
            mkdir(public_path(`` + $folderName + `` . `/` . $topic->id . `/`), 0777, true);
        }

        $file->move(public_path(`` + $folderName + `` . `/` . $topic->id . `/`), $fileId . `.` . $fileExtension);

        return [
            "status" => Response::$success,
        ];
    }

    public function findTopic(Request $request)
    {
        $topic = Topics::find($request->id);
        $detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $topic->id)->get();
        $images = TopicImages::whereNull("deleted_at")->where("topic_id", $topic->id)->get();

        return [
            "status" => Response::$success,
            "data" => [
                "topic" => $topic,
                "detail" => $detail,
                "images" => $images,
            ]
        ];
    }

    public function getAllTopics(Request $request)
    {
        $topic = Topics::whereNull("deleted_at")->where("flag", $request->flag)->get();
        if($topic) {
            foreach ($topic as $key => $value) {
                $value->detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $value->id)->get()[0];
                $value->images = TopicImages::whereNull("deleted_at")->where("topic_id", $value->id)->get()[0];
            }

            return [
                "status" => Response::$success,
                "data" => $topic,
            ];
        }

        return [
            "status" => Response::$fail,
        ];
    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {
        $topic = Topics::find($request->id);
        if($topic) {
            $topic->delete();
            TopicDetails::whereNull("deleted_at")->where("topic_id", $topic->id)->delete();
            TopicImages::whereNull("deleted_at")->where("topic_id", $topic->id)->delete();

            return [
                "status" => Response::$success,
            ];
        }

        return [
            "status" => Response::$fail,
        ];
    }
}
