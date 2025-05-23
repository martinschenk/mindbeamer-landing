<!-- Contact/Demo Section -->
<section id="contact" class="bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 text-white py-16">
  <div class="container mx-auto px-6 text-center fade-in">
    <h2 class="text-3xl md:text-4xl font-bold mb-6"><?php echo __('demo_title'); ?></h2>
    <p class="text-lg mb-8 max-w-2xl mx-auto">
      <?php echo __('demo_subtitle'); ?>
    </p>
    <form id="demo-form" class="max-w-md mx-auto" action="process_demo.php" method="post">
      <div class="mb-4">
        <input type="email" name="email" placeholder="<?php echo __('your_email'); ?>" class="w-full px-4 py-3 rounded-full text-gray-800 focus:outline-none" required>
      </div>
      <button type="submit" class="btn-primary bg-white text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 w-full"><?php echo __('ask_for_demo'); ?></button>
    </form>
    <p class="text-sm mt-4"><?php echo __('demo_note'); ?></p>
  </div>
</section>
