<select class="form-control" name="nationality">
    <option value="" disabled selected>-----</option>
   @foreach($countries as $code => $name)
    <option value="{{$code}}" @if($code == old('nationality')) selected @endif>{{$name}}</option>
    @endforeach
</select>
