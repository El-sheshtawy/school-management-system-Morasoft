@extends('layouts.master')
@section('css')
@endsection
    @section('title')
        إجراء اختبار
@endsection

@section('page-header')
    <!-- breadcrumb -->
@endsection
    @section('PageTitle')
        إجراء اختبار
    <!-- breadcrumb -->
@endsection
@section('content')

    @livewire('show-question', ['quizze_id' => $quizze_id, 'student_id' => $student_id])

@endsection
@section('js')
    @toastr_js
    @toastr_render
    @livewireScripts
@endsection
