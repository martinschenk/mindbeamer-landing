<script>
    // Dynamic header spacing adjustment
    document.addEventListener('DOMContentLoaded', function() {
        function adjustBodyPadding() {
            const header = document.querySelector('header');
            const languageBanner = document.getElementById('language-preference-banner');
            const body = document.body;
            
            let totalHeight = 0;
            
            // Calculate header height
            if (header) {
                totalHeight += header.offsetHeight;
            }
            
            // Add language banner height if visible
            if (languageBanner && languageBanner.style.display !== 'none') {
                totalHeight += languageBanner.offsetHeight;
                // Move header down
                if (header) {
                    header.style.top = languageBanner.offsetHeight + 'px';
                }
            } else {
                // Reset header position
                if (header) {
                    header.style.top = '0';
                }
            }
            
            // Apply padding to body
            body.style.paddingTop = totalHeight + 'px';
        }
        
        // Initial adjustment
        adjustBodyPadding();
        
        // Re-adjust on window resize
        window.addEventListener('resize', adjustBodyPadding);
        
        // Watch for banner dismissal - update selector to match new function signature
        const dismissButton = document.querySelector('button[onclick*="dismissLanguageBanner"]');
        if (dismissButton) {
            // Create a new click handler that calls adjustBodyPadding after dismissal
            const originalOnclick = dismissButton.onclick;
            dismissButton.onclick = function(event) {
                if (originalOnclick) {
                    originalOnclick.call(this, event);
                }
                setTimeout(adjustBodyPadding, 100);
            };
        }
    });
</script>

<style>
    /* Smooth transitions */
    body {
        transition: padding-top 0.3s ease;
    }
    
    header {
        transition: top 0.3s ease;
    }
</style>