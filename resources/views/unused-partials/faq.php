<!-- FAQ Section -->
<section id="faq" class="bg-white py-16">
  <div class="container mx-auto px-6 fade-in">
    <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-6 bg-gradient-to-r from-pink-500 via-purple-400 to-teal-400 text-transparent bg-clip-text"><?php echo __('faq_title'); ?></h2>
    
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
