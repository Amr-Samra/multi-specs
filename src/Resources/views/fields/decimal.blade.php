<div class="form-group xxs-pt-40 clearfix{{ $errors->has('specs.'.$field['id']) ? ' has-error' : '' }}">
    {!! Form::label("specs[{$field['id']}]", $field['name'],['class' => 'col-xs-12 col-sm-3 xs-text-right sm-text-left xxs-mt-2 xxs-pt-20']) !!}

    <div class="col-xs-10 col-sm-7">
        @if ($errors->has('specs.'.$field['id'])) <p class="help-block">{{ $errors->first('specs.'.$field['id']) }}</p> @endif
        {!! Form::input('number',"specs[{$field['id']}]", (isset($field['pivot']) ? $field['pivot']['value'] : null), ['class' => 'form-control font-droidkufi xxs-pt-10 xxs-pb-30 xxs-pr-0 text-right lang-ltr','placeholder'=>$field['default'],'step'=> 'any']) !!}
        <span class="help-block text-sm line-height-xl font-droidkufi">{{$field['name']}}</span>
    </div>
</div>