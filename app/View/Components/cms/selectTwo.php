<?php
namespace App\View\Components\cms;


use Illuminate\View\Component;

class selectTwo extends Component
{
    public $id;
    public $name;
    public $title;
    public $labelClass = '';
    public $inputClass = '';
    public $placeholder;
    public $wireModel;
    public $addAttributes;
    public $options;
    public $firstOption;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$options,$firstOption='Select One',$id='',$name='',$labelClass='',$inputClass='',$placeholder='Write here..',$wireModel='',$addAttributes='')
    {
        $this->title = $title;
        $this->id = $id;
        $this->name = $name;
        $this->labelClass = $labelClass;
        $this->inputClass = $inputClass;
        $this->placeholder = $placeholder;
        $this->wireModel = $wireModel;
        $this->addAttributes = $addAttributes;
        $this->options = $options;
        $this->firstOption = $firstOption;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cms.select-two');
    }
}
