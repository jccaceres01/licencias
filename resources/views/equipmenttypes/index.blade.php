@extends ('layouts.main')

@section('content')
<equipments url="{{config('app.url')}}" loading="{{ asset('storage/img/page/loading.gif')}}" :permissions="{{ $permissions }}"></equipments>
@endsection

@section('script')
@endsection
