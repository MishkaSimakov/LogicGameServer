<levels>
    @foreach($levels as $level)
        <level passed="false" id="{{ $level->id }}">
            <title>{{ $level->title }}</title>
            <description>{{ $level->description }}</description>

            <allowed_components>
                <component>And</component>
                <component>Or</component>
            </allowed_components>
            <outputs>
                <output>OUT</output>
            </outputs>
            <inputs>
                <input>A</input>
                <input>B</input>
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
