<!-- Testimonials Section -->
<section id="testimonials" class="bg-gray-100 py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-6 bg-gradient-to-r from-pink-500 via-purple-400 to-teal-400 text-transparent bg-clip-text"><?php echo __('testimonials_title'); ?></h2>
    
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
