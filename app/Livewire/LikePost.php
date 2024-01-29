<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isliked;
    public $likes;

    public function mount($post)
    {
        $this->isliked = $post->checklikes(auth()->user());
        $this->likes = $post->likes->count();
    }

    public function like()
    {
        if ($this->isliked) {
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
            $this->isliked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isliked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
