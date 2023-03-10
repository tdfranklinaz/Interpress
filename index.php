<?php 
/**
 * Main template file
 */
get_template_part(
  'components/header',
  'header'
);
?>

<main id="primary">

  <div class="hero min-h-screen bg-base-200">
    <div class="hero-content text-center">
      <div class="max-w-md flex flex-wrap justify-center">

        <div class="flex items-center gap-4 mb-10">
          <span class="iconify text-primary text-[48px]" data-icon="ph:code-simple-duotone"></span>
          <span class="text-4xl font-medium">Interpress</span>
        </div>

        <h1 class="text-5xl font-medium leading-tight">Modern WordPress Boilerplate</h1>

        <p class="my-8 text-base">Built with Rollup, Tailwind, & AlpineJS. Run the following command to get started, or read the <a href="/docs" class="underline" target="_block">docs</a>.</p>

        <div class="mockup-code text-left border-2 border-primary shadow-xl">
          <pre data-prefix="$"><code>npm run dev</code></pre>
        </div>

      </div>
    </div>
  </div>

</main>

<?php
get_template_part(
  'components/footer',
  'footer'
);