<!-- Footer -->
<footer class="bg-gray-900 text-white py-8">
    <div class="container mx-auto px-6 text-center">
        <p class="mb-2">© 2025 MindBeamer.io, <?php echo e(__('messages.created_by')); ?> <a href="#" class="text-teal-400 hover:underline">Martin Schenk</a>. <?php echo e(__('messages.all_rights_reserved')); ?></p>
        <div class="flex justify-center space-x-4 mt-4">
            <div class="flex items-center space-x-2">
                <a href="<?php echo e(route('language.switch', ['locale' => 'en'])); ?>" class="text-gray-400 hover:text-white <?php echo e(app()->getLocale() == 'en' ? 'font-bold text-white' : ''); ?>">EN</a>
                <span class="text-gray-500">|</span>
                <a href="<?php echo e(route('language.switch', ['locale' => 'de'])); ?>" class="text-gray-400 hover:text-white <?php echo e(app()->getLocale() == 'de' ? 'font-bold text-white' : ''); ?>">DE</a>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /Users/martin/Laravel-Projekte/mindbeamer.io.landing/resources/views/components/footer.blade.php ENDPATH**/ ?>