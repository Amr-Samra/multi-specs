<div class="form-group xxs-pt-40 clearfix">
    {!! Form::label("specs[{$spec->id}]", $spec->name,['class' => 'col-xs-12 col-sm-3 xs-text-right sm-text-left xxs-mt-2 xxs-pt-20']) !!}
    <div class="col-xs-10 col-sm-7">
        @if(!$multiple)
            {!! Form::select("specs[{$spec->id}]", $spec->options, (isset($spec->pivot) ? $spec->pivot->value : null), ['class' => ' form-control font-droidkufi xxs-pt-10 xxs-pb-30 xxs-pr-0 text-right lang-ltr']) !!}
        @else
            {!! Form::select("specs[{$spec->id}][]", $spec->options, (isset($spec->pivot) ? $spec->pivot->value : null), ['multiple', 'class' => ' form-control font-droidkufi xxs-pt-10 xxs-pb-30 xxs-pr-0 text-right lang-ltr']) !!}
        @endif
    </div>
</div>