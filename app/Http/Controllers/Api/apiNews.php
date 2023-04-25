<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\newsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class apiNews extends baseApiController
{
    public function index()
    {
        $data = newsModel::all();

        $dataArray = [];
        foreach ($data as $dataNews) {
            $dataSend['id'] = $dataNews->id;
            $dataSend['img'] = env('IMAGE_URL').$dataNews->image;
            $dataSend['title'] = $dataNews->title;
            $dataSend['short'] = $dataNews->short_desc;
            $dataSend['desc'] = $dataNews->desc;
            $slug = explode(" ", $dataNews->title);
            $dataSlug = "";
            for ($i=0; $i < count($slug); $i++) { 
                $dataSlug .= $slug[$i]."-";
            }

            $dataSend['slug'] = $dataSlug;
            $dataSend['publish'] = Carbon::parse($dataNews->created_at)->format('d F Y');

            array_push($dataArray,$dataSend);
        }



        return $this->returnJson($dataArray, 200);

    }

    public function detail($id)
    {
        $data = newsModel::find($id);

        $dataDetail['img'] = env('IMAGE_URL').$data->image;
        $dataDetail['title'] = $data->title;
        $dataDetail['short'] = $data->short_desc;
        $dataDetail['desc'] = strip_tags(html_entity_decode($data->desc)); 
        $slug = explode(" ", $data->title);
        $dataSlug = "";
        for ($i=0; $i < count($slug); $i++) { 
            $dataSlug .= $slug[$i]."-";
        }

        $dataDetail['slug'] = $dataSlug;
        $dataDetail['publish'] = Carbon::parse($data->created_at)->format('d F Y');


        $dataArray = [];
        $dataChild = newsModel::where('id', '!=', $id)->take(5)->get();
        foreach ($dataChild as $dataNews) {
            $dataSend['id'] = $dataNews->id;
            $dataSend['img'] = env('IMAGE_URL').$dataNews->image;
            $dataSend['title'] = $dataNews->title;
            $dataSend['short'] = $dataNews->short_desc;
            $dataSend['desc'] = $dataNews->desc;
            $slug = explode(" ", $dataNews->title);
            $dataSlug = "";
            for ($i=0; $i < count($slug); $i++) { 
                $dataSlug .= $slug[$i]."-";
            }

            $dataSend['slug'] = $dataSlug;
            $dataSend['publish'] = Carbon::parse($dataNews->created_at)->format('d F Y');

            array_push($dataArray,$dataSend);
        }

        $dataDetail['child'] = $dataArray ;


        
        return $this->returnJson($dataDetail, 200);
    }




}
