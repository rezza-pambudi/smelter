<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{url('/images/logo/favicon.png')}}" type="image/x-icon">
  @vite('resources/css/app.css')
  @vite('resources/css/theme.css')
  @vite('resources/css/loopple/loopple.css')
</head>
<body>
    <div class="container flex flex-col mx-auto">
        <div class="relative flex flex-wrap items-center justify-between w-full bg-white group py-7 shrink-0">
            <div>
                <a href="/">
                    <img class="h-8" src="{{url('/images/logo/favicon.png')}}">
                </a>
            </div>
            {{-- <div class="items-center justify-between hidden gap-12 text-black md:flex">
                <a class="text-sm font-normal text-dark-grey-700 hover:text-dark-grey-900" href="javascript:void(0)">Docs</a>
            </div> --}}
            <div class="items-center hidden gap-8 md:flex">
                <a href="https://detiknetwork-salesproduct.com/">
                    <button class="flex items-center text-sm font-normal text-gray-800 hover:text-gray-900 transition duration-300">Sales Product</button>
                </a>
                <a href="/informasi">
                    <button class="flex items-center text-sm font-normal text-gray-800 hover:text-gray-900 transition duration-300">Informasi</button>
                </a>
                <a href="/admin/login">
                    <button class="flex items-center px-4 py-2 text-sm font-bold rounded-xl bg-purple-blue-100 text-purple-blue-600 hover:bg-purple-blue-600 hover:text-white transition duration-300">
                        Login Admin
                    </button>
                </a>
            </div>
            <button onclick="(() => { this.closest('.group').classList.toggle('open')})()" class="flex md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M3 8H21C21.2652 8 21.5196 7.89464 21.7071 7.70711C21.8946 7.51957 22 7.26522 22 7C22 6.73478 21.8946 6.48043 21.7071 6.29289C21.5196 6.10536 21.2652 6 21 6H3C2.73478 6 2.48043 6.10536 2.29289 6.29289C2.10536 6.48043 2 6.73478 2 7C2 7.26522 2.10536 7.51957 2.29289 7.70711C2.48043 7.89464 2.73478 8 3 8ZM21 16H3C2.73478 16 2.48043 16.1054 2.29289 16.2929C2.10536 16.4804 2 16.7348 2 17C2 17.2652 2.10536 17.5196 2.29289 17.7071C2.48043 17.8946 2.73478 18 3 18H21C21.2652 18 21.5196 17.8946 21.7071 17.7071C21.8946 17.5196 22 17.2652 22 17C22 16.7348 21.8946 16.4804 21.7071 16.2929C21.5196 16.1054 21.2652 16 21 16ZM21 11H3C2.73478 11 2.48043 11.1054 2.29289 11.2929C2.10536 11.4804 2 11.7348 2 12C2 12.2652 2.10536 12.5196 2.29289 12.7071C2.48043 12.8946 2.73478 13 3 13H21C21.2652 13 21.5196 12.8946 21.7071 12.7071C21.8946 12.5196 22 12.2652 22 12C22 11.7348 21.8946 11.4804 21.7071 11.2929C21.5196 11.1054 21.2652 11 21 11Z" fill="black"></path>
                </svg>
            </button>
            {{-- <div class="absolute flex md:hidden transition-all duration-300 ease-in-out flex-col items-start shadow-main justify-center w-full gap-3 overflow-hidden bg-white max-h-0 group-[.open]:py-4 px-4 rounded-2xl group-[.open]:max-h-64 top-full">
                <a class="text-sm font-normal text-dark-grey-700 hover:text-dark-grey-900" href="javascript:void(0)">Product</a>
                <a class="text-sm font-normal text-dark-grey-700 hover:text-dark-grey-900" href="javascript:void(0)">Features</a>
                <a class="text-sm font-normal text-dark-grey-700 hover:text-dark-grey-900" href="javascript:void(0)">Pricing</a>
                <a class="text-sm font-normal text-dark-grey-700 hover:text-dark-grey-900" href="javascript:void(0)">Company</a>
                <button class="flex items-center text-sm font-normal text-black">Log In</button>
                <button class="flex items-center px-4 py-2 text-sm font-bold rounded-xl bg-purple-blue-100 text-purple-blue-600 hover:bg-purple-blue-600 hover:text-white transition duration-300">Sign Up</button>
            </div> --}}
        </div>
        <div class="w-full">
            <div class="container flex flex-col mx-auto">
                <center>
                    <iframe src="https://calendar.google.com/calendar/embed?src=c_cc71e7b600c1c89b03436d7351d8cda8624375c1740758ff55dc533f02797e82%40group.calendar.google.com&ctz=Asia%2FJakarta" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
                </center>
                
            </div>
        </div>
        
    </div>
    
    
    <div class="w-full">
        <div class="container flex flex-col mx-auto">
            <div class="flex flex-col items-center w-full my-20">
                <img class="w-3/12 pb-4" src="{{url('/images/logo/logo-horizontal-light.png')}}" alt="">
                
                <div class="flex items-center">
                    <p class="text-base font-normal leading-7 text-center text-grey-700">©
                        2024 detikNetwork. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="loopple-badge">Property of<a href="#"><img src="{{url('/images/logo/logo-horizontal.png')}}" class="loopple-ml-1" style="width:55px"></a></div>
    <script src="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/motion-tailwind/scripts/plugins/countup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/motion-tailwind/scripts/countto.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/motion-tailwind/scripts/plugins/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/motion-tailwind/scripts/maps.js"></script>
</body>
@vite('resources/js/loopple.js')
</html>