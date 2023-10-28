<?php

namespace App\Models\Traits;

/**
 * Trait HasAvatar
 *
 * @package App\Models\Traits
 */
trait HasAvatar
{
    /**
     * Get the user's avatar URL.
     *
     * @return string
     */
    protected function getAvatarUrlAttribute()
    {
        return asset($this->avatar ?? 'images/default-avatar.png');
    }
}
