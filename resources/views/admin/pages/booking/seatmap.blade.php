<div class="plane">
    <ol class="cabin fuselage">
        @for($i=1; $i <= 43; $i++)
            @if($i == 1)
            <li class="row--{{$i}}">
                <ol class="seats">
                    <li class="seat invisible business_seat">
                        <input type="checkbox" id="{{$i}}A" value="{{$seat_type[0]->price}}" />
                        <label for="{{$i}}A">{{$i}}A</label>
                    </li>
                    <li class="seat invisible business_seat">
                        <input type="checkbox" id="{{$i}}B" value="{{$seat_type[0]->price}}"/>
                        <label for="{{$i}}B">{{$i}}B</label>
                    </li>
                    <li class="seat business_seat">
                        <input type="checkbox" id="{{$i}}C" value="{{$seat_type[0]->price}}"/>
                        <label for="{{$i}}C">{{$i}}C</label>
                    </li>
                    <li class="seat business_seat invisible">
                        <input type="checkbox" {{$i==12 ? "disabled" : ""}} id="{{$i}}D" />
                        <label for="{{$i}}D">{{$i}}D</label>
                    </li>
                    <li class="seat business_seat invisible">
                        <input type="checkbox" id="{{$i}}F" value="{{$seat_type[0]->price}}"/>
                        <label for="{{$i}}F">{{$i}}F</label>
                    </li>
                    <li class="seat business_seat">
                        <input type="checkbox" id="{{$i}}G" value="{{$seat_type[0]->price}}"/>
                        <label for="{{$i}}G">{{$i}}G</label>
                    </li>
                    <li class="seat business_seat invisible">
                        <input type="checkbox" id="{{$i}}H" value="{{$seat_type[0]->price}}"/>
                        <label for="{{$i}}H">{{$i}}H</label>
                    </li>
                    <li class="seat business_seat invisible">
                        <input type="checkbox" id="{{$i}}J" value="{{$seat_type[0]->price}}"/>
                        <label for="{{$i}}J">{{$i}}J</label>
                    </li>
                </ol>
            </li>
            @elseif($i >=2 && $i <=9 )
            <li class="row--{{$i}}">
                <ol class="seats">
                    <li class="business_seat seat">
                        <input type="checkbox" id="{{$i}}A" value="{{$seat_type[0]->price}}" />
                        <label for="{{$i}}A">{{$i}}A</label>
                    </li>
                    <li class="business_seat seat invisible">
                        <input type="checkbox" id="{{$i}}B" value="{{$seat_type[0]->price}}"/>
                        <label for="{{$i}}B">{{$i}}B</label>
                    </li>
                    <li class="business_seat seat">
                        <input type="checkbox" id="{{$i}}C" value="{{$seat_type[0]->price}}"/>
                        <label for="{{$i}}C">{{$i}}C</label>
                    </li>
                    <li class="business_seat seat invisible">
                        <input type="checkbox" {{$i==12 ? "disabled" : ""}} id="{{$i}}D" />
                        <label for="{{$i}}D">{{$i}}D</label>
                    </li>
                    <li class="business_seat seat invisible">
                        <input type="checkbox" id="{{$i}}F" value="{{$seat_type[0]->price}}"/>
                        <label for="{{$i}}F">{{$i}}F</label>
                    </li>
                    <li class="business_seat seat">
                        <input type="checkbox" id="{{$i}}G" value="{{$seat_type[0]->price}}"/>
                        <label for="{{$i}}G">{{$i}}G</label>
                    </li>
                    <li class="business_seat seat invisible">
                        <input type="checkbox" id="{{$i}}H" value="{{$seat_type[0]->price}}"/>
                        <label for="{{$i}}H">{{$i}}H</label>
                    </li>
                    <li class="business_seat seat">
                        <input type="checkbox" id="{{$i}}J" value="{{$seat_type[0]->price}}"/>
                        <label for="{{$i}}J">{{$i}}J</label>
                    </li>
                </ol>
            </li>
            @elseif($i >= 10 && $i <= 42)
            <li class="row--{{$i}}">
                <ol class="seats">
                    <li class="seat">
                        <input type="checkbox" id="{{$i}}A" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}A">{{$i}}A</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="{{$i}}B" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}B">{{$i}}B</label>
                    </li>
                    <li class="seat {{$i==26 ? 'invisible' : ''}}">
                        <input type="checkbox" id="{{$i}}C" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}C">{{$i}}C</label>
                    </li>
                    <li class="seat {{$i==26 ? 'invisible' : ''}}">
                        <input type="checkbox" {{$i==12 ? "disabled" : ""}} id="{{$i}}D" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}D">{{$i}}D</label>
                    </li>
                    <li class="seat {{$i==26 || $i==39 || $i==40 || $i==41 || $i==42 ? 'invisible' : ''}}">
                        <input type="checkbox" id="{{$i}}F" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}F">{{$i}}F</label>
                    </li>
                    <li class="seat {{$i==26 ? 'invisible' : ''}}">
                        <input type="checkbox" id="{{$i}}G" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}G">{{$i}}G</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="{{$i}}H" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}H">{{$i}}H</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="{{$i}}J" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}J">{{$i}}J</label>
                    </li>
                </ol>
            </li>
            @elseif($i == 43)
            <li class="row--{{$i}}">
                <ol class="seats">
                    <li class="seat invisible">
                        <input type="checkbox" id="{{$i}}A" value="{{$seat_type[1]->price}}" />
                        <label for="{{$i}}A">{{$i}}A</label>
                    </li>
                    <li class="seat invisible">
                        <input type="checkbox" id="{{$i}}B" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}B">{{$i}}B</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="{{$i}}C" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}C">{{$i}}C</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" {{$i==12 ? "disabled" : ""}} id="{{$i}}D" />
                        <label for="{{$i}}D">{{$i}}D</label>
                    </li>
                    <li class="seat invisible">
                        <input type="checkbox" id="{{$i}}F" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}F">{{$i}}F</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="{{$i}}G" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}G">{{$i}}G</label>
                    </li>
                    <li class="seat invisible">
                        <input type="checkbox" id="{{$i}}H" value="{{$seat_type[1]->price}}"/>
                        <label for="{{$i}}H">{{$i}}H</label>
                    </li>
                    <li class="seat invisible">
                        <input type="checkbox" id="{{$i}}J" value="150"/>
                        <label for="{{$i}}J">{{$i}}J</label>
                    </li>
                </ol>
            </li>
            @endif
        @endfor
    </ol>
</div>