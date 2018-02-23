@extends ('layouts.main')

@section('content')
<courses url="{{config('app.url')}}" loading="{{ asset('storage/img/page/loading.gif')}}" :permissions="{{ $permissions }}"></courses>
@endsection

@section('script')
@endsection
