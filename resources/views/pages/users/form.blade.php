@extends('layouts.app')

@section('content')
    <p-users-form :user='@json($user ?? null)'></p-users-form>
@endsection
