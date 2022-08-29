<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\Component;

class Filters extends Component
{
    public $filters = ['Original', 'Clarendon', 'Gingham', 'Moon', 'Perpetua', 'Sepia'];
    public $original_image;
    public $image;

    public function mount()
    {
        $this->original_image = request()->session()->get('data')['image'];
        $this->image = session('data')['basename'];
    }

    public function render()
    {
        return view('livewire.filters');
    }

    public function filter_original()
    {
        $this->image = basename($this->original_image);
    }

    public function filter_clarendon()
    {
        $name = $this->create_name();
        $effects = Image::make($this->original_image)
            ->limitColors(255, '#7fbbe3')
            ->contrast(20)
            ->brightness(10)
            ->save(storage_path('app/temp/' . $name));
        $this->image = $effects->basename;

        $this->update_session($effects);

    }

    public function filter_gingham()
    {
        $name = $this->create_name();
        $effects = Image::make($this->original_image)
            ->limitColors(255, "#e0f9ff")
            ->brightness(2)
            ->save(storage_path('app/temp/' . $name));
        $this->image = $effects->basename;

        $this->update_session($effects);
    }

    public function filter_moon()
    {
        $name = $this->create_name();
        $effects = Image::make(storage_path('app/' . $this->original_image))
            ->colorize(-23, -50, 5)
            ->brightness(38)
            ->contrast(55)
            ->greyscale()
            ->save(storage_path('app/temp/' . $name));
        $this->image = $effects->basename;
        $this->update_session($effects);
    }

    public function filter_perpetua()
    {
        $name = $this->create_name();

        $effects = Image::make(storage_path('app/' . $this->original_image))
            ->colorize(-23, -50, 5)
            ->brightness(38)
            ->contrast(55)
            ->save(storage_path('app/temp/' . $name));
        $this->image = $effects->basename;

        $this->update_session($effects);
    }

    /**
     * @param \Intervention\Image\Image $effects
     * @return void
     */
    public function update_session(\Intervention\Image\Image $effects): void
    {
        $data = request()->session()->get('data');
        $data['image'] = $this->image;
        request()->session()->put('data', $data);
        $effects->destroy();
    }

    /**
     * @return string
     */
    public function create_name(): string
    {
        return Str::random(32) . '.jpg';
    }
}
