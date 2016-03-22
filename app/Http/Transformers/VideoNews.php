<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\VideoNews as mVideoNews;
use cScreenshot;

class VideoNews extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\VideoNews model
     *
     * @return Array
    */
    public function transform(mVideoNews $videoNews)
    {
        return [
            'id' => (int) $videoNews->id,
            'title' => $videoNews->title,
            'content' => $videoNews->content,
            'url' => cScreenshot::getItems($videoNews->url),
            'published' => (boolean) $videoNews->is_published
        ];
    }
}