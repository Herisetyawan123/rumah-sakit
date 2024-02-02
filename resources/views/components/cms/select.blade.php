<div class="form-group">
    <label class="{{ $labelClass }}" for="{{ $id }}">{{ $title }}</label>
    <select wire:model='{{ $wireModel }}' class="form-control form-control-lg {{ $inputClass }}" style="font-size: 16px" id="{{ $id }}" name="{{ $name }}" {{ $addAttributes }}>
        <option>{{ $firstOption }}</option>
        @foreach ($options as $key=>$value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
</div>
