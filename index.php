<?php
// Session für CSRF-Token
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MindBeamer - Book Your Free Demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="MindBeamer: AI-powered content creation for freelancers and SMEs. Generate blog posts and social media content instantly. Book a free demo now!">
  <meta name="keywords" content="AI content creation, blog posts, social media, freelancers, SMEs, MindBeamer, free demo">
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
    <a href="#" class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-teal-400">MindBeamer</a>
    <nav class="hidden md:flex space-x-8">
      <a href="#how-it-works" class="text-gray-700 hover:text-pink-500 font-medium">How It Works</a>
      <a href="#features" class="text-gray-700 hover:text-pink-500 font-medium">Features</a>
      <a href="#why-choose-us" class="text-gray-700 hover:text-pink-500 font-medium">Why Us</a>
      <a href="#contact" class="text-gray-700 hover:text-pink-500 font-medium">Free Demo</a>
    </nav>
    <button @click="open = !open" class="md:hidden text-pink-500 focus:outline-none">
      <i class="ri-menu-line text-2xl"></i>
    </button>
  </div>
  <div x-show="open" @click.away="open = false" class="md:hidden bg-white shadow-lg">
    <nav class="px-6 py-4 space-y-4">
      <a href="#how-it-works" class="block text-pink-500 hover:text-teal-400 font-medium">How It Works</a>
      <a href="#features" class="block text-pink-500 hover:text-teal-400 font-medium">Features</a>
      <a href="#why-choose-us" class="block text-pink-500 hover:text-teal-400 font-medium">Why Us</a>
      <a href="#contact" class="block text-pink-500 hover:text-teal-400 font-medium">Free Demo</a>
    </nav>
  </div>
</header>

<!-- Hero Section -->
<section class="hero-bg text-white pt-24 pb-16">
  <div class="container mx-auto px-6 text-center fade-in">
    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">Grow Your Brand with Zero Hassle</h1>
    <p class="text-lg md:text-2xl mb-8 max-w-3xl mx-auto">
      MindBeamer creates stunning blog posts and social media content for freelancers and SMEs – from one idea, in seconds. Book a free demo with Martin Schenk to see the magic!
    </p>
    <a href="#contact" class="btn-primary inline-block bg-white text-pink-600 font-semibold text-lg py-3 px-8 rounded-full shadow-lg hover:bg-gray-100">Ask for a Free Demo</a>
  </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="bg-gray-100 py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12">Your Content, Ready in 3 Steps</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="text-center">
        <i class="ri-lightbulb-flash-fill text-5xl text-pink-500 mb-4 block mx-auto"></i>
        <h3 class="text-xl font-semibold mb-3">1. Share Your Idea</h3>
        <p class="text-gray-600">Type a quick idea or topic – as simple as you want.</p>
      </div>
      <div class="text-center">
        <i class="ri-magic-fill text-5xl text-teal-400 mb-4 block mx-auto"></i>
        <h3 class="text-xl font-semibold mb-3">2. AI Does the Work</h3>
        <p class="text-gray-600">MindBeamer creates blog posts and social content, tailored for every platform.</p>
      </div>
      <div class="text-center">
        <i class="ri-rocket-fill text-5xl text-pink-500 mb-4 block mx-auto"></i>
        <h3 class="text-xl font-semibold mb-3">3. Go Live</h3>
        <p class="text-gray-600">Your content is posted across platforms, instantly engaging your audience.</p>
      </div>
    </div>
    <div class="text-center mt-12">
      <a href="#contact" class="btn-primary inline-block bg-pink-500 text-white font-semibold text-lg py-3 px-8 rounded-full shadow-lg hover:bg-pink-600">Ask for a Free Demo</a>
    </div>
  </section>

<!-- Features Section -->
<section id="features" class="container mx-auto px-6 py-16">
  <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12">Why You’ll Love MindBeamer</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 fade-in">
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <i class="ri-quill-pen-fill text-4xl text-pink-500 mb-4 block text-center"></i>
      <h3 class="text-xl font-semibold mb-3 text-center">Instant Content Magic</h3>
      <p class="text-gray-600 text-center">Turn any idea into polished blog posts and social content in seconds – no skills needed.</p>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <i class="ri-global-line text-4xl text-teal-400 mb-4 block text-center"></i>
      <h3 class="text-xl font-semibold mb-3 text-center">Tailored for Every Platform</h3>
      <p class="text-gray-600 text-center">Get content that shines on Instagram, LinkedIn, WordPress, and more, built to grab attention.</p>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <i class="ri-paint-brush-fill text-4xl text-pink-500 mb-4 block text-center"></i>
      <h3 class="text-xl font-semibold mb-3 text-center">Your Unique Style</h3>
      <p class="text-gray-600 text-center">Make content match your brand’s vibe with custom visuals and tone, effortlessly.</p>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <i class="ri-send-plane-fill text-4xl text-teal-400 mb-4 block text-center"></i>
      <h3 class="text-xl font-semibold mb-3 text-center">Auto-Post Everywhere</h3>
      <p class="text-gray-600 text-center">MindBeamer posts your content across all platforms, saving you hours.</p>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <i class="ri-calendar-check-fill text-4xl text-pink-500 mb-4 block text-center"></i>
      <h3 class="text-xl font-semibold mb-3 text-center">Manage with Ease</h3>
      <p class="text-gray-600 text-center">Plan and organize your content in one simple dashboard, stress-free.</p>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <i class="ri-star-smile-fill text-4xl text-teal-400 mb-4 block text-center"></i>
      <h3 class="text-xl font-semibold mb-3 text-center">Crazy Simple to Use</h3>
      <p class="text-gray-600 text-center">Built for everyone – no tech know-how needed to create awesome content.</p>
    </div>
  </div>
</section>

<!-- Why Choose Us Section -->
<section id="why-choose-us" class="bg-gray-100 py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12">Why MindBeamer Stands Out</h2>
    <p class="text-lg text-center mb-12 max-w-3xl mx-auto">
      You’ve got options for AI content tools, but MindBeamer is built with freelancers and SMEs in mind. Here’s how we shine compared to others.
    </p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white p-8 rounded-2xl shadow-lg">
        <h3 class="text-xl font-semibold mb-3 text-center">vs. Jasper AI</h3>
        <p class="text-gray-600 text-center">Jasper’s great for long-form content, but it’s pricy and complex. MindBeamer is simpler, auto-posts across platforms, and fits your budget.</p>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow-lg">
        <h3 class="text-xl font-semibold mb-3 text-center">vs. Hootsuite</h3>
        <p class="text-gray-600 text-center">Hootsuite schedules posts, but you still create the content. MindBeamer generates and posts it all, saving you time.</p>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow-lg">
        <h3 class="text-xl font-semibold mb-3 text-center">vs. Buffer</h3>
        <p class="text-gray-600 text-center">Buffer’s for posting, not creating. MindBeamer handles both, with AI tailored to your brand’s vibe.</p>
      </div>
    </div>
    <div class="text-center mt-12">
      <p class="text-lg font-semibold mb-4">Ready to see why MindBeamer’s the best choice for you?</p>
      <a href="#contact" class="btn-primary inline-block bg-pink-500 text-white font-semibold text-lg py-3 px-8 rounded-full shadow-lg hover:bg-pink-600">Ask for a Free Demo</a>
    </div>
  </section>

<!-- Contact/Demo Section -->
<section id="contact" class="bg-gradient-to-r from-pink-500 to-teal-400 text-white py-16">
  <div class="container mx-auto px-6 text-center fade-in">
    <h2 class="text-3xl md:text-4xl font-bold mb-6">Book Your Free MindBeamer Demo</h2>
    <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">
      Join freelancers and SMEs saving hours with MindBeamer. Enter your email, and Martin Schenk will show you how it works in a personal video call – built by a developer with 20+ years of experience!
    </p>
    <form id="demo-form" class="max-w-md mx-auto" action="sendmail.php" method="POST">
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
      <div class="flex flex-col md:flex-row gap-4">
        <input type="email" name="email" placeholder="Your Email" class="flex-1 px-4 py-3 rounded-full text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-400" required>
        <button type="submit" class="btn-primary bg-white text-pink-600 font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100">Ask for a Free Demo</button>
      </div>
    </form>
    <p class="mt-6 text-sm">You’ll hear from Martin soon to set up your personal demo.</p>
  </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-300 py-8">
  <div class="container mx-auto px-6 text-center">
    <p>© 2025 MindBeamer.io, created by <a href="https://martin-schenk.es" class="text-teal-400 hover:underline">Martin Schenk</a>. All rights reserved.</p>
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