<?php

namespace App\Services\Video;

use App\Models\Video;
use Illuminate\Support\Collection;

class VideoService
{
    /**
     * @return Collection
     */
    public function getVideos(): Collection
    {
        return Video::all();
    }

    /**
     * @param array $data
     * @return Video
     */
    public function create(array $data): Video
    {
        return Video::create($data);
    }

    /**
     * @param int $id
     * @return Video
     */
    public function getVideoById(int $id): Video
    {
        return Video::findOrFail($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Video
     */
    public function updateById(array $data, int $id): Video
    {
         $video = Video::findOrFail($id);
         $video->title = $data['title'];
         $video->description = $data['description'];
         $video->url = $data['url'];
         $video->save();
         return $video->refresh();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteById(int $id): void
    {
        Video::where('id', $id)->delete();
    }
}
