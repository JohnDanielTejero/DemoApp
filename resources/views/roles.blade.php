{{-- @foreach($user_roles as $value)
    <h1>{{$value->role_name}}</h1>
@endforeach --}}
@hasRoles(['Member','Admin'])
    <h1>hello world</h1>
@endHasRoles

@role('Admin')
    <h1>Hello world again</h1>
@endrole

@HasAnyRole(['Member','Admin'])
    <h1>Hello world again bitch</h1>
@EndHasAnyRoles
