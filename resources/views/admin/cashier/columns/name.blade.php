<div class="flex gap-x-3 items-center">
    <div class="avatar">
        <div class="w-12 rounded">
            <img src="{{$data->profile_picture ? asset($data->profile_picture) : asset('images/menu/default.jpg')}}" />
        </div>
    </div>
    <p>
        {{$data->first_name}} {{$data->last_name}}
    </p>
</div>
