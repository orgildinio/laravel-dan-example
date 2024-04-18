<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FileListComponent extends Component
{
    public $fileName;
    public $fileUrl;
    public $fileExt;
    public $fileSizeInKilobytes;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fileName, $fileExt, $fileUrl, $fileSizeInKilobytes)
    {
        // dd($data);
        $this->fileName = $fileName;
        $this->fileUrl = $fileUrl;
        $this->fileExt = $fileExt;
        $this->fileSizeInKilobytes = $fileSizeInKilobytes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.file-list-component');
    }
}
