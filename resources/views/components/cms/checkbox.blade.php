<div class="form-group {{ $formClass }}" wire:ignore>
    <div class="form-check">
      <label class="form-check-label {{ $labelClass }}">
        <input wire:model='{{ $wireModel }}' name='{{ $name }}' value="{{ $value }}" type="checkbox" class="form-check-input {{ $inputClass }}" id="{{ $id }}" {{ $addAttributes }}>
        {{ $title }}
      </label>
    </div>
</div>
