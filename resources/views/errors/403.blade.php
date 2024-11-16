@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code1', '4')
@section('code2', '0')
@section('code3', '3')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
