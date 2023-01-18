<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Response;
use App\Models\TopicDetails;
use App\Models\TopicImages;
use App\Models\Topics;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function store(Request $request)
    {
        $blog = new Topics();
        $blog->name = $request->name;
        $blog->flag = $request->flag;
        $blog->save();

        $detail = new TopicDetails();
        $detail->detail = $request->detail;
        $detail->topic_id = $blog->id;
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
            $image->file_url = env("APP_URL") . "/" . "blogs" . "/" . $blog->id . "/" . $fileId . "." . $fileExtension;
            $image->topic_id = $blog->id;
            $image->save();
        }

        if(!file_exists(public_path("blogs"))) {
            mkdir(public_path("blogs"), 0777, true);
        }

        if(!file_exists(public_path("blogs" . "/" . $blog->id . "/"))) {
            mkdir(public_path("blogs" . "/" . $blog->id . "/"), 0777, true);
        }

        $file->move(public_path("blogs" . "/" . $blog->id . "/"), $fileId . "." . $fileExtension);

        return [
            "status" => Response::$success,
        ];
    }

    public function findBlog(Request $request)
    {
        $blog = Topics::find($request->id);
        $detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $blog->id)->get();
        $images = TopicImages::whereNull("deleted_at")->where("topic_id", $blog->id)->get();

        return [
            "status" => Response::$success,
            "data" => [
                "blog" => $blog,
                "detail" => $detail,
                "images" => $images,
            ]
        ];
    }

    public function getAllBlogs(Request $request)
    {
        $blogs = Topics::whereNull("deleted_at")->where("flag", "blogs")->get();
        foreach ($blogs as $key => $value) {
            $value->detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $value->id)->get()[0];
            $value->images = TopicImages::whereNull("deleted_at")->where("topic_id", $value->id)->get()[0];
        }


        return [
            "status" => Response::$success,
            "data" => $blogs,
        ];
    }

    public function update(Request $request)
    {

    }

    public function delete($id)
    {
        $blog = Topics::find($id);
        if($blog) {
            $blog->delete();
            $detail = TopicDetails::whereNull("deleted_at")->where("topic_id", $blog->id)->delete();
            $images = TopicImages::whereNull("deleted_at")->where("topic_id", $blog->id)->delete();
        }

        return back();
    }
}
