@extends('welcome')

@section('container')
<div class="grid w-full h-screen grid-cols-1 my-auto xl:gap-14 md:gap-5">
    <div class="flex flex-col w-[700px] justify-center col-span-1 text-center lg:text-center mx-auto">
        
        <img src="{{url('/images/logo/logo-horizontal-ds-light.png')}}" alt="">

        <p class="mb-6 text-base font-normal leading-7 lg:w-2/3 text-grey-900 mx-auto my-4">
            Solusi semua kebutuhan Design team Digital Bussiness.
        </p>

        <div class="flex flex-col items-center">
            <a href="/guest/login">
                <button class="flex items-center py-4 text-sm font-bold text-white px-7 bg-purple-blue-500 hover:bg-purple-blue-600 focus:ring-4 focus:ring-purple-blue-100 transition duration-300 rounded-xl">Buat Request</button>
            </a>
        </div>
    </div>
</div>

@endsection

