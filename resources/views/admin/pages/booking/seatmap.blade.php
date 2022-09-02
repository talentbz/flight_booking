<div class="plane">
    <ol class="cabin fuselage">
        @for($i=10; $i <= 43; $i++)
            @if($i == 43)
            <li class="row--{{$i}}">
                <ol class="seats">
                    <li class="seat invisible">
                        <input type="checkbox" id="{{$i}}A" value="150" />
                        <label for="{{$i}}A">{{$i}}A</label>
                    </li>
                    <li class="seat invisible">
                        <input type="checkbox" id="{{$i}}B" value="150"/>
                        <label for="{{$i}}B">{{$i}}B</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="{{$i}}C" value="150"/>
                        <label for="{{$i}}C">{{$i}}C</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" {{$i==12 ? "disabled" : ""}} id="{{$i}}D" />
                        <label for="{{$i}}D">{{$i}}D</label>
                    </li>
                    <li class="seat invisible">
                        <input type="checkbox" id="{{$i}}F" value="150"/>
                        <label for="{{$i}}F">{{$i}}F</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="{{$i}}G" value="150"/>
                        <label for="{{$i}}G">{{$i}}G</label>
                    </li>
                    <li class="seat invisible">
                        <input type="checkbox" id="{{$i}}H" value="150"/>
                        <label for="{{$i}}H">{{$i}}H</label>
                    </li>
                    <li class="seat invisible">
                        <input type="checkbox" id="{{$i}}J" value="150"/>
                        <label for="{{$i}}J">{{$i}}J</label>
                    </li>
                </ol>
            </li>
            @else
            <li class="row--{{$i}}">
                <ol class="seats">
                    <li class="seat">
                        <input type="checkbox" id="{{$i}}A" value="150"/>
                        <label for="{{$i}}A">{{$i}}A</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="{{$i}}B" value="150"/>
                        <label for="{{$i}}B">{{$i}}B</label>
                    </li>
                    <li class="seat {{$i==26 ? 'invisible' : ''}}">
                        <input type="checkbox" id="{{$i}}C" value="150"/>
                        <label for="{{$i}}C">{{$i}}C</label>
                    </li>
                    <li class="seat {{$i==26 ? 'invisible' : ''}}">
                        <input type="checkbox" {{$i==12 ? "disabled" : ""}} id="{{$i}}D" value="150"/>
                        <label for="{{$i}}D">{{$i}}D</label>
                    </li>
                    <li class="seat {{$i==26 || $i==39 || $i==40 || $i==41 || $i==42 ? 'invisible' : ''}}">
                        <input type="checkbox" id="{{$i}}F" value="150"/>
                        <label for="{{$i}}F">{{$i}}F</label>
                    </li>
                    <li class="seat {{$i==26 ? 'invisible' : ''}}">
                        <input type="checkbox" id="{{$i}}G" value="150"/>
                        <label for="{{$i}}G">{{$i}}G</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="{{$i}}H" value="150"/>
                        <label for="{{$i}}H">{{$i}}H</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="{{$i}}J" value="150"/>
                        <label for="{{$i}}J">{{$i}}J</label>
                    </li>
                </ol>
            </li>
            @endif
        @endfor
    </ol>
</div>