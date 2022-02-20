<levels>
    @foreach($levels as $level)
        <level passed="false" id="{{ $level->id }}">
            <title>{{ $level->title }}</title>
            <description>{{ $level->description }}</description>

            <allowed_components>
                @foreach($level->allowedComponents as $component)
                    <component>{{ $component->name }}</component>
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
            <tests visible_count="4">
                <test>
                    <input>0 0</input>
                    <output>0</output>
                </test>
                <test>
                    <input>0 1</input>
                    <output>0</output>
                </test>
                <test>
                    <input>1 0</input>
                    <output>0</output>
                </test>
                <test>
                    <input>1 1</input>
                    <output>1</output>
                </test>
            </tests>
        </level>
    @endforeach
</levels>
