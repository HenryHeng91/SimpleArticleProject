<?php

namespace App\Http\Resources;

use App\Models\Role;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Response;

class PostResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'          => $this->post_type,
            'id'            => $this->id,
            'title'     => $this->title,
            'body'      => $this->body,
            'cover_img'         => $this->cover_img,
            'user'       => $this->user,
            'deleted_at'          => $this->deleted_at,
            'createdDate'    => $this->created_at,
            'updatedDate'    => $this->updated_at,
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
                'timestamp' => now()->toDateTimeString(),
                'link' => route('index'),
            ]
        ];
    }


    /**
     * Handle HTTP error for resource
     *
     * @param $code
     * @param $title
     * @param string $description
     * @return Response
     */
    public static function error($code, $title, $description = ''){
        return Response::json([
            'error'=>$code,
            'title'=>$title,
            'description'=>$description,
        ], $code);
    }
}
