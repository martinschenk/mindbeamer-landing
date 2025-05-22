<?php
// Session für CSRF-Token und Sprachauswahl
require_once __DIR__ . '/bootstrap.php';

// CSRF-Token Generierung wird bereits in bootstrap.php gehandhabt
?>

<!DOCTYPE html>
<html lang="<?php echo $htmlLang; ?>">
<head>
  <meta charset="UTF-8">
  <title>MindBeamer - <?php echo __('hero_title'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo __('hero_subtitle'); ?>">
  <meta name="keywords" content="autonomous AI content, automated blog posts, autonomous social media, automated content creation, MindBeamer, free demo">
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Alpine.js -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <!-- Remix Icon -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
    .hero-bg { background: linear-gradient(135deg, #FF6B6B, #4ECDC4); }
    .btn-primary { transition: transform 0.2s, background-color 0.3s; }
    .btn-primary:hover { transform: scale(1.05); }
    .section-title { background: linear-gradient(to right, #FF6B6B, #4ECDC4); -webkit-background-clip: text; background-clip: text; color: transparent; }
    .fade-in { animation: fadeIn 1s ease-in; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
  </style>
  <link rel="canonical" href="https://mindbeamer.io">
</head>
<body class="bg-gray-50 text-gray-900">

<!-- Header -->
<header class="bg-white shadow fixed top-0 w-full z-20" x-data="{ open: false }">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
    <a href="#" class="text-3xl font-bold text-pink-500">MindBeamer</a>
    <nav class="hidden md:flex space-x-8">
      <a href="#how-it-works" class="text-gray-700 hover:text-pink-500 font-medium"><?php echo __('nav_how_it_works'); ?></a>
      <a href="#features" class="text-gray-700 hover:text-pink-500 font-medium"><?php echo __('nav_features'); ?></a>
      <a href="#why-us" class="text-gray-700 hover:text-pink-500 font-medium"><?php echo __('nav_why_us'); ?></a>
      <a href="#contact" class="text-gray-700 hover:text-pink-500 font-medium"><?php echo __('nav_demo'); ?></a>
      <div class="flex items-center space-x-2">
        <a href="<?php echo getLocaleUrl('en'); ?>" class="text-gray-700 hover:text-pink-500 font-medium <?php echo isCurrentLocale('en') ? 'font-bold' : ''; ?>">EN</a>
        <span class="text-gray-500">|</span>
        <a href="<?php echo getLocaleUrl('de'); ?>" class="text-gray-700 hover:text-pink-500 font-medium <?php echo isCurrentLocale('de') ? 'font-bold' : ''; ?>">DE</a>
      </div>
    </nav>
    <button class="md:hidden" @click="open = !open">
      <i class="ri-menu-line text-2xl"></i>
    </button>
  </div>
  <!-- Mobile menu -->
  <div class="md:hidden" x-show="open" @click.away="open = false">
    <nav class="bg-white px-6 pb-4 space-y-4">
      <a href="#how-it-works" class="block text-gray-700 hover:text-pink-500 font-medium"><?php echo __('nav_how_it_works'); ?></a>
      <a href="#features" class="block text-gray-700 hover:text-pink-500 font-medium"><?php echo __('nav_features'); ?></a>
      <a href="#why-us" class="block text-gray-700 hover:text-pink-500 font-medium"><?php echo __('nav_why_us'); ?></a>
      <a href="#contact" class="block text-gray-700 hover:text-pink-500 font-medium"><?php echo __('nav_demo'); ?></a>
      <div class="flex items-center space-x-2 pt-2 border-t">
        <a href="<?php echo getLocaleUrl('en'); ?>" class="text-gray-700 hover:text-pink-500 font-medium <?php echo isCurrentLocale('en') ? 'font-bold' : ''; ?>">EN</a>
        <span class="text-gray-500">|</span>
        <a href="<?php echo getLocaleUrl('de'); ?>" class="text-gray-700 hover:text-pink-500 font-medium <?php echo isCurrentLocale('de') ? 'font-bold' : ''; ?>">DE</a>
      </div>
    </nav>
  </div>
</header>

<!-- Hero Section -->
<section id="hero" class="hero-bg text-white pt-36 pb-20">
  <div class="container mx-auto px-6 text-center fade-in">
    <h1 class="text-4xl md:text-6xl font-bold mb-6"><?php echo __('hero_title'); ?></h1>
    <p class="text-xl md:text-2xl mb-12 max-w-3xl mx-auto">
      <?php echo __('hero_subtitle'); ?>
    </p>
    <div class="flex flex-col md:flex-row justify-center gap-4">
      <a href="#contact" class="btn-primary bg-white text-pink-600 font-semibold py-4 px-8 rounded-full shadow-lg hover:bg-gray-100"><?php echo __('hero_cta'); ?></a>
    </div>
  </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="bg-white py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12"><?php echo __('how_it_works_title'); ?></h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
      <div class="text-center">
        <div class="text-pink-500 text-4xl mb-4 flex justify-center">
          <i class="ri-settings-3-line bg-pink-100 p-4 rounded-full"></i>
        </div>
        <h3 class="text-xl font-bold mb-4"><?php echo __('step1_title'); ?></h3>
        <p class="text-gray-600"><?php echo __('step1_description'); ?></p>
      </div>
      <div class="text-center">
        <div class="text-teal-500 text-4xl mb-4 flex justify-center">
          <i class="ri-lightbulb-flash-line bg-teal-100 p-4 rounded-full"></i>
        </div>
        <h3 class="text-xl font-bold mb-4"><?php echo __('step2_title'); ?></h3>
        <p class="text-gray-600"><?php echo __('step2_description'); ?></p>
      </div>
      <div class="text-center">
        <div class="text-pink-500 text-4xl mb-4 flex justify-center">
          <i class="ri-file-edit-line bg-pink-100 p-4 rounded-full"></i>
        </div>
        <h3 class="text-xl font-bold mb-4"><?php echo __('step3_title'); ?></h3>
        <p class="text-gray-600"><?php echo __('step3_description'); ?></p>
      </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
      <div class="text-center">
        <div class="text-teal-500 text-4xl mb-4 flex justify-center">
          <i class="ri-edit-line bg-teal-100 p-4 rounded-full"></i>
        </div>
        <h3 class="text-xl font-bold mb-4"><?php echo __('step4_title'); ?></h3>
        <p class="text-gray-600"><?php echo __('step4_description'); ?></p>
      </div>
      <div class="text-center">
        <div class="text-pink-500 text-4xl mb-4 flex justify-center">
          <i class="ri-rocket-line bg-pink-100 p-4 rounded-full"></i>
        </div>
        <h3 class="text-xl font-bold mb-4"><?php echo __('step5_title'); ?></h3>
        <p class="text-gray-600"><?php echo __('step5_description'); ?></p>
      </div>
    </div>
    <div class="text-center mt-12">
      <a href="#contact" class="btn-primary bg-pink-500 text-white font-semibold py-4 px-8 rounded-full shadow-lg hover:bg-pink-600"><?php echo __('hero_cta'); ?></a>
    </div>
  </div>
</section>

<!-- Why MindBeamer Stands Out Section -->
<section id="why-us" class="bg-white py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-8"><?php echo __('why_stands_out_title'); ?></h2>
    
    <p class="text-center text-gray-700 mb-12 max-w-3xl mx-auto">
      <?php echo __('why_stands_out_subtitle'); ?>
    </p>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- vs Jasper AI -->
      <div class="bg-gray-50 p-8 rounded-2xl shadow-md">
        <h3 class="text-xl font-bold mb-4 text-center"><?php echo __('vs_jasper_title'); ?></h3>
        <p class="text-gray-600"><?php echo __('vs_jasper_description'); ?></p>
      </div>
      
      <!-- vs Buffer/Hootsuite -->
      <div class="bg-gray-50 p-8 rounded-2xl shadow-md">
        <h3 class="text-xl font-bold mb-4 text-center"><?php echo __('vs_buffer_title'); ?></h3>
        <p class="text-gray-600"><?php echo __('vs_buffer_description'); ?></p>
      </div>
      
      <!-- vs ContentStudio -->
      <div class="bg-gray-50 p-8 rounded-2xl shadow-md">
        <h3 class="text-xl font-bold mb-4 text-center"><?php echo __('vs_contentstudio_title'); ?></h3>
        <p class="text-gray-600"><?php echo __('vs_contentstudio_description'); ?></p>
      </div>
    </div>
    
    <div class="text-center mt-12">
      <p class="text-xl mb-6"><?php echo __('ready_to_see'); ?></p>
      <a href="#contact" class="btn-primary bg-pink-500 text-white font-semibold py-4 px-8 rounded-full shadow-lg hover:bg-pink-600 inline-block"><?php echo __('ask_for_demo'); ?></a>
    </div>
  </div>
</section>

<!-- Features Section -->
<section id="features" class="bg-white py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12"><?php echo __('features_title'); ?></h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
      <!-- Feature 1 -->
      <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow">
        <div class="text-pink-500 text-3xl mb-4 flex justify-center">
          <i class="ri-robot-line"></i>
        </div>
        <h3 class="text-xl font-bold mb-3 text-center"><?php echo __('feature1_title'); ?></h3>
        <p class="text-gray-600 text-center"><?php echo __('feature1_description'); ?></p>
      </div>
      
      <!-- Feature 2 -->
      <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow">
        <div class="text-teal-500 text-3xl mb-4 flex justify-center">
          <i class="ri-global-line"></i>
        </div>
        <h3 class="text-xl font-bold mb-3 text-center"><?php echo __('feature2_title'); ?></h3>
        <p class="text-gray-600 text-center"><?php echo __('feature2_description'); ?></p>
      </div>
      
      <!-- Feature 3 -->
      <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow">
        <div class="text-pink-500 text-3xl mb-4 flex justify-center">
          <i class="ri-image-line"></i>
        </div>
        <h3 class="text-xl font-bold mb-3 text-center"><?php echo __('feature3_title'); ?></h3>
        <p class="text-gray-600 text-center"><?php echo __('feature3_description'); ?></p>
      </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Feature 4 -->
      <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow">
        <div class="text-teal-500 text-3xl mb-4 flex justify-center">
          <i class="ri-calendar-line"></i>
        </div>
        <h3 class="text-xl font-bold mb-3 text-center"><?php echo __('feature4_title'); ?></h3>
        <p class="text-gray-600 text-center"><?php echo __('feature4_description'); ?></p>
      </div>
      
      <!-- Feature 5 -->
      <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow">
        <div class="text-pink-500 text-3xl mb-4 flex justify-center">
          <i class="ri-check-line"></i>
        </div>
        <h3 class="text-xl font-bold mb-3 text-center"><?php echo __('feature5_title'); ?></h3>
        <p class="text-gray-600 text-center"><?php echo __('feature5_description'); ?></p>
      </div>
      
      <!-- Feature 6 -->
      <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow">
        <div class="text-teal-500 text-3xl mb-4 flex justify-center">
          <i class="ri-building-line"></i>
        </div>
        <h3 class="text-xl font-bold mb-3 text-center"><?php echo __('feature6_title'); ?></h3>
        <p class="text-gray-600 text-center"><?php echo __('feature6_description'); ?></p>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="bg-gray-100 py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12"><?php echo __('testimonials_title'); ?></h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Testimonial 1 -->
      <div class="bg-white p-8 rounded-2xl shadow-md">
        <div class="flex items-center mb-4">
          <?php for($i=0; $i<5; $i++) { ?>
            <i class="ri-star-fill text-yellow-400"></i>
          <?php } ?>
        </div>
        <p class="text-gray-700 mb-6">"<?php echo __('testimonial1_text'); ?>"</p>
        <div class="flex items-center">
          <div class="ml-4">
            <p class="font-bold"><?php echo __('testimonial1_name'); ?></p>
            <p class="text-gray-600 text-sm"><?php echo __('testimonial1_position'); ?></p>
          </div>
        </div>
      </div>
      
      <!-- Testimonial 2 -->
      <div class="bg-white p-8 rounded-2xl shadow-md">
        <div class="flex items-center mb-4">
          <?php for($i=0; $i<5; $i++) { ?>
            <i class="ri-star-fill text-yellow-400"></i>
          <?php } ?>
        </div>
        <p class="text-gray-700 mb-6">"<?php echo __('testimonial2_text'); ?>"</p>
        <div class="flex items-center">
          <div class="ml-4">
            <p class="font-bold"><?php echo __('testimonial2_name'); ?></p>
            <p class="text-gray-600 text-sm"><?php echo __('testimonial2_position'); ?></p>
          </div>
        </div>
      </div>
      
      <!-- Testimonial 3 -->
      <div class="bg-white p-8 rounded-2xl shadow-md">
        <div class="flex items-center mb-4">
          <?php for($i=0; $i<5; $i++) { ?>
            <i class="ri-star-fill text-yellow-400"></i>
          <?php } ?>
        </div>
        <p class="text-gray-700 mb-6">"<?php echo __('testimonial3_text'); ?>"</p>
        <div class="flex items-center">
          <div class="ml-4">
            <p class="font-bold"><?php echo __('testimonial3_name'); ?></p>
            <p class="text-gray-600 text-sm"><?php echo __('testimonial3_position'); ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="bg-gray-100 py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12"><?php echo __('pricing_title'); ?></h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Light Plan -->
      <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
        <h3 class="text-2xl font-bold mb-2"><?php echo __('light_plan'); ?></h3>
        <p class="text-gray-600 mb-6"><?php echo __('light_plan_subtitle'); ?></p>
        <div class="text-4xl font-bold mb-6">€15<span class="text-lg font-normal text-gray-600">/<?php echo __('month'); ?></span></div>
        <ul class="mb-8 space-y-3">
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('light_feature1'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('light_feature2'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('light_feature3'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('light_feature4'); ?></span>
          </li>
        </ul>
        <a href="#contact" class="block w-full bg-gray-200 text-gray-800 text-center font-semibold py-3 rounded-full hover:bg-gray-300"><?php echo __('request_demo_button'); ?></a>
      </div>
      
      <!-- Standard Plan -->
      <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition border-2 border-pink-500 relative">
        <div class="absolute top-0 left-0 w-full">
          <div class="bg-pink-500 text-white text-center py-1 text-sm font-semibold"><?php echo __('most_popular'); ?></div>
        </div>
        <h3 class="text-2xl font-bold mb-2 mt-4"><?php echo __('standard_plan'); ?></h3>
        <p class="text-gray-600 mb-6"><?php echo __('standard_plan_subtitle'); ?></p>
        <div class="text-4xl font-bold mb-6">€35<span class="text-lg font-normal text-gray-600">/<?php echo __('month'); ?></span></div>
        <ul class="mb-8 space-y-3">
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('standard_feature1'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('standard_feature2'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('standard_feature3'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('standard_feature4'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('standard_feature5'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('standard_feature6'); ?></span>
          </li>
        </ul>
        <a href="#contact" class="block w-full bg-pink-500 text-white text-center font-semibold py-3 rounded-full hover:bg-pink-600"><?php echo __('request_demo_button'); ?></a>
      </div>
      
      <!-- News Portal Plan -->
      <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
        <h3 class="text-2xl font-bold mb-2"><?php echo __('news_plan'); ?></h3>
        <p class="text-gray-600 mb-6"><?php echo __('news_plan_subtitle'); ?></p>
        <div class="text-4xl font-bold mb-6">€50<span class="text-lg font-normal text-gray-600">/<?php echo __('month'); ?></span></div>
        <ul class="mb-8 space-y-3">
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('news_feature1'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('news_feature2'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('news_feature3'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('news_feature4'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('news_feature5'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('news_feature6'); ?></span>
          </li>
          <li class="flex items-start">
            <i class="ri-check-line text-green-500 mr-2 mt-1"></i>
            <span><?php echo __('news_feature7'); ?></span>
          </li>
        </ul>
        <a href="#contact" class="block w-full bg-gray-200 text-gray-800 text-center font-semibold py-3 rounded-full hover:bg-gray-300"><?php echo __('request_demo_button'); ?></a>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="bg-white py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12"><?php echo __('faq_title'); ?></h2>
    
    <div class="max-w-3xl mx-auto" x-data="{ active: null }">
      <!-- FAQ Item 1 -->
      <div class="mb-4 border border-gray-200 rounded-lg">
        <button @click="active !== 'faq1' ? active = 'faq1' : active = null" class="flex justify-between items-center w-full p-5 font-medium text-left">
          <span><?php echo __('faq1_question'); ?></span>
          <i x-show="active !== 'faq1'" class="ri-arrow-down-s-line"></i>
          <i x-show="active === 'faq1'" class="ri-arrow-up-s-line"></i>
        </button>
        <div x-show="active === 'faq1'" class="p-5 border-t border-gray-200">
          <p class="text-gray-600"><?php echo __('faq1_answer'); ?></p>
        </div>
      </div>
      
      <!-- FAQ Item 2 -->
      <div class="mb-4 border border-gray-200 rounded-lg">
        <button @click="active !== 'faq2' ? active = 'faq2' : active = null" class="flex justify-between items-center w-full p-5 font-medium text-left">
          <span><?php echo __('faq2_question'); ?></span>
          <i x-show="active !== 'faq2'" class="ri-arrow-down-s-line"></i>
          <i x-show="active === 'faq2'" class="ri-arrow-up-s-line"></i>
        </button>
        <div x-show="active === 'faq2'" class="p-5 border-t border-gray-200">
          <p class="text-gray-600"><?php echo __('faq2_answer'); ?></p>
        </div>
      </div>
      
      <!-- FAQ Item 3 -->
      <div class="mb-4 border border-gray-200 rounded-lg">
        <button @click="active !== 'faq3' ? active = 'faq3' : active = null" class="flex justify-between items-center w-full p-5 font-medium text-left">
          <span><?php echo __('faq3_question'); ?></span>
          <i x-show="active !== 'faq3'" class="ri-arrow-down-s-line"></i>
          <i x-show="active === 'faq3'" class="ri-arrow-up-s-line"></i>
        </button>
        <div x-show="active === 'faq3'" class="p-5 border-t border-gray-200">
          <p class="text-gray-600"><?php echo __('faq3_answer'); ?></p>
        </div>
      </div>
      
      <!-- FAQ Item 4 -->
      <div class="mb-4 border border-gray-200 rounded-lg">
        <button @click="active !== 'faq4' ? active = 'faq4' : active = null" class="flex justify-between items-center w-full p-5 font-medium text-left">
          <span><?php echo __('faq4_question'); ?></span>
          <i x-show="active !== 'faq4'" class="ri-arrow-down-s-line"></i>
          <i x-show="active === 'faq4'" class="ri-arrow-up-s-line"></i>
        </button>
        <div x-show="active === 'faq4'" class="p-5 border-t border-gray-200">
          <p class="text-gray-600"><?php echo __('faq4_answer'); ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Contact/Demo Section -->
<section id="contact" class="bg-gradient-to-r from-pink-500 to-teal-400 text-white py-16">
  <div class="container mx-auto px-6 text-center fade-in">
    <h2 class="text-3xl md:text-4xl font-bold mb-6"><?php echo __('demo_title'); ?></h2>
    <p class="text-lg mb-8 max-w-2xl mx-auto">
      <?php echo __('demo_subtitle'); ?>
    </p>
    <form class="max-w-md mx-auto">
      <div class="mb-4">
        <input type="email" placeholder="<?php echo __('your_email'); ?>" class="w-full px-4 py-3 rounded-full text-gray-800 focus:outline-none">
      </div>
      <button type="submit" class="btn-primary bg-white text-pink-600 font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 w-full"><?php echo __('ask_for_demo'); ?></button>
    </form>
    <p class="text-sm mt-4"><?php echo __('demo_note'); ?></p>
  </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-8">
  <div class="container mx-auto px-6 text-center">
    <p class="mb-2"> 2025 MindBeamer.io, <?php echo __('created_by'); ?> <a href="#" class="text-teal-400 hover:underline">Martin Schenk</a>. <?php echo __('all_rights_reserved'); ?></p>
    <div class="flex justify-center space-x-4 mt-4">
      <div class="flex items-center space-x-2">
        <a href="<?php echo getLocaleUrl('en'); ?>" class="text-gray-400 hover:text-white <?php echo isCurrentLocale('en') ? 'font-bold text-white' : ''; ?>">EN</a>
        <span class="text-gray-500">|</span>
        <a href="<?php echo getLocaleUrl('de'); ?>" class="text-gray-400 hover:text-white <?php echo isCurrentLocale('de') ? 'font-bold text-white' : ''; ?>">DE</a>
      </div>
    </div>
  </div>
</footer>

<script>
// Formular-Validierung und Feedback
document.getElementById('demo-form').addEventListener('submit', async function (e) {
    e.preventDefault();
    const form = this;
    const formData = new FormData(form);
    
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        
        if (result.success) {
            alert('Thanks for your request! Martin will reach out soon to set up your demo.');
            form.reset();
        } else {
            alert('Something went wrong. Please try again or email ms@martin-schenk.es directly.');
        }
    } catch (error) {
        alert('Error sending request. Please try again or email ms@martin-schenk.es.');
    }
});
</script>

</body>
</html>