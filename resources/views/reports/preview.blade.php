@extends('layouts.main')

@section('head')
<style>
  .rpt_preview {
    max-width: 99%;
    max-height: 99%;
    width: 99%;
    height: 800px;
    margin: 0px;
    padding:0px;
  }
</style>
@endsection

@section('content')

<iframe src="{{ $report_url }}" frameborder="0" class="rpt_preview"> </iframe>
@endsection