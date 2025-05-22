<!-- Header -->
<header class="bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 shadow fixed top-0 w-full z-20" x-data="{ open: false }">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="#" class="text-3xl font-bold text-white">MindBeamer</a>
        <nav class="hidden md:flex space-x-8">
            <a href="#how-it-works" class="text-white hover:text-gray-200 font-medium"><?php echo e(__('messages.nav_how_it_works')); ?></a>
            <a href="#features" class="text-white hover:text-gray-200 font-medium"><?php echo e(__('messages.nav_features')); ?></a>
            <a href="#why-us" class="text-white hover:text-gray-200 font-medium"><?php echo e(__('messages.nav_why_us')); ?></a>
            <a href="#contact" class="text-white hover:text-gray-200 font-medium"><?php echo e(__('messages.nav_demo')); ?></a>
            <div class="flex items-center space-x-2">
                <a href="<?php echo e(route('language.switch', ['locale' => 'en'])); ?>" class="text-white hover:text-gray-200 font-medium <?php echo e(app()->getLocale() == 'en' ? 'font-bold underline' : ''); ?>">EN</a>
                <span class="text-white">|</span>
                <a href="<?php echo e(route('language.switch', ['locale' => 'de'])); ?>" class="text-white hover:text-gray-200 font-medium <?php echo e(app()->getLocale() == 'de' ? 'font-bold underline' : ''); ?>">DE</a>
            </div>
        </nav>
        <button class="md:hidden" @click="open = !open">
            <i class="ri-menu-line text-2xl text-white"></i>
        </button>
    </div>
    <!-- Mobile menu -->
    <div class="md:hidden" x-show="open" @click.away="open = false">
        <nav class="bg-white px-6 pb-4 space-y-4">
            <a href="#how-it-works" class="block text-gray-700 hover:text-pink-500 font-medium"><?php echo e(__('messages.nav_how_it_works')); ?></a>
            <a href="#features" class="block text-gray-700 hover:text-pink-500 font-medium"><?php echo e(__('messages.nav_features')); ?></a>
            <a href="#why-us" class="block text-gray-700 hover:text-pink-500 font-medium"><?php echo e(__('messages.nav_why_us')); ?></a>
            <a href="#contact" class="block text-gray-700 hover:text-pink-500 font-medium"><?php echo e(__('messages.nav_demo')); ?></a>
            <div class="flex items-center space-x-2 pt-2 border-t">
                <a href="<?php echo e(route('language.switch', ['locale' => 'en'])); ?>" class="text-gray-700 hover:text-pink-500 font-medium <?php echo e(app()->getLocale() == 'en' ? 'font-bold' : ''); ?>">EN</a>
                <span class="text-gray-500">|</span>
                <a href="<?php echo e(route('language.switch', ['locale' => 'de'])); ?>" class="text-gray-700 hover:text-pink-500 font-medium <?php echo e(app()->getLocale() == 'de' ? 'font-bold' : ''); ?>">DE</a>
            </div>
        </nav>
    </div>
</header>
<?php /**PATH /Users/martin/Laravel-Projekte/mindbeamer.io.landing/resources/views/components/header.blade.php ENDPATH**/ ?>