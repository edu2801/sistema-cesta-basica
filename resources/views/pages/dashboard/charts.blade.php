@extends('layouts.app')

@section('content')
<p-dashboard-charts :neighborhoods='@json($neighborhoods)' :ages='@json($ages)'
    :income='@json($income)'></p-dashboard-charts>
@endsection