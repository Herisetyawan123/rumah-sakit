<?php
namespace App\Http\Livewire\Cms\Contract;

use Illuminate\Support\Str;

trait PageAction {
 /**
     * Defines the base route name for current datatable component.
     *
     * @return string
     */
    public function getBaseRouteName(): string
    {
        return '';
    }

    /**
     * Get the route key name for the current datatable component.
     *
     * @return string
     */
    protected function getRouteKeyName(): string
    {
        return Str::camel(class_basename(get_class(new $this->model)));
    }

    /**
     * Perform a specific action for the given record key.
     *
     * @param string      $action
     * @param string|null $key
     *
     * @return mixed
     */
    public function performAction(string $action, string $key = null)
    {
        return redirect()->to(
            route($this->getBaseRouteName().$action, [$this->getRouteKeyName() => $key])
        );
    }

    public function getBasePermission(Object $model){
        return 'cms.' . ($model)->getTable().'.';
    }

    public function getBasePermissionDokter(Object $model){
        return 'dokter.' . ($model)->getTable().'.';
    }
}
