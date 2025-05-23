<?php
// This is the main layout template
?>
<!DOCTYPE html>
<html lang="<?php echo $htmlLang; ?>">
<head>
  <meta charset="UTF-8">
  <title>MindBeamer - <?php echo __('hero_title'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo __('hero_subtitle'); ?>">
  <meta name="keywords" content="autonomous AI content, automated blog posts, autonomous social media, automated content creation, MindBeamer, free demo">
  <!-- Vite Assets for CSS and JS -->
  <?php echo app('\Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
  <!-- Alpine.js -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <!-- Remix Icon -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
    .hero-bg { background: linear-gradient(135deg, #EC4899, #9F7AEA, #4ECDC4); }
    .btn-primary { transition: transform 0.2s, background-color 0.3s; }
    .btn-primary:hover { transform: scale(1.05); }
    /* Section title styling moved to app.css */
    .fade-in { animation: fadeIn 1s ease-in; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
  </style>
  <link rel="canonical" href="https://mindbeamer.io">
</head>
<body class="bg-gray-50 text-gray-900">

<?php include __DIR__ . '/../partials/header.php'; ?>

<?php echo $content; ?>

<?php include __DIR__ . '/../partials/footer.php'; ?>

<script>
// Formular-Validierung und Feedback
document.addEventListener('DOMContentLoaded', function() {
  const demoForm = document.getElementById('demo-form');
  if (demoForm) {
    demoForm.addEventListener('submit', async function (e) {
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
              // Erfolgsmeldung anzeigen
              form.innerHTML = '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert"><p>Thank you! We\'ll be in touch soon.</p></div>';
          } else {
              // Fehlermeldung anzeigen
              const errorDiv = document.createElement('div');
              errorDiv.className = 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mt-4';
              errorDiv.innerHTML = `<p>${result.message || 'Something went wrong. Please try again.'}</p>`;
              form.appendChild(errorDiv);
          }
      } catch (error) {
          console.error('Error:', error);
          // Netzwerkfehler oder andere Ausnahmen
          const errorDiv = document.createElement('div');
          errorDiv.className = 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mt-4';
          errorDiv.innerHTML = '<p>Network error. Please check your connection and try again.</p>';
          form.appendChild(errorDiv);
      }
    });
  }
});
</script>
</body>
</html>
