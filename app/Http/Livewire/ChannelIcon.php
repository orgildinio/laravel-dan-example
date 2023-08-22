<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChannelIcon extends Component
{
    public $category, $channel;
    public $color;

    public function mount($category, $channel)
    {
        // dd($category);
        $this->category = $category;
        $this->channel = $channel;
        $this->changeColor($category);
    }

    public function changeColor($newCategory)
    {
        switch ($newCategory) {
            case 'Талархал':
                $this->color = "green";
                break;

            case 'Гомдол':
                $this->color = "red";
                break;

            case 'Санал':
                $this->color = "blue";
                break;

            default:
                $this->color = "purple";
        }
    }

    public function render()
    {
        return view('livewire.channel-icon');
    }
}
