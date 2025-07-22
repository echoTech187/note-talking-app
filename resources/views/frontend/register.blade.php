@include('layouts.frontend')
@section('title', 'Register')
@section('content')
    <div class="flex items-center justify-center transition-opacity opacity-90 duration-750 overflow-x-hidden starting:opacity-0 w-screen min-h-screen bg-[#0a0a0a]"
        style="background-image:url({{ asset('images/bg-images.jpg') }});background-position:center; background-attachment:fixed; background-color: rgba(0, 0, 0, 1); background-size:cover;background-repeat:no-repeat">
        <x-frontend.register />
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/signin.js') }}"></script>
@endsection
