@if($spec->options)
	@include('Specs::fields.options', ['multiple' => FALSE])
@else
	<div class="form-group xxs-pt-40 clearfix">
	{!! Form::label("specs[{$spec->id}]", $spec->name,['class' => 'col-xs-12 col-sm-3 xs-text-right sm-text-left xxs-mt-2 xxs-pt-20']) !!}
		<div class="col-xs-10 col-sm-7">
			{!! Form::text("specs[{$spec->id}]", (isset($spec->pivot) ? $spec->pivot->value : null), ['class' => (($spec->key=='color')? 'jscolor':'').' form-control font-droidkufi xxs-pt-10 xxs-pb-30 xxs-pr-0 text-right lang-ltr','placeholder'=>$spec->default]) !!}
			<span class="help-block text-sm line-height-xl font-droidkufi">{{$spec->name}}</span>
		</div>
	</div>
@endif