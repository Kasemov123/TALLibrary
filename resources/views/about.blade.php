<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - BookLibrary</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <x-navbar />
    
    <main class="flex-grow py-16">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">About BookLibrary</h1>
                <p class="text-xl text-gray-600">Your gateway to endless knowledge and adventure</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Mission</h2>
                    <p class="text-gray-600 mb-4">
                        We believe that books have the power to transform lives, spark imagination, and connect people across cultures and generations.
                    </p>
                    <p class="text-gray-600">
                        Our mission is to make quality literature accessible to everyone, fostering a community of passionate readers and lifelong learners.
                    </p>
                </div>
                <div class="bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl p-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Quality First</h3>
                        <p class="text-gray-600 mt-2">Curated collection of the finest books</p>
                    </div>
                </div>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-white rounded-xl shadow-lg">
                    <div class="text-3xl font-bold text-blue-600 mb-2">1000+</div>
                    <div class="text-gray-600">Books Available</div>
                </div>
                <div class="text-center p-6 bg-white rounded-xl shadow-lg">
                    <div class="text-3xl font-bold text-indigo-600 mb-2">500+</div>
                    <div class="text-gray-600">Happy Readers</div>
                </div>
                <div class="text-center p-6 bg-white rounded-xl shadow-lg">
                    <div class="text-3xl font-bold text-purple-600 mb-2">50+</div>
                    <div class="text-gray-600">Categories</div>
                </div>
            </div>
        </div>
    </main>
    
    <x-footer />
</body>
</html>