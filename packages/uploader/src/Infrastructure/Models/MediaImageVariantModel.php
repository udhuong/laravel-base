<?php

use Illuminate\Database\Eloquent\Model;

class MediaImageVariantModel extends Model
{
    protected $table = 'media_image_variants';

    public function media()
    {
        return $this->belongsTo(MediaModel::class);
    }
}
