<div class="plane">
    <input type="hidden" class="trip_type_value" value="{{$trip_type}}">
    <ol class="cabin fuselage">
        @for($i=1; $i <= 43; $i++)
            @if($i == 1)
            <li class="row--{{$i}}">
                <ol class="seats">
                    <li class="seat invisible business_seat">
                        <input type="checkbox" {{in_array($i."A", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}A" class="bussiness_price" value="{{$bussiness_price}}" />
                        <label for="{{$i}}A">{{$i}}A</label>
                    </li>
                    <li class="seat invisible business_seat">
                        <input type="checkbox" {{in_array($i."B", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}B" value="{{$bussiness_price}}"/>
                        <label for="{{$i}}B">{{$i}}B</label>
                    </li>
                    <li class="seat business_seat">
                        <input type="checkbox" {{in_array($i."C", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}C" value="{{$bussiness_price}}"/>
                        <label for="{{$i}}C">{{$i}}C</label>
                    </li>
                    <li class="seat business_seat invisible">
                        <input type="checkbox" {{in_array($i."D", $bussiness_seat, true) ? "disabled" : ""}} {{$i==12 ? "disabled" : ""}} id="{{$i}}D" />
                        <label for="{{$i}}D">{{$i}}D</label>
                    </li>
                    <li class="seat business_seat invisible">
                        <input type="checkbox" {{in_array($i."F", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}F" value="{{$bussiness_price}}"/>
                        <label for="{{$i}}F">{{$i}}F</label>
                    </li>
                    <li class="seat business_seat">
                        <input type="checkbox" {{in_array($i."G", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}G" value="{{$bussiness_price}}"/>
                        <label for="{{$i}}G">{{$i}}G</label>
                    </li>
                    <li class="seat business_seat invisible">
                        <input type="checkbox" {{in_array($i."H", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}H" value="{{$bussiness_price}}"/>
                        <label for="{{$i}}H">{{$i}}H</label>
                    </li>
                    <li class="seat business_seat invisible">
                        <input type="checkbox" {{in_array($i."J", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}J" value="{{$bussiness_price}}"/>
                        <label for="{{$i}}J">{{$i}}J</label>
                    </li>
                </ol>
            </li>
            @elseif($i >=2 && $i <=9 )
            <li class="row--{{$i}}">
                <ol class="seats">
                    <li class="business_seat seat">
                        <input type="checkbox" {{in_array($i."A", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}A" value="{{$bussiness_price}}" />
                        <label for="{{$i}}A">{{$i}}A</label>
                    </li>
                    <li class="business_seat seat invisible">
                        <input type="checkbox" {{in_array($i."B", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}B" value="{{$bussiness_price}}"/>
                        <label for="{{$i}}B">{{$i}}B</label>
                    </li>
                    <li class="business_seat seat">
                        <input type="checkbox" {{in_array($i."C", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}C" value="{{$bussiness_price}}"/>
                        <label for="{{$i}}C">{{$i}}C</label>
                    </li>
                    <li class="business_seat seat invisible">
                        <input type="checkbox" {{in_array($i."D", $bussiness_seat, true) ? "disabled" : ""}} {{$i==12 ? "disabled" : ""}} id="{{$i}}D" />
                        <label for="{{$i}}D">{{$i}}D</label>
                    </li>
                    <li class="business_seat seat invisible">
                        <input type="checkbox" {{in_array($i."F", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}F" value="{{$bussiness_price}}"/>
                        <label for="{{$i}}F">{{$i}}F</label>
                    </li>
                    <li class="business_seat seat">
                        <input type="checkbox" {{in_array($i."G", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}G" value="{{$bussiness_price}}"/>
                        <label for="{{$i}}G">{{$i}}G</label>
                    </li>
                    <li class="business_seat seat invisible">
                        <input type="checkbox" {{in_array($i."H", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}H" value="{{$bussiness_price}}"/>
                        <label for="{{$i}}H">{{$i}}H</label>
                    </li>
                    <li class="business_seat seat">
                        <input type="checkbox" {{in_array($i."J", $bussiness_seat, true) ? "disabled" : ""}} id="{{$i}}J" value="{{$bussiness_price}}"/>
                        <label for="{{$i}}J">{{$i}}J</label>
                    </li>
                </ol>
            </li>
            @elseif($i >= 10 && $i <= 42)
            <li class="row--{{$i}}">
                <ol class="seats">
                    <li class="seat">
                        <input type="checkbox" {{in_array($i."A", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}A" class="economy_price" value="{{$economy_price}}"/>
                        <label for="{{$i}}A">{{$i}}A</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" {{in_array($i."B", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}B" value="{{$economy_price}}"/>
                        <label for="{{$i}}B">{{$i}}B</label>
                    </li>
                    <li class="seat {{$i==26 ? 'invisible' : ''}}">
                        <input type="checkbox" {{in_array($i."C", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}C" value="{{$economy_price}}"/>
                        <label for="{{$i}}C">{{$i}}C</label>
                    </li>
                    <li class="seat {{$i==26 ? 'invisible' : ''}}">
                        <input type="checkbox" {{in_array($i."D", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}D" value="{{$economy_price}}"/>
                        <label for="{{$i}}D">{{$i}}D</label>
                    </li>
                    <li class="seat {{$i==26 || $i==39 || $i==40 || $i==41 || $i==42 ? 'invisible' : ''}}">
                        <input type="checkbox" {{in_array($i."F", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}F" value="{{$economy_price}}"/>
                        <label for="{{$i}}F">{{$i}}F</label>
                    </li>
                    <li class="seat {{$i==26 ? 'invisible' : ''}}">
                        <input type="checkbox" {{in_array($i."G", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}G" value="{{$economy_price}}"/>
                        <label for="{{$i}}G">{{$i}}G</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" {{in_array($i."H", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}H" value="{{$economy_price}}"/>
                        <label for="{{$i}}H">{{$i}}H</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" {{in_array($i."J", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}J" value="{{$economy_price}}"/>
                        <label for="{{$i}}J">{{$i}}J</label>
                    </li>
                </ol>
            </li>
            @elseif($i == 43)
            <li class="row--{{$i}}">
                <ol class="seats">
                    <li class="seat invisible">
                        <input type="checkbox" {{in_array($i."A", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}A" value="{{$economy_price}}" />
                        <label for="{{$i}}A">{{$i}}A</label>
                    </li>
                    <li class="seat invisible">
                        <input type="checkbox" {{in_array($i."B", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}B" value="{{$economy_price}}"/>
                        <label for="{{$i}}B">{{$i}}B</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" {{in_array($i."C", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}C" value="{{$economy_price}}"/>
                        <label for="{{$i}}C">{{$i}}C</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" {{in_array($i."D", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}D" />
                        <label for="{{$i}}D">{{$i}}D</label>
                    </li>
                    <li class="seat invisible">
                        <input type="checkbox" {{in_array($i."F", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}F" value="{{$economy_price}}"/>
                        <label for="{{$i}}F">{{$i}}F</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" {{in_array($i."G", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}G" value="{{$economy_price}}"/>
                        <label for="{{$i}}G">{{$i}}G</label>
                    </li>
                    <li class="seat invisible">
                        <input type="checkbox" {{in_array($i."H", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}H" value="{{$economy_price}}"/>
                        <label for="{{$i}}H">{{$i}}H</label>
                    </li>
                    <li class="seat invisible">
                        <input type="checkbox" {{in_array($i."J", $economy_seat, true) ? "disabled" : ""}} id="{{$i}}J" value="150"/>
                        <label for="{{$i}}J">{{$i}}J</label>
                    </li>
                </ol>
            </li>
            @endif
        @endfor
    </ol>
</div>