<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\Component;

class Filters extends Component
{
    public $filters = ['Original', 'Clarendon', 'Gingham', 'Moon', 'Perpetua'];
    public $original_image;
    public $image_path;
    public $image;

    public function mount()
    {
        $this->original_image = request()->session()->get('data')['image'];
        $this->image = $this->original_image;
        $this->image_path = 'temp/' . $this->image;
    }

    public function render()
    {
        return view('livewire.filters');
    }

    public function filter_original()
    {
        $this->image = $this->original_image;
        $this->update_session();
    }

    public function filter_clarendon()
    {
        $name = $this->create_name();
        $effects = Image::make($this->image_path)
            ->limitColors(255, '#7fbbe3')
            ->contrast(20)
            ->brightness(10)
            ->save(storage_path('app/temp/' . $name));
        $this->image = $effects->basename;
        $effects->destroy();
        $this->update_session();

    }

    public function filter_gingham()
    {
        $name = $this->create_name();
        $effects = Image::make($this->image_path)
            ->limitColors(255, "#e0f9ff")
            ->brightness(10)
            ->contrast(-20)
            ->save(storage_path('app/temp/' . $name));
        $this->image = $effects->basename;
        $effects->destroy();

        $this->update_session();
    }

    public function filter_moon()
    {
        $name = $this->create_name();
        $effects = Image::make(storage_path('app/' . $this->image_path))
            ->colorize(-23, -50, 5)
            ->brightness(38)
            ->contrast(55)
            ->greyscale()
            ->save(storage_path('app/temp/' . $name));
        $this->image = $effects->basename;
        $effects->destroy();
        $this->update_session();
    }

    public function filter_perpetua()
    {
        $name = $this->create_name();

        $effects = Image::make(storage_path('app/' . $this->image_path))
            ->colorize(-23, -50, 5)
            ->brightness(38)
            ->contrast(55)
            ->save(storage_path('app/temp/' . $name));
        $this->image = $effects->basename;
        $effects->destroy();

        $this->update_session();
    }

    /**
     * @param \Intervention\Image\Image $effects
     * @return void
     */
    public function update_session(): void
    {
        $data = request()->session()->get('data');
        $data['image'] = basename($this->image);
        request()->session()->put('data', $data);
    }

    /**
     * @return string
     */
    public function create_name(): string
    {
        return Str::random(32) . '.jpg';
    }
}
