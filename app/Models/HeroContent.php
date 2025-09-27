<?php
// app/Models/HeroContent.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroContent extends Model
{
    use HasFactory;

    protected $table = 'hero_content';

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'video',
        'button_text',
        'button_link',
        'active',
        'order'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        
        return null;
    }

    public function getYoutubeEmbedUrlAttribute()
    {
        if (!$this->video) return null;
        
        // Extract YouTube ID from various URL formats
        $youtube_id = $this->extractYoutubeId($this->video);
        
        if ($youtube_id) {
            return "https://www.youtube.com/embed/{$youtube_id}?autoplay=1&mute=1&loop=1&playlist={$youtube_id}&controls=0&showinfo=0&rel=0&modestbranding=1";
        }
        
        return null;
    }

    public function getYoutubeThumbnailAttribute()
    {
        if (!$this->video) return null;
        
        $youtube_id = $this->extractYoutubeId($this->video);
        
        if ($youtube_id) {
            return "https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg";
        }
        
        return null;
    }

    private function extractYoutubeId($url)
    {
        // Match various YouTube URL formats
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
        preg_match($pattern, $url, $matches);
        
        return isset($matches[1]) ? $matches[1] : null;
    }

    public function hasMedia()
    {
        return $this->image || $this->video;
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }
}