<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Email Translations (English)
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for email templates.
    |
    */

    // Demo Request Confirmation
    'demo_confirmation_title' => 'Demo Request Confirmation',
    'demo_confirmation_subject' => 'Your Demo Request for MindBeamer.io',
    'demo_received_title' => 'Demo Request Received!',
    'greeting' => 'Hello!',
    'thank_you_message' => 'Thank you for your interest in MindBeamer.io! We have successfully received your demo request.',
    'what_next_title' => 'What\'s next?',
    'what_next_description' => 'I\'ll personally review your request and get back to you within 24 hours.',
    'schedule_demo_title' => 'Demo Call Options',
    'schedule_demo_description' => 'We\'ll schedule a 30-minute video call (Zoom/Google Meet) at a time that works best for your timezone.',
    'video_call_available' => 'Video calls available (Zoom/Google Meet)',
    'founder_ceo' => 'Founder & CEO, MindBeamer.io',
    'email_sent_reason' => 'This email was sent to <strong>:email</strong> because you requested a demo of MindBeamer.io.',
    
    // Admin Demo Request Email
    'admin_demo_title' => 'New Demo Request',
    'admin_demo_subject' => 'New Demo Request - :email',
    'admin_demo_received' => 'A new demo request has been submitted via the contact form on :domain:',
    'admin_email_label' => 'Email:',
    'admin_email_not_provided' => 'Not provided',
    'admin_language_label' => 'Website language:',
    'admin_contact_prompt' => 'Please contact the prospect promptly to schedule a personal demo.',
    'admin_email_footer' => 'This email was sent automatically by :domain.',
    
    // Development Environment
    'dev_environment_notice' => '<strong>DEVELOPMENT ENVIRONMENT:</strong> This email was sent from :url (:env). NOT PRODUCTION!',
    'environment_label' => ':env ENVIRONMENT',
];
