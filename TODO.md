# Convert Preview Templates to Server-Side Rendering

## Overview

Convert all preview blade templates to use server-side rendering like `preview-romantic-blossom.blade.php`, replacing client-side JavaScript data injection with Blade/PHP rendering.

## Templates to Convert

-   [ ] preview-bamboo.blade.php
-   [ ] preview-biru-pucet.blade.php
-   [ ] preview-blue-atmosphere.blade.php
-   [ ] preview-blue-coral.blade.php
-   [ ] preview-blue-sky.blade.php
-   [ ] preview-classic-elegant.blade.php
-   [ ] preview-green-forest.blade.php

## Conversion Steps for Each Template

1. Update data structure to use `$invitation` object instead of `$data` array
2. Replace JavaScript data population with Blade server-side rendering
3. Add proper Laravel form handling for RSVP with CSRF protection
4. Use Blade conditionals for package features
5. Use Laravel asset helpers for images and audio
6. Add proper date formatting with Carbon
7. Remove unnecessary JavaScript data injection code
8. Test the converted template

## Key Changes Required

-   Change `$data = [...]` to `$invitation = (object) $data`
-   Replace `document.getElementById().innerHTML` with Blade loops
-   Add `@csrf` to forms
-   Use `{{ asset('storage/' . $invitation->image_path) }}` for images
-   Use `@if($invitation->package->has_feature)` for conditional sections
-   Use `@foreach($invitation->items as $item)` for dynamic content
-   Add proper form action with `{{ route('guestbook.store', $invitation) }}`

## Testing

-   Verify all sections render correctly
-   Test RSVP form submission
-   Check responsive design
-   Ensure animations still work
-   Test gallery modal functionality
