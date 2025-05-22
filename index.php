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
  <title>MindBeamer - Your Autonomous AI Content Agent</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="MindBeamer: Fully autonomous AI-powered content creation and publishing for blogs and social media. Set it up once and it works entirely on its own. Book a free demo now!">
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
    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">Your Fully Autonomous AI Content Agent</h1>
    <p class="text-lg md:text-2xl mb-8 max-w-3xl mx-auto">
      MindBeamer autonomously creates and publishes stunning blog posts and social media content – configure once, and it works entirely on its own. Book a free demo with Martin Schenk to see the magic!
    </p>
    <a href="#contact" class="btn-primary inline-block bg-white text-pink-600 font-semibold text-lg py-3 px-8 rounded-full shadow-lg hover:bg-gray-100">Ask for a Free Demo</a>
  </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="bg-gray-100 py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12">Autonomous Content in 5 Steps</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="text-center">
        <i class="ri-settings-4-fill text-5xl text-pink-500 mb-4 block mx-auto"></i>
        <h3 class="text-xl font-semibold mb-3">1. One-Time Setup</h3>
        <p class="text-gray-600">Configure your brand, tone, topics and platforms just once.</p>
      </div>
      <div class="text-center">
        <i class="ri-lightbulb-flash-fill text-5xl text-teal-400 mb-4 block mx-auto"></i>
        <h3 class="text-xl font-semibold mb-3">2. AI Finds Topics</h3>
        <p class="text-gray-600">MindBeamer autonomously researches and selects engaging topics.</p>
      </div>
      <div class="text-center">
        <i class="ri-magic-fill text-5xl text-pink-500 mb-4 block mx-auto"></i>
        <h3 class="text-xl font-semibold mb-3">3. Content Creation</h3>
        <p class="text-gray-600">Creates platform-specific content and media automatically.</p>
      </div>
      <div class="text-center">
        <i class="ri-edit-2-fill text-5xl text-teal-400 mb-4 block mx-auto"></i>
        <h3 class="text-xl font-semibold mb-3">4. Optional Review</h3>
        <p class="text-gray-600">Approve content or let it publish automatically – your choice.</p>
      </div>
      <div class="text-center">
        <i class="ri-rocket-fill text-5xl text-pink-500 mb-4 block mx-auto"></i>
        <h3 class="text-xl font-semibold mb-3">5. Auto Publishing</h3>
        <p class="text-gray-600">Content automatically posted across all platforms, continuously.</p>
      </div>
    </div>
    <div class="text-center mt-12">
      <a href="#contact" class="btn-primary inline-block bg-pink-500 text-white font-semibold text-lg py-3 px-8 rounded-full shadow-lg hover:bg-pink-600">Ask for a Free Demo</a>
    </div>
  </section>

<!-- Features Section -->
<section id="features" class="container mx-auto px-6 py-16">
  <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12">Why You'll Love MindBeamer</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 fade-in">
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <i class="ri-robot-fill text-4xl text-pink-500 mb-4 block text-center"></i>
      <h3 class="text-xl font-semibold mb-3 text-center">100% Self-Operating</h3>
      <p class="text-gray-600 text-center">MindBeamer thinks, plans and acts independently – topic research, content creation, and publishing without your intervention.</p>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <i class="ri-global-line text-4xl text-teal-400 mb-4 block text-center"></i>
      <h3 class="text-xl font-semibold mb-3 text-center">Tailored for Every Platform</h3>
      <p class="text-gray-600 text-center">Professional content for LinkedIn, visual stories for Instagram, engaging posts for Facebook, comprehensive articles for WordPress – automatically.</p>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <i class="ri-image-fill text-4xl text-pink-500 mb-4 block text-center"></i>
      <h3 class="text-xl font-semibold mb-3 text-center">Autonomous Media Creation</h3>
      <p class="text-gray-600 text-center">Automatically creates images, infographics, sliders, comics and more – tailored to each platform and audience.</p>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <i class="ri-send-plane-fill text-4xl text-teal-400 mb-4 block text-center"></i>
      <h3 class="text-xl font-semibold mb-3 text-center">Continuous Publishing</h3>
      <p class="text-gray-600 text-center">MindBeamer posts your content across all platforms on a regular schedule, with zero input needed.</p>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <i class="ri-shield-check-fill text-4xl text-pink-500 mb-4 block text-center"></i>
      <h3 class="text-xl font-semibold mb-3 text-center">You Maintain Control</h3>
      <p class="text-gray-600 text-center">Let it work completely autonomously or review content before publishing – your choice.</p>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <i class="ri-store-3-fill text-4xl text-teal-400 mb-4 block text-center"></i>
      <h3 class="text-xl font-semibold mb-3 text-center">Works for Any Business</h3>
      <p class="text-gray-600 text-center">From hair salons to tech blogs to financial news portals – MindBeamer adapts to your specific industry automatically.</p>
    </div>
  </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="bg-gray-100 py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12">Simple, Transparent Pricing</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
        <div class="text-center">
          <h3 class="text-2xl font-bold mb-2">Light</h3>
          <p class="text-gray-600 mb-4">For small businesses or beginners</p>
          <div class="text-4xl font-bold text-pink-500 mb-6">€15<span class="text-lg text-gray-500">/month</span></div>
        </div>
        <ul class="space-y-3 mb-8">
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> Autonomous content creation</li>
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> Up to 10 posts per month</li>
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> 2 social platforms</li>
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> Basic media creation</li>
        </ul>
        <div class="text-center">
          <a href="#contact" class="btn-primary inline-block bg-gray-200 text-gray-800 font-semibold py-3 px-8 rounded-full shadow hover:bg-gray-300 w-full">Request Demo</a>
        </div>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform scale-105 z-10 border-2 border-pink-500">
        <div class="text-center">
          <div class="inline-block bg-pink-500 text-white text-sm font-semibold py-1 px-4 rounded-full mb-4">Most Popular</div>
          <h3 class="text-2xl font-bold mb-2">Standard</h3>
          <p class="text-gray-600 mb-4">For growing businesses</p>
          <div class="text-4xl font-bold text-pink-500 mb-6">€35<span class="text-lg text-gray-500">/month</span></div>
        </div>
        <ul class="space-y-3 mb-8">
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> Fully autonomous content</li>
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> Up to 30 posts per month</li>
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> 4 social platforms + blog</li>
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> Advanced media creation</li>
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> Platform-specific optimization</li>
        </ul>
        <div class="text-center">
          <a href="#contact" class="btn-primary inline-block bg-pink-500 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-pink-600 w-full">Request Demo</a>
        </div>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
        <div class="text-center">
          <h3 class="text-2xl font-bold mb-2">News Portal</h3>
          <p class="text-gray-600 mb-4">For high-volume publishers</p>
          <div class="text-4xl font-bold text-pink-500 mb-6">€50<span class="text-lg text-gray-500">/month</span></div>
        </div>
        <ul class="space-y-3 mb-8">
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> Fully autonomous content</li>
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> Daily posts & updates</li>
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> All social platforms + blog</li>
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> Premium media creation</li>
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> Topic research automation</li>
          <li class="flex items-center"><i class="ri-check-line text-teal-400 mr-2"></i> News & trend monitoring</li>
        </ul>
        <div class="text-center">
          <a href="#contact" class="btn-primary inline-block bg-gray-200 text-gray-800 font-semibold py-3 px-8 rounded-full shadow hover:bg-gray-300 w-full">Request Demo</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Why Choose Us Section -->
<section id="why-choose-us" class="bg-white py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12">Why MindBeamer Stands Out</h2>
    <p class="text-lg text-center mb-12 max-w-3xl mx-auto">
      You've got options for AI content tools, but MindBeamer is the only fully autonomous agent that handles everything from topic selection to publishing – with zero input required.
    </p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-gray-100 p-8 rounded-2xl shadow-lg">
        <h3 class="text-xl font-semibold mb-3 text-center">vs. Jasper AI</h3>
        <p class="text-gray-600 text-center">While Jasper requires you to manually create and distribute content, MindBeamer operates fully autonomously, generating and posting content across all platforms without your intervention.</p>
      </div>
      <div class="bg-gray-100 p-8 rounded-2xl shadow-lg">
        <h3 class="text-xl font-semibold mb-3 text-center">vs. Buffer/Hootsuite</h3>
        <p class="text-gray-600 text-center">Unlike scheduling tools that only publish content you've already created, MindBeamer autonomously generates, optimizes, and posts content – eliminating the entire content creation workflow.</p>
      </div>
      <div class="bg-gray-100 p-8 rounded-2xl shadow-lg">
        <h3 class="text-xl font-semibold mb-3 text-center">vs. ContentStudio</h3>
        <p class="text-gray-600 text-center">ContentStudio requires ongoing oversight and direction. MindBeamer operates completely independently after initial setup, generating topics and content tailored for each platform automatically.</p>
      </div>
    </div>
    <div class="text-center mt-12">
      <p class="text-lg font-semibold mb-4">Ready to see how MindBeamer's autonomous content agent can transform your online presence?</p>
      <a href="#contact" class="btn-primary inline-block bg-pink-500 text-white font-semibold text-lg py-3 px-8 rounded-full shadow-lg hover:bg-pink-600">Ask for a Free Demo</a>
    </div>
  </section>

<!-- Testimonial Section -->
<section id="testimonials" class="bg-gray-100 py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12">What Our Users Say</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white p-8 rounded-2xl shadow-lg">
        <div class="flex items-center mb-4">
          <div class="text-yellow-400 flex">
            <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>
          </div>
        </div>
        <p class="text-gray-600 mb-6">"Since implementing MindBeamer, our content production has tripled with zero additional resources. The agent handles everything completely independently – truly set and forget!"</p>
        <div class="font-semibold">Alex Johnson</div>
        <div class="text-sm text-gray-500">Marketing Director</div>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow-lg">
        <div class="flex items-center mb-4">
          <div class="text-yellow-400 flex">
            <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>
          </div>
        </div>
        <p class="text-gray-600 mb-6">"I run a small hair salon and have no time for social media. MindBeamer creates and posts content that's perfect for my business – I don't have to do anything after setup!"</p>
        <div class="font-semibold">Sarah Miller</div>
        <div class="text-sm text-gray-500">Small Business Owner</div>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow-lg">
        <div class="flex items-center mb-4">
          <div class="text-yellow-400 flex">
            <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>
          </div>
        </div>
        <p class="text-gray-600 mb-6">"Our tech blog gets daily updates across all platforms now, with perfectly formatted LinkedIn posts, engaging Twitter threads, and comprehensive blog articles – all on autopilot."</p>
        <div class="font-semibold">David Chen</div>
        <div class="text-sm text-gray-500">Tech Publication Editor</div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="container mx-auto px-6 py-16">
  <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12">Frequently Asked Questions</h2>
  <div class="max-w-3xl mx-auto space-y-6" x-data="{selected:null}">
    <div class="bg-white rounded-2xl shadow-lg">
      <button @click="selected !== 1 ? selected = 1 : selected = null" class="flex justify-between items-center w-full p-6 focus:outline-none">
        <span class="font-semibold text-left">How autonomously does MindBeamer really work?</span>
        <i class="ri-arrow-down-s-line text-2xl" x-bind:class="selected == 1 ? 'transform rotate-180' : ''"></i>
      </button>
      <div x-show="selected == 1" class="px-6 pb-6">
        <p class="text-gray-600">After initial configuration, MindBeamer works 100% autonomously. It researches topics, creates content tailored for each platform, generates relevant media, and publishes everything on an optimal schedule – all without any human intervention required.</p>
      </div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg">
      <button @click="selected !== 2 ? selected = 2 : selected = null" class="flex justify-between items-center w-full p-6 focus:outline-none">
        <span class="font-semibold text-left">Do I need to review the generated content?</span>
        <i class="ri-arrow-down-s-line text-2xl" x-bind:class="selected == 2 ? 'transform rotate-180' : ''"></i>
      </button>
      <div x-show="selected == 2" class="px-6 pb-6">
        <p class="text-gray-600">It's entirely your choice. MindBeamer can operate completely autonomously, publishing content without your review. Alternatively, you can enable the review option to approve content before it goes live. Many users start with reviews, then switch to full autonomy once they're comfortable with the quality.</p>
      </div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg">
      <button @click="selected !== 3 ? selected = 3 : selected = null" class="flex justify-between items-center w-full p-6 focus:outline-none">
        <span class="font-semibold text-left">How does MindBeamer adapt content for different platforms?</span>
        <i class="ri-arrow-down-s-line text-2xl" x-bind:class="selected == 3 ? 'transform rotate-180' : ''"></i>
      </button>
      <div x-show="selected == 3" class="px-6 pb-6">
        <p class="text-gray-600">MindBeamer automatically recognizes the unique requirements of each platform. For LinkedIn, it creates longer, professional content with appropriate hashtags. For Instagram, it focuses on visual stories with concise captions. For WordPress blogs, it generates comprehensive articles with proper formatting. Each piece of content is specifically optimized for its destination platform.</p>
      </div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg">
      <button @click="selected !== 4 ? selected = 4 : selected = null" class="flex justify-between items-center w-full p-6 focus:outline-none">
        <span class="font-semibold text-left">Can I use MindBeamer for any business niche?</span>
        <i class="ri-arrow-down-s-line text-2xl" x-bind:class="selected == 4 ? 'transform rotate-180' : ''"></i>
      </button>
      <div x-show="selected == 4" class="px-6 pb-6">
        <p class="text-gray-600">Absolutely! MindBeamer works for any business type or industry. Whether you run a local hair salon, a tech startup blog, or a financial news portal, MindBeamer adapts to your specific niche, researching relevant topics and creating appropriate content for your unique audience.</p>
      </div>
    </div>
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
    <p> 2025 MindBeamer.io, created by <a href="https://martin-schenk.es" class="text-teal-400 hover:underline">Martin Schenk</a>. All rights reserved.</p>
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