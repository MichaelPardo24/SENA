
@foreach ($users as $user)
    {{$user->profile->names}} {{$user->profile->surnames}}
    <br>
    <br>
@endforeach