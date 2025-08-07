<?php

namespace Forphp\Blogify\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'title' => $this->title,
      'slug' => $this->slug,
      'content' => $this->content,
      'status' => $this->status,
      'view_count' => $this->view_count,
      'published_at' => $this->published_at?->toIso8601String(),
      'created_at' => $this->created_at->toIso8601String(),
      'updated_at' => $this->updated_at->toIso8601String(),

      // Relationships
      'category' => new CategoryResource($this->whenLoaded('category')),
      'tags' => TagResource::collection($this->whenLoaded('tags')),
    ];
  }
}
