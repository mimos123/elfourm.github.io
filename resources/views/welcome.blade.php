<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EL Forum</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="website-icon" href="{{ asset('icon.png') }}">

    <!-- Icon Font -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css']) <!-- Assuming this is a valid directive for a Laravel-like framework -->

    <style>
        #carouselExampleIndicators .carousel-inner {
            height: 500px; /* Fixed height */
        }
        #carouselExampleIndicators .carousel-item img {
            height: 100%;
            object-fit: cover;
            width: 100%;
            object-position: center;
        }

        .image-stack {
            position: relative;
            width: 50%; /* Adjust width as needed */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .content {
            margin-left: 2%; /* Adjust spacing between image and content */
            display: flex;
            flex-direction: column;
        }

        .card {
  overflow: visible;
  width: 500px;
  height: 300px;
  justify-content: center;
  justify-self: center;
}

.content1 {
  width: 100%;
  height: 100%;
  transform-style: preserve-3d;
  transition: transform 300ms;
  box-shadow: 0px 0px 10px 1px #000000ee;
  border-radius: 5px;
}

.front, .back {
  background-color: #151515;
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
  border-radius: 5px;
  overflow: hidden;
}

.back {
  width: 100%;
  height: 100%;
  justify-content: center;
  display: flex;
  align-items: center;
  overflow: hidden;
}

.back::before {
  position: absolute;
  content: ' ';
  display: block;
  width: 160px;
  height: 160%;

}

.back-content {
  position: absolute;
  width: 99%;
  height: 99%;

  border-radius: 5px;
  color: white;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 30px;
}

.card:hover .content1 {
  transform: rotateY(180deg);
}

@keyframes rotation_481 {
  0% {
    transform: rotateZ(0deg);
  }

  0% {
    transform: rotateZ(360deg);
  }
}

.front {
  transform: rotateY(180deg);
  color: white;
}

.front .front-content {
  position: absolute;
  width: 100%;
  height: 100%;
  padding: 10px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.front-content .badge {

  padding: 2px 10px;
  border-radius: 10px;
  backdrop-filter: blur(2px);
  width: fit-content;
}

.description {
  box-shadow: 0px 0px 10px 5px #00000088;
  width: 100%;
  padding: 10px;
  background-color: #00000099;
  backdrop-filter: blur(5px);
  border-radius: 5px;
}

.title {
  font-size: 11px;
  max-width: 100%;
  display: flex;
  justify-content: space-between;
}

.title p {
  width: 50%;
}

.card-footer {
  color: #ffffff88;
  margin-top: 5px;
  font-size: 8px;
}

.front .img {
  position: absolute;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}


#bottom {
  background-color: #ff8866;
  left: 50px;
  top: 0px;
  width: 150px;
  height: 150px;
  animation-delay: -800ms;
}

#right {
  background-color: #ff2233;
  left: 160px;
  top: -80px;
  width: 30px;
  height: 30px;
  animation-delay: -1800ms;
}

@keyframes floating {
  0% {
    transform: translateY(0px);
  }

  50% {
    transform: translateY(10px);
  }

  100% {
    transform: translateY(0px);
  }
}
.event-container {
   /* This makes sure that the absolute elements inside it are positioned relative to this container */
    padding-top: 20px;
    justify-content: space-between; /* Additional padding to ensure there is space at the top if needed */
}
    </style>
    </head>
    <body class="font-sans antialiased bg-white text-black">
        <div class="bg-white text-black">
            <header class="bg-white p-4 text-black flex items-center justify-between w-full shadow-md">
            <img src="{{ asset('logo1.png') }}" alt="Logo" class="h-8">
            <nav class="lg:flex gap-4">
                <a href="#" class="text-gray-500 hover:text-black hover:font-bold">Home</a>
                <a href="#" class="text-gray-500 hover:text-black hover:font-bold">About</a>
                <a href="#" class="text-gray-500 hover:text-black hover:font-bold">Events</a>
                <a href="#" class="text-gray-500 hover:text-black hover:font-bold">Contact</a>
            </nav>
            <div class="flex gap-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-600">My Space</a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-gray-500 hover:text-blue-600">Sign in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-600">Sign up</a>
                    @endif
                @endauth
            </div>
        </header>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('1.jpg') }}" class="d-block w-100" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('2.jpg') }}" class="d-block w-100" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('3.jpg') }}" class="d-block w-100" alt="Third slide">
                </div>
            </div>
        </div>
    <div class="overflow-hidden mt-5 shadow-md bg-white">
            <div class="flex justify-around items-center px-4 animate-marquee">
                <div class="flex items-center space-x-2 p-4">
                    <i class="fas fa-code fa-3x text-blue-700"></i>
                    <span class="text-blue-700 font-inter font-black text-4xl">JPO IT</span>
                </div>
                <div class="flex items-center space-x-2 p-4">
                    <i class="fa-solid fa-seedling fa-3x text-green-800"></i>
                    <span class="text-green-800 font-inter font-black text-4xl">JPO BIO</span>
                </div>
                <div class="flex items-center space-x-2 p-4">
                    <i class="fa-solid fa-helmet-safety fa-3x text-red-700"></i>
                    <span class="text-red-700 font-inter font-black text-4xl">JPO Civil</span>
                </div>
                <div class="flex items-center space-x-2 p-4">
                    <i class="fa-solid fa-gears fa-3x text-yellow-400"></i>
                    <span class="text-yellow-400 font-inter font-black text-4xl">JPO EA/EM</span>
                </div>
                <div class="flex items-center space-x-2 p-4">
                    <i class="fa-solid fa-archway fa-3x text-orange-700"></i>
                    <span class="text-orange-700 font-inter font-black text-4xl">JPO Archi</span>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-4 mt-32 flex justify-between items-center" style="min-height: 500px; background-image: url('{{ asset('background.png') }}'); background-position: bottom right; background-repeat: no-repeat; background-size: 600px 400px;">
            <div class="image-stack flex-1">
                <img src="about.png" alt="JPO">
            </div>
            <div class="content flex-1 text-left">
                <h1 class="text-5xl font-black font-inter mb-4 text-black">Ready to dive in?</h1>
                <h2 class="text-4xl font-black font-inter mb-3 text-blue-700">Let's start.</h2>
                <p>Start building for free, then add a site plan to go live. Account plans unlock additional features.<br>Start building for free, then add a site plan to go live. Account plans unlock additional features. Lorem ipsum granted for weeks to go alone for long...</p>
                <div class="flex justify-end items-center mr-10"> <!-- This container will align all its children to the right -->
                    <button class="mt-4 bg-gradient-to-r from-white to-[#7890df] text-blue-700 font-bold py-1 px-2 rounded shadow-md w-48 h-10 text-sm">
                        For more info
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-3 h-3 inline-block ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!--------eVENT section------>
        <div class="p-5 mt-24">
<div class="event-container px-4 mt-32 flex justify-between items-center" style="min-height: 500px; background-image: url('{{ asset('background.png') }}'); background-position: top left; background-repeat: no-repeat; background-size: 500px 400px;">
    <div class="text-5xl font-black font-inter text-black absolute text-left">Recent events

            <div class="grid grid-cols-2 gap-20 mt-9 ml-24">
                @foreach ($recentEvents as $event)
                    <div>
                        <div class="card">
                            <div class="content1">
                                <!-- Front of the Card -->
                                <div class="back">
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="object-cover w-full h-full">
                                    <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 text-white p-4 w-full">
                                        <h2 class="text-xl font-semibold">{{ $event->name }}</h2>
                                        <p class="text-sm">{{ $event->created_at->toFormattedDateString() }}</p>
                                    </div>
                                </div>
                                <!-- Back of the Card -->
                                <div class="front">
                                    <div class="back-content flex flex-col justify-center items-center h-full">
                                        <p class="text-white text-lg">{{ $event->description }}</p>
                                          <div class="mt-2">
                        <strong>Tags:</strong>
                        <ul>
                            @foreach ($event->tags as $tag)
                                <li>{{ $tag->name }}</li> <!-- Display each tag's name -->
                            @endforeach
                        </ul>
                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>


    <div class="flex justify-center items-center mt-16" style="min-height: 500px; background-image: url('{{ asset('background.png') }}'); background-position: top right; background-repeat: no-repeat; background-size: 500px 400px;">
        <div class="w-full max-w-4xl mx-auto bg-white shadow-lg overflow-hidden mt-10">
            <div class="md:flex">
                <!-- Contact Information -->
                <div class="md:w-1/2 p-8 bg-[#EFF6FF]">
                    <h1 class="text-3xl font-semibold font-inter mt-7 mb-4 text-black">Get in touch</h1>
                    <p>Nullam risus blandit ac aliquam justo ipsum. Quam mauris volutpat massa dictumst amet. Sapien tortor lacus arcu.</p>
                    <div class="mt-4">
                        <p class="mb-2">742 Evergreen Terrace<br>Springfield, OR 12345</p>
                        <p class="mb-2">+1 (555) 123-4567</p>
                        <p class="mb-4">support@example.com</p>
                        <a href="#" class="text-blue-500 hover:underline">View all job openings.</a>
                    </div>
                </div>
                <!-- Form -->
                <div class="md:w-1/2 p-8">
                    <form action="#" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <x-input-label for="fullname" :value="__('Full name')" />
                            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" required autofocus />
                            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                        </div>
                        <div class="space-y-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="space-y-4">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                        <div class="space-y-4">
                            <x-input-label for="message" :value="__('Message')" />
                            <textarea id="message" name="message" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="4"></textarea>
                        </div>
                        <div class="flex items-center mt-4">
                            <input id="privacy" name="privacy" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <label for="privacy" class="ml-2 text-sm text-gray-600">{{ __('I have read and accept the privacy policy.') }}</label>
                        </div>
                        <x-primary-button class="w-full mt-4">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <footer class="p-10 bg-blue-800  text-white font-inter mt-24">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
            <!-- Company Info -->
            <div class="space-y-4">
                <img src="logoform.png" alt="EL Forum Logo" class="h-24">
                <p><i class="fas fa-map-marker-alt mt-5"></i> Route Ceinture Sahoului Entrée Kalaa Sghira 4021 - sousse Tunisie.</p>
                <p><i class="fas fa-phone"></i> (+216) 99 277 877</p>
                <p><i class="fas fa-envelope"></i> contact@polytecsousse.tn</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-blue-200 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-blue-200 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-blue-200 hover:text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <!-- Quick Links -->
            <div class="mt-24 justify-center justify-items-center items-center ml-24">
                <h3 class="text-xl mb-2 font-bold">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-blue-200">Home</a></li>
                    <li><a href="#" class="hover:text-blue-200">About Us</a></li>
                    <li><a href="#" class="hover:text-blue-200">Events</a></li>
                    <li><a href="#" class="hover:text-blue-200">Contact us</a></li>
                </ul>
            </div>
            <!-- Newsletter -->
            <div class="mt-24">
                <h3 class="text-xl mb-2 font-bold">Newsletter</h3>
                <p>Enter your email to get discounts and offers</p>
                <div class="mt-4 flex">
                    <input type="email" placeholder="Email" class="p-2 rounded-l-md flex-1">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 rounded-r-md">Send</button>
                </div>
            </div>
        </div>
        <div class="text-center text-gray-300 mt-8 text-sm">
            © EL Forum. 2024 All Rights Reserved
        </div>
    </footer>
    <!-- Icons CDN Link -->
    <script src="https://kit.fontawesome.com/your-kit-code.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        window.onload = function() {
            window.scrollTo(0, 0);
        }
    </script>
</body>
</html>
