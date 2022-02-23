{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<levels>
    @foreach($levels as $level)
        <level passed="false" id="{{ $level->id }}">
            <title>{{ $level->title }}</title>
            <description>{{ $level->description }}</description>

            <allowed_components>
                @foreach($level->allowedComponents as $component)
                    <component>{{ $component->slug }}</component>
                @endforeach
            </allowed_components>
            <outputs>
                @foreach($level->outputs as $output)
                    <output>{{ $output->name }}</output>
                @endforeach
            </outputs>
            <inputs>
                @foreach($level->inputs as $input)
                    <output>{{ $input->name }}</output>
                @endforeach
            </inputs>
            <tests visible_count="{{ $level->visible_tests_count }}">
                @foreach($level->tests as $test)
                    <test>
                        @foreach($test->values()->input()->get() as $value)
                            <input for="{{ $value->transput->name }}">{{ $value->value }}</input>
                        @endforeach
                        @foreach($test->values()->output()->get() as $value)
                            <output for="{{ $value->transput->name }}">{{ $value->value }}</output>
                        @endforeach
                    </test>
                @endforeach
            </tests>
        </level>
    @endforeach
</levels>
