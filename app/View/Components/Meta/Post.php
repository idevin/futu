<?php

namespace App\View\Components\Meta;

use App\Models\Post as PostModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Post extends Component
{
    /**
     * @var mixed|null
     */
    private PostModel $data;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(PostModel $data)
    {
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        $tags = $this->data->tagsTranslated(session()->get('locale'))->get()->filter(function($tag){
            return $tag->name_translated != null;
        })->implode('name_translated', ',');

        return view('components.meta.post', ['data' => $this->data, 'tags' => $tags]);
    }
}
