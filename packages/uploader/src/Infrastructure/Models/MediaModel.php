<?php

use Illuminate\Database\Eloquent\Model;

class MediaModel extends Model
{
    protected $table = 'medias';

    public function imageVariants()
    {
        return $this->hasMany(MediaImageVariantModel::class, 'media_id', 'id');
    }
}
