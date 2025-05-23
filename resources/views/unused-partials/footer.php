<!-- Footer -->
<footer class="bg-gray-900 text-white py-8">
  <div class="container mx-auto px-6 text-center">
    <p class="mb-2">© 2025 MindBeamer.io, <?php echo __('created_by'); ?> <a href="#" class="text-teal-400 hover:underline">Martin Schenk</a>. <?php echo __('all_rights_reserved'); ?></p>
    <div class="flex justify-center space-x-4 mt-4">
      <div class="flex items-center space-x-2">
        <a href="<?php echo getLocaleUrl('en'); ?>" class="text-gray-400 hover:text-white <?php echo isCurrentLocale('en') ? 'font-bold text-white' : ''; ?>">EN</a>
        <span class="text-gray-500">|</span>
        <a href="<?php echo getLocaleUrl('de'); ?>" class="text-gray-400 hover:text-white <?php echo isCurrentLocale('de') ? 'font-bold text-white' : ''; ?>">DE</a>
      </div>
    </div>
  </div>
</footer>
