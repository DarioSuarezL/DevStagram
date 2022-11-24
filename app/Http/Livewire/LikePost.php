<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likeCount;

    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likeCount = $post->likes->count();
    }

    public function like()
    {
        if($this->post->checkLike(auth()->user())){
            auth()->user()->likes()->where('post_id',$this->post->id)->delete();
            $this->isLiked = false;
            $this->likeCount--;
        }else{
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
            $this->isLiked = true;
            $this->likeCount++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
