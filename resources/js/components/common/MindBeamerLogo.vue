<template>
    <div :class="['mindbeamer-logo', sizeClass]">
        <svg :width="iconSize" :height="iconSize" viewBox="0 0 40 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="logo-icon">
            <g>
                <!-- Central source point -->
                <circle cx="5" cy="40" r="6" fill="currentColor" class="text-primary"/>

                <!-- Three clean expanding waves -->
                <path d="M5 25 A15 15 0 0 1 20 40 A15 15 0 0 1 5 55"
                      stroke="currentColor" stroke-width="3" fill="none" class="text-primary"/>
                <path d="M5 15 A25 25 0 0 1 30 40 A25 25 0 0 1 5 65"
                      stroke="currentColor" stroke-width="2" fill="none" class="text-primary" opacity="0.7"/>
                <path d="M5 5 A35 35 0 0 1 40 40 A35 35 0 0 1 5 75"
                      stroke="currentColor" stroke-width="2" fill="none" class="text-primary" opacity="0.4"/>
            </g>
        </svg>

        <h1 class="logo-text" translate="no">
            <span class="text-primary">Mind</span><span class="text-surface-900">Beamer</span>
        </h1>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    size: {
        type: String,
        default: 'lg',
        validator: (value) => ['sm', 'md', 'lg', 'xl'].includes(value)
    }
});

const sizeClass = computed(() => `size-${props.size}`);

const iconSize = computed(() => {
    const sizes = {
        sm: 36,
        md: 52,
        lg: 68,
        xl: 96
    };
    return sizes[props.size];
});
</script>

<style scoped>
/* MindBeamer Logo Styles */
.mindbeamer-logo {
    display: flex;
    align-items: center;
    gap: 4px; /* Reduced spacing */
}

.logo-icon {
    flex-shrink: 0;
    transition: opacity 0.3s ease;
}

.logo-icon:hover {
    opacity: 0.8;
}

.logo-text {
    font-size: 42px;
    font-weight: 300;
    letter-spacing: 0.05em;
    margin: 0;
    line-height: 1;
    transform: translateY(-2px); /* Optical alignment */
    font-family: 'Inter', sans-serif;
}

/* Size Variations */
.mindbeamer-logo.size-sm {
    gap: 3px;
}
.mindbeamer-logo.size-sm .logo-icon {
    width: 36px;
    height: 36px;
}
.mindbeamer-logo.size-sm .logo-text {
    font-size: 22px;
    transform: translateY(-1px);
}

.mindbeamer-logo.size-md {
    gap: 4px;
}
.mindbeamer-logo.size-md .logo-text {
    font-size: 32px;
    transform: translateY(-1px);
}

.mindbeamer-logo.size-lg {
    gap: 5px;
}
.mindbeamer-logo.size-lg .logo-text {
    font-size: 42px;
    transform: translateY(-2px);
}

.mindbeamer-logo.size-xl {
    gap: 6px;
}
.mindbeamer-logo.size-xl .logo-text {
    font-size: 58px;
    transform: translateY(-3px);
}

/* Responsive */
@media (max-width: 768px) {
    /* Make ALL sizes smaller on tablet/mobile */
    .mindbeamer-logo {
        gap: 3px;
    }

    /* Extra small for sm size on mobile */
    .mindbeamer-logo.size-sm .logo-icon {
        width: 32px;
        height: 32px;
    }
    .mindbeamer-logo.size-sm .logo-text {
        font-size: 20px;
        transform: translateY(-1px);
    }

    /* Small for md size on mobile */
    .mindbeamer-logo.size-md .logo-icon {
        width: 36px;
        height: 36px;
    }
    .mindbeamer-logo.size-md .logo-text {
        font-size: 22px;
        transform: translateY(-1px);
    }

    /* Override lg and xl to be like md */
    .mindbeamer-logo.size-lg .logo-icon,
    .mindbeamer-logo.size-xl .logo-icon {
        width: 40px;
        height: 40px;
    }
    .mindbeamer-logo.size-lg .logo-text,
    .mindbeamer-logo.size-xl .logo-text {
        font-size: 24px;
    }
}

@media (max-width: 480px) {
    /* Even smaller on phones */
    .mindbeamer-logo {
        gap: 2px;
    }

    /* Ultra small for sm size */
    .mindbeamer-logo.size-sm .logo-icon {
        width: 28px;
        height: 28px;
    }
    .mindbeamer-logo.size-sm .logo-text {
        font-size: 18px;
        transform: translateY(0);
    }

    /* Small for all other sizes */
    .mindbeamer-logo.size-md .logo-icon,
    .mindbeamer-logo.size-lg .logo-icon,
    .mindbeamer-logo.size-xl .logo-icon {
        width: 32px;
        height: 32px;
    }
    .mindbeamer-logo.size-md .logo-text,
    .mindbeamer-logo.size-lg .logo-text,
    .mindbeamer-logo.size-xl .logo-text {
        font-size: 20px;
    }
}

/* PrimeVue color fix - using theme primary color */
.text-primary {
    color: var(--p-primary-500);
}
</style>