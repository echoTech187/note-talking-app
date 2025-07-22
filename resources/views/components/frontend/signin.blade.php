<div class=" w-full h-full flex-col items-center justify-center gap-16 hidden lg:flex mb-32">
    <div class="w-[200px] h-[200px]">
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-full h-full">
    </div>
    <div
        class="flex flex-col items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <span class="text-4xl font-bold text-white">Selamat Datang di Note Talking</span>
        <p class="mt-2  text-white ">Login untuk melanjutkan Note Talking</p>
    </div>
</div>
<div
    class="overflow-hidden flex flex-col items-center justify-center w-full xs:max-w-full sm:max-w-full md:max-w-1/2 lg:max-w-1/3 xl:max-w-1/3 min-h-screen transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0  bg-white p-12">
    <div>
        <img src="{{ asset('images/logo.png') }}" alt="logo" style="width: 150px; height: 150px;">
    </div>
    <h1 class="text-2xl font-bold text-[#444444] dark:text-[#efefef]">Sign In</h1>
    @if (session()->has('message'))
        <div class="mt-6 text-sm bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
            {{ session()->get('message') }}
        </div>
    @endif
    <form action="{{ route('login.post') }}" name="signinFrm" id="signinFrm" method="POST" class="mt-6 w-full">
        @csrf
        <x-frontend.input name="email" type="email" placeholder="Email" value="{{ old('email') }}"
            label="Email" />
        <x-frontend.input name="password" type="password" placeholder="Password" value="{{ old('password') }}"
            label="Password" />
        <button type="submit" class="button-red-pushable w-full" role="button">
            <span class="button-red-shadow"></span>
            <span class="button-red-edge w-full"></span>
            <span class="flex items-center justify-center button-red-front text-sm text-light font-bold w-full">
                <span class="icon-[tabler--circle-plus] size-6 mr-2"></span>
                <span>Masuk</span>
            </span>
        </button>
    </form>
    <div class="flex items-center justify-center mt-6">
        <span class="text-sm text-[#444444] dark:text-[#efefef]">Belum Punya Akun?</span>
        <a href="{{ route('register') }}"
            class="text-sm text-blue-600 hover:underline dark:text-[#efefef] ml-1">Daftar</a>
    </div>
</div>
