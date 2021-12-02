<?php

namespace App\View\Components\Meta;

use App\Models\Doc as DocModel;
use App\Models\Post as PostModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Doc extends Component
{
    /**
     * @var mixed|null
     */
    private DocModel $data;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(DocModel $data)
    {
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function render(): View|string|Closure
    {
        $tags = $this->data->tagsTranslated(session()->get('locale'))->get()->filter(function($tag){
            return $tag->name_translated != null;
        })->implode('name_translated', ',');

        return view('components.meta.doc', ['data' => $this->data, 'tags' => $tags]);
    }
}
