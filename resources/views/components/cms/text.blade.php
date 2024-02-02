{{-- This component can use all html input type --}}
<div class="form-group {{ $formClass }}">
    <label for="{{ $id }}" class="{{ $labelClass }}">{{ $title }}</label>
    <input wire:model='{{ $wireModel }}' type="{{ $type }}" class="form-control {{ $inputClass }} {{ $type == 'time'||$type == 'date'?'flex-row':'' }}" id="{{ $id }}" placeholder="{{ $placeholder }}" value="{{ $value }}" name="{{ $name }}" {{ $addAttributes }}>
    @if($errors->has($wireModel))
            <span class="text-error text-sm" style="margin-top: -1rem">{{ $errors->first($wireModel) }}</span>
    @endif
</div>

