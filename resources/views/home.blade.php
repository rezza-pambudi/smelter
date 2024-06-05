@extends('welcome')

@section('container')
<div class="grid w-full h-screen grid-cols-1 my-auto xl:gap-14 md:gap-5">
    <div class="flex flex-col md:w-[700px] justify-center col-span-1 text-center lg:text-center mx-auto">
        
        <img src="{{url('/images/logo/logo-horizontal-ds-light.png')}}" alt="">

        <p class="mb-6 text-base font-normal leading-7 lg:w-2/3 text-black mx-auto my-4">
            Solusi semua kebutuhan design team Digital Bussiness.
        </p>

        <div class="flex flex-col items-center">
            <a href="/admin/login">
                <button class="flex items-center w-[220px] py-4 text-lg font-bold text-white text-center justify-center px-7 bg-purple-blue-500 hover:bg-purple-blue-600 focus:ring-4 focus:ring-purple-blue-100 transition duration-300 rounded-xl">Buat Request</button>
            </a>
        </div>

        <p class="mb-6 text-base font-normal leading-7 lg:w-2/3 text-black mx-auto my-6">
            Butuh bantuan? <a href="mailto:smelter@detiknetwork-salesproduct.com?cc=erick@detik.com, rezza@detik.com&subject=Butuh%20bantuan%20terhadap%20CMS%20Design%20Smelter&body=Dear%20Team%20Designer%2C%0A%0ASaya%20butuh%20bantuan%20untuk.."><span class="font-semibold text-grey-900">Hubungi kami</span></a>
        </p>

    </div>
</div>

@endsection

