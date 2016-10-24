@extends('layouts.app')
@section('content')
<div> 
    <transition name="fade">
        <router-view></router-view>
    </transition>
</div>
@endsection
