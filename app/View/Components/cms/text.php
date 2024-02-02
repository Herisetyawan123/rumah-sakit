<?php

namespace App\View\Components\cms;

use Illuminate\View\Component;

class text extends Component
{
    public $id;
    public $name;
    public $value;
    public $title;
    public $type = 'text';
    public $labelClass = '';
    public $inputClass = '';
    public $formClass = '';
    public $placeholder;
    public $wireModel;
    public $addAttributes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$id='',$name='',$value='',$type='text',$labelClass='',$inputClass='',$formClass = '',$placeholder='Write here..',$wireModel='',$addAttributes='')
    {
        $this->title = $title;
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->labelClass = $labelClass;
        $this->inputClass = $inputClass;
        $this->placeholder = $placeholder;
        $this->wireModel = $wireModel;
        $this->type = $type;
        $this->addAttributes = $addAttributes;
        $this->formClass = $formClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cms.text');
    }
}
