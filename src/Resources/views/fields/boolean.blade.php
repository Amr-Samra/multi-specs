<div class="form-group xxs-pt-40 clearfix">
    {!! Form::label("specs[{$spec->id}]", $spec->name,['class' => 'col-xs-12 col-sm-3 xs-text-right sm-text-left xxs-mt-2 xxs-pt-20']) !!}
    <div class="col-xs-10 col-sm-7">
	<div class="radio">
		<label>
			{!! Form::radio("specs[{$spec->id}]", "yes", (((isset($spec->pivot) && $spec->pivot->value == 'yes') || (!isset($spec->pivot) && $spec->default == 'yes')) ? true : null)) !!}
			<span> @lang('Specs::forms.yes') </span>
		</label>
		<label>
			{!! Form::radio("specs[{$spec->id}]", "no", (((isset($spec->pivot) && $spec->pivot->value == 'no') || (!isset($spec->pivot) && $spec->default == 'no')) ? true : null)) !!}
			<span> @lang('Specs::forms.no') </span>
		</label>
	</div>
  </div>
</div>