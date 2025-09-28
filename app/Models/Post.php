<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\MediaCollections\Models\Media as MediaModel;

class Post extends Model implements HasMedia
{
    use HasFactory, Sluggable, InteractsWithMedia;

    protected $fillable = [
        'title',
        'player_name',
        'slug',
        'excerpt',
        'content',
        'user_id',
        'category_id',
        'read_time',
        'is_featured',
        'is_published',
        'published_at',
        'meta_data'
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'meta_data' => 'array',
        ];
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('player_name', 'like', '%' . $search . '%')
                  ->orWhere('excerpt', 'like', '%' . $search . '%');
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getRelatedPosts(int $limit = 2)
    {
        return self::published()
            ->where('id', '!=', $this->id)
            ->where('category_id', $this->category_id)
            ->with(['user', 'category', 'media'])
            ->latest('published_at')
            ->limit($limit)
            ->get();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('hero_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('middle_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(MediaModel $media = null): void
    {
        // Mobile optimized conversions (480px width)
        $this->addMediaConversion('mobile')
            ->width(480)
            ->height(320)
            ->quality(85)
            ->format('webp')
            ->nonQueued();

        // Tablet optimized conversions (768px width)
        $this->addMediaConversion('tablet')
            ->width(768)
            ->height(512)
            ->quality(90)
            ->format('webp')
            ->nonQueued();

        // Desktop optimized conversions (1200px width)
        $this->addMediaConversion('desktop')
            ->width(1200)
            ->height(800)
            ->quality(90)
            ->format('webp')
            ->nonQueued();

        // Large desktop conversions (1920px width)
        $this->addMediaConversion('large')
            ->width(1920)
            ->height(1280)
            ->quality(85)
            ->format('webp')
            ->nonQueued();

        // Thumbnail for admin/previews
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->quality(80)
            ->format('webp')
            ->nonQueued();
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('featured_image');
    }

    public function getHeroImageUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('hero_image');
    }

    public function getMiddleImageUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('middle_image');
    }

    // Responsive image methods for mobile optimization
    public function getFeaturedImageResponsive(): array
    {
        if (!$this->hasMedia('featured_image')) {
            return [];
        }

        return [
            'mobile' => $this->getFirstMediaUrl('featured_image', 'mobile'),
            'tablet' => $this->getFirstMediaUrl('featured_image', 'tablet'),
            'desktop' => $this->getFirstMediaUrl('featured_image', 'desktop'),
            'original' => $this->getFirstMediaUrl('featured_image'),
        ];
    }

    public function getHeroImageResponsive(): array
    {
        if (!$this->hasMedia('hero_image')) {
            return [];
        }

        return [
            'mobile' => $this->getFirstMediaUrl('hero_image', 'mobile'),
            'tablet' => $this->getFirstMediaUrl('hero_image', 'tablet'),
            'desktop' => $this->getFirstMediaUrl('hero_image', 'desktop'),
            'original' => $this->getFirstMediaUrl('hero_image'),
        ];
    }

    public function getMiddleImageResponsive(): array
    {
        if (!$this->hasMedia('middle_image')) {
            return [];
        }

        return [
            'mobile' => $this->getFirstMediaUrl('middle_image', 'mobile'),
            'tablet' => $this->getFirstMediaUrl('middle_image', 'tablet'),
            'desktop' => $this->getFirstMediaUrl('middle_image', 'desktop'),
            'original' => $this->getFirstMediaUrl('middle_image'),
        ];
    }

    public function getFeaturedImageSrcsetAttribute(): string
    {
        $responsive = $this->getFeaturedImageResponsive();
        if (empty($responsive)) {
            return '';
        }

        $srcset = [];
        if (!empty($responsive['mobile'])) $srcset[] = $responsive['mobile'] . ' 480w';
        if (!empty($responsive['tablet'])) $srcset[] = $responsive['tablet'] . ' 768w';
        if (!empty($responsive['desktop'])) $srcset[] = $responsive['desktop'] . ' 1200w';
        if (!empty($responsive['original'])) $srcset[] = $responsive['original'] . ' 1920w';

        return implode(', ', $srcset);
    }

    public function getHeroImageSrcsetAttribute(): string
    {
        $responsive = $this->getHeroImageResponsive();
        if (empty($responsive)) {
            return '';
        }

        $srcset = [];
        if (!empty($responsive['mobile'])) $srcset[] = $responsive['mobile'] . ' 480w';
        if (!empty($responsive['tablet'])) $srcset[] = $responsive['tablet'] . ' 768w';
        if (!empty($responsive['desktop'])) $srcset[] = $responsive['desktop'] . ' 1200w';
        if (!empty($responsive['original'])) $srcset[] = $responsive['original'] . ' 1920w';

        return implode(', ', $srcset);
    }

    public function getMiddleImageSrcsetAttribute(): string
    {
        $responsive = $this->getMiddleImageResponsive();
        if (empty($responsive)) {
            return '';
        }

        $srcset = [];
        if (!empty($responsive['mobile'])) $srcset[] = $responsive['mobile'] . ' 480w';
        if (!empty($responsive['tablet'])) $srcset[] = $responsive['tablet'] . ' 768w';
        if (!empty($responsive['desktop'])) $srcset[] = $responsive['desktop'] . ' 1200w';
        if (!empty($responsive['original'])) $srcset[] = $responsive['original'] . ' 1920w';

        return implode(', ', $srcset);
    }
}
