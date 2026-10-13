<?php
/**
 * Template Name: Careers
 *
 * Moving of America careers page. Drop this file into the active theme folder,
 * then edit the Careers page and choose "Careers" under Page Attributes → Template.
 * The page's Featured Image (if set) becomes the hero background.
 *
 * Every color and font is a CSS variable at the top of the <style> block.
 */

$moa_hero_img = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'full' ) : '';

get_header();
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

<style>
  .moa-careers {
    /* Brand colors: Elementor Global Colors (falls back to the hex if Elementor isn't loaded) */
    --brand-primary: var(--e-global-color-primary, #23468C);     /* buttons, links, dark panels */
    --brand-primary-dark: #1a3569;
    --brand-secondary: var(--e-global-color-secondary, #126CD0); /* headings, highlights, Apply buttons */
    --brand-secondary-dark: #0d5aae;
    --brand-tint: var(--e-global-color-accent, #EFF9FF);         /* light section backgrounds, icon tiles */

    /* Neutrals */
    --ink: var(--e-global-color-text, #081C3A);
    --ink-muted: #4a5a75;
    --line: #d8e4f2;
    --surface: #ffffff;
    --surface-alt: var(--brand-tint);

    /* Fonts */
    --font-heading: "Montserrat", "Helvetica Neue", Arial, sans-serif;
    --font-body: "Open Sans", "Helvetica Neue", Arial, sans-serif;

    --radius: 10px;
    --wrap: 1080px;

    font-family: var(--font-body);
    font-size: 16px;
    line-height: 1.65;
    color: var(--ink);
    background: var(--surface);
    -webkit-font-smoothing: antialiased;
  }
  .moa-careers *, .moa-careers *::before, .moa-careers *::after { box-sizing: border-box; }
  .moa-careers a { color: var(--brand-primary); }
  .moa-careers h1, .moa-careers h2, .moa-careers h3 { font-family: var(--font-heading); line-height: 1.2; margin: 0; color: inherit; }
  .moa-careers p { margin: 0; }
  .moa-careers .wrap { width: 100%; max-width: var(--wrap); margin: 0 auto; padding: 0 24px; }
  .moa-careers .section { padding: 88px 0; }
  .moa-careers .eyebrow { display: inline-block; font-family: var(--font-heading); font-size: 12px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: var(--brand-secondary); margin-bottom: 10px; }
  .moa-careers .section-head { text-align: center; max-width: 640px; margin: 0 auto 44px; }
  .moa-careers .section-head h2 { font-size: clamp(1.7rem, 3.4vw, 2.2rem); font-weight: 800; }
  .moa-careers .section-head p { margin-top: 12px; color: var(--ink-muted); }

  /* Buttons */
  .moa-careers .btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    min-width: 160px; padding: 13px 28px; white-space: nowrap;
    font-family: var(--font-heading); font-weight: 600; font-size: 15px; line-height: 1;
    color: #fff; background: var(--brand-primary);
    border: 2px solid var(--brand-primary); border-radius: 999px;
    text-decoration: none; cursor: pointer;
    transition: background .2s, border-color .2s, color .2s, transform .2s;
  }
  .moa-careers .btn:hover { background: var(--brand-primary-dark); border-color: var(--brand-primary-dark); color: #fff; transform: translateY(-1px); }
  .moa-careers .btn--secondary { background: var(--brand-secondary); border-color: var(--brand-secondary); }
  .moa-careers .btn--secondary:hover { background: var(--brand-secondary-dark); border-color: var(--brand-secondary-dark); }
  .moa-careers .btn--ghost { background: transparent; border-color: #fff; }
  .moa-careers .btn--ghost:hover { background: #fff; border-color: #fff; color: var(--brand-primary); }
  .moa-careers a:focus-visible, .moa-careers button:focus-visible, .moa-careers input:focus-visible, .moa-careers textarea:focus-visible, .moa-careers select:focus-visible { outline: 3px solid var(--brand-secondary); outline-offset: 3px; }

  /* Photo slots: placeholder gradient until a real photo is set via --img */
  .moa-careers .photo {
    position: relative; overflow: hidden; border-radius: var(--radius);
    background:
      var(--img, none) center / cover no-repeat,
      linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-secondary) 100%);
    aspect-ratio: 3 / 2;
    box-shadow: 0 12px 30px rgba(35, 70, 140, .14);
  }
  .moa-careers .photo__badge {
    position: absolute; left: 18px; bottom: 18px;
    padding: 10px 16px; border-radius: 8px; background: #fff; color: var(--brand-primary);
    font-family: var(--font-heading); font-weight: 700; font-size: 14px;
    box-shadow: 0 8px 20px rgba(0,0,0,.15);
  }
  .moa-careers .photo__badge strong { color: var(--brand-secondary); font-size: 20px; margin-left: 4px; }

  /* ---------- Hero ---------- */
  .moa-careers .hero {
    position: relative; min-height: 78vh; display: flex; align-items: center; justify-content: center;
    padding: 90px 24px 110px; text-align: center; color: #fff;
    background:
      linear-gradient(180deg, rgba(8, 28, 58, .55) 0%, rgba(8, 28, 58, .8) 100%),
      var(--hero-img, linear-gradient(135deg, #081C3A 0%, #23468C 55%, #126CD0 100%)) center / cover no-repeat;
  }
  .moa-careers .hero .eyebrow { color: #fff; opacity: .85; }
  .moa-careers .hero h1 { font-size: clamp(2.3rem, 5.8vw, 3.9rem); font-weight: 800; letter-spacing: -.01em; text-shadow: 0 2px 18px rgba(0,0,0,.25); color: #fff; }
  .moa-careers .hero__sub { max-width: 600px; margin: 18px auto 0; font-size: 1.1rem; opacity: .92; }
  .moa-careers .hero__ctas { display: flex; flex-wrap: wrap; justify-content: center; gap: 14px; margin-top: 32px; }
  .moa-careers .scroll-cue {
    position: absolute; left: 50%; bottom: 28px; transform: translateX(-50%);
    width: 40px; height: 40px; border: 2px solid #fff; border-radius: 50%;
    display: grid; place-items: center; color: #fff;
    animation: moa-bob 2s ease-in-out infinite;
  }
  @keyframes moa-bob { 0%,100% { transform: translate(-50%, 0); } 50% { transform: translate(-50%, 6px); } }

  /* ---------- Feature rows ---------- */
  .moa-careers .feature { display: grid; grid-template-columns: 1fr 1fr; gap: 56px; align-items: center; }
  .moa-careers .feature + .feature { margin-top: 80px; }
  .moa-careers .feature--reverse .feature__media { order: 2; }
  .moa-careers .feature h2 { color: var(--brand-secondary); font-size: 1.8rem; font-weight: 800; margin-bottom: 14px; }
  .moa-careers .feature p { color: var(--ink-muted); }
  .moa-careers .feature p + p { margin-top: 12px; }
  .moa-careers .classes { list-style: none; margin: 20px 0 0; padding: 0; display: grid; gap: 10px; }
  .moa-careers .classes li { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px; background: var(--surface-alt); font-family: var(--font-heading); font-weight: 600; font-size: .95rem; }
  .moa-careers .classes span { width: 28px; height: 28px; flex: none; border-radius: 50%; display: grid; place-items: center; background: var(--brand-secondary); color: #fff; font-size: 13px; }

  /* ---------- Positions ---------- */
  .moa-careers .positions { background: var(--surface-alt); }
  .moa-careers .roles { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
  .moa-careers .role {
    display: flex; flex-direction: column; padding: 28px 24px; border-radius: var(--radius);
    background: #fff; border-top: 4px solid var(--brand-secondary);
    box-shadow: 0 6px 18px rgba(35, 70, 140, .06);
    transition: transform .2s, box-shadow .2s;
  }
  .moa-careers .role:hover { transform: translateY(-4px); box-shadow: 0 14px 30px rgba(35, 70, 140, .12); }
  .moa-careers .role__icon { width: 48px; height: 48px; border-radius: 12px; display: grid; place-items: center; background: var(--brand-tint); color: var(--brand-secondary); margin-bottom: 16px; }
  .moa-careers .role h3 { font-size: 1.15rem; font-weight: 700; color: var(--brand-primary); }
  .moa-careers .role__meta { font-size: .82rem; color: var(--ink-muted); margin-top: 4px; }
  .moa-careers .role p.role__desc { margin-top: 12px; font-size: .95rem; color: var(--ink-muted); flex: 1; }
  .moa-careers .role__link { margin-top: 18px; font-family: var(--font-heading); font-weight: 600; font-size: .9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
  .moa-careers .role__link:hover { color: var(--brand-secondary); }

  /* ---------- Apply ---------- */
  .moa-careers .apply-grid { display: grid; grid-template-columns: 1fr 1.35fr; gap: 32px; align-items: start; }
  .moa-careers .visit {
    padding: 36px 32px; border-radius: 14px; color: #fff;
    background: linear-gradient(150deg, var(--brand-primary) 0%, #1a3569 100%);
    position: relative; overflow: hidden;
  }
  .moa-careers .visit::after { content: ""; position: absolute; right: -70px; bottom: -70px; width: 220px; height: 220px; border-radius: 50%; background: var(--brand-secondary); opacity: .2; }
  .moa-careers .visit h3 { font-size: 1.4rem; font-weight: 700; color: #fff; }
  .moa-careers .visit > p { margin-top: 10px; opacity: .9; }
  .moa-careers .visit dl { margin: 26px 0 0; display: grid; gap: 18px; position: relative; z-index: 1; }
  .moa-careers .visit dt { font-family: var(--font-heading); font-size: 12px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; opacity: .75; }
  .moa-careers .visit dd { margin: 4px 0 0; font-size: 1.02rem; font-weight: 600; }
  .moa-careers .visit a { color: #fff; }
  .moa-careers .visit .btn { margin-top: 28px; position: relative; z-index: 1; }

  .moa-careers .form-card { padding: 36px 32px; border-radius: 14px; background: #fff; border: 1px solid var(--line); box-shadow: 0 12px 30px rgba(35, 70, 140, .08); }
  .moa-careers .form-card h3 { font-size: 1.4rem; font-weight: 700; color: var(--brand-primary); }
  .moa-careers .form-card > p { margin: 8px 0 24px; color: var(--ink-muted); }

  /* Contact Form 7 output, styled to match */
  .moa-careers .wpcf7 p { margin: 0 0 16px; }
  .moa-careers .wpcf7 label { display: block; font-family: var(--font-heading); font-size: .85rem; font-weight: 600; color: var(--ink); }
  .moa-careers .wpcf7 input[type="text"],
  .moa-careers .wpcf7 input[type="email"],
  .moa-careers .wpcf7 input[type="tel"],
  .moa-careers .wpcf7 input[type="url"],
  .moa-careers .wpcf7 input[type="number"],
  .moa-careers .wpcf7 input[type="date"],
  .moa-careers .wpcf7 select,
  .moa-careers .wpcf7 textarea {
    width: 100%; margin-top: 6px; padding: 12px 14px;
    font: inherit; font-size: .95rem; color: var(--ink);
    background: var(--surface-alt); border: 1px solid var(--line); border-radius: 8px;
    transition: border-color .2s, background .2s;
  }
  .moa-careers .wpcf7 textarea { min-height: 130px; resize: vertical; }
  .moa-careers .wpcf7 input:focus, .moa-careers .wpcf7 select:focus, .moa-careers .wpcf7 textarea:focus { border-color: var(--brand-primary); background: #fff; outline: none; }
  .moa-careers .wpcf7 input[type="file"] { margin-top: 6px; font-size: .9rem; }
  .moa-careers .wpcf7 input[type="submit"], .moa-careers .wpcf7 .wpcf7-submit {
    width: 100%; padding: 15px 28px; margin-top: 4px;
    font-family: var(--font-heading); font-weight: 700; font-size: 15px; letter-spacing: .02em;
    color: #fff; background: var(--brand-secondary); border: 0; border-radius: 999px; cursor: pointer;
    transition: background .2s;
  }
  .moa-careers .wpcf7 input[type="submit"]:hover { background: var(--brand-secondary-dark); }
  .moa-careers .wpcf7-not-valid-tip { font-size: .8rem; color: var(--brand-secondary); margin-top: 4px; }
  .moa-careers .wpcf7 form .wpcf7-response-output { margin: 16px 0 0; padding: 12px 14px; border-radius: 8px; font-size: .9rem; }
  .moa-careers .wpcf7-spinner { margin: 10px auto 0; display: block; }

  /* ---------- About strip ---------- */
  .moa-careers .about__inner { max-width: 760px; margin: 0 auto; text-align: center; }
  .moa-careers .about p { color: var(--ink-muted); }
  .moa-careers .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 36px; }
  .moa-careers .stat { padding: 22px 16px; text-align: center; background: var(--surface-alt); border-radius: var(--radius); border-top: 4px solid var(--brand-secondary); }
  .moa-careers .stat strong { display: block; font-family: var(--font-heading); font-size: 1.5rem; color: var(--brand-primary); line-height: 1.3; }
  .moa-careers .stat span { font-size: .8rem; color: var(--ink-muted); text-transform: uppercase; letter-spacing: .08em; }

  /* ---------- Reveal on scroll ---------- */
  .moa-careers .reveal { opacity: 0; transform: translateY(24px); transition: opacity .7s ease, transform .7s ease; }
  .moa-careers .reveal.is-visible { opacity: 1; transform: none; }
  .no-js .moa-careers .reveal { opacity: 1; transform: none; }
  @media (prefers-reduced-motion: reduce) {
    .moa-careers .reveal { opacity: 1; transform: none; transition: none; }
    .moa-careers .scroll-cue { animation: none; }
  }

  /* ---------- Responsive ---------- */
  @media (max-width: 960px) {
    .moa-careers .roles { grid-template-columns: repeat(2, 1fr); }
    .moa-careers .apply-grid { grid-template-columns: 1fr; }
  }
  @media (max-width: 820px) {
    .moa-careers .feature { grid-template-columns: 1fr; gap: 28px; }
    .moa-careers .feature--reverse .feature__media { order: 0; }
    .moa-careers .section { padding: 64px 0; }
  }
  @media (max-width: 560px) {
    .moa-careers .wrap { padding: 0 16px; }
    .moa-careers .roles, .moa-careers .stats { grid-template-columns: 1fr; }
    .moa-careers .hero__ctas .btn { min-width: 0; flex: 1 1 140px; }
    .moa-careers .visit, .moa-careers .form-card { padding: 28px 20px; }
  }
</style>

<main class="moa-careers" id="careers">

  <!-- ===== Hero ===== -->
  <section class="hero" <?php if ( $moa_hero_img ) : ?>style="--hero-img: url('<?php echo esc_url( $moa_hero_img ); ?>');"<?php endif; ?>>
    <div>
      <span class="eyebrow">Careers at Moving of America</span>
      <h1>Move Your Career Forward</h1>
      <p class="hero__sub">We're always looking for new drivers, movers, and foremen to join a fantastic moving team here in New Jersey.</p>
      <div class="hero__ctas">
        <a class="btn btn--secondary" href="#apply">Apply now</a>
        <a class="btn btn--ghost" href="#positions">Open positions</a>
      </div>
    </div>
    <a class="scroll-cue" href="#who" aria-label="Scroll to content">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
    </a>
  </section>

  <!-- ===== Feature rows ===== -->
  <section class="section" id="who">
    <div class="wrap">
      <div class="feature reveal">
        <div class="feature__media">
          <div class="photo" role="img" aria-label="The Moving of America team">
            <span class="photo__badge">Family-owned since <strong>2007</strong></span>
          </div>
        </div>
        <div>
          <span class="eyebrow">Who we are</span>
          <h2>Built by Friends, Run Like Family</h2>
          <p>Moving of America started in 2007 when two friends, David Bloom and Sammy Sassoun, set out with a few trucks and a crew made up mostly of family and friends, taking on local moves across New Jersey.</p>
          <p>We've grown a lot since then, but we're still family-oriented and still based in Bergen County, with our headquarters in Ridgefield, NJ.</p>
        </div>
      </div>

      <div class="feature feature--reverse reveal">
        <div class="feature__media"><div class="photo" role="img" aria-label="Moving of America crew at work"></div></div>
        <div>
          <span class="eyebrow">Growth &amp; opportunity</span>
          <h2>We Promote From Within</h2>
          <p>We strongly believe in internal promotion and rewarding excellence. If you put in the effort, your dedication and hard work will be recognized and valued.</p>
          <p>We're committed to supporting your progression and advancement within the company, from your first day on the truck to leading a crew.</p>
        </div>
      </div>

      <div class="feature reveal">
        <div class="feature__media"><div class="photo" role="img" aria-label="New hires in a Moving of America training class"></div></div>
        <div>
          <span class="eyebrow">Training</span>
          <h2>Learn the Ins and Outs of Moving</h2>
          <p>Every new hire goes through extensive training that teaches the ins and outs of moving, with specialized classes on:</p>
          <ul class="classes">
            <li><span>1</span>Introduction to Moving</li>
            <li><span>2</span>Customer Service</li>
            <li><span>3</span>Damage Prevention</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== Positions ===== -->
  <section class="section positions" id="positions">
    <div class="wrap">
      <div class="section-head reveal">
        <span class="eyebrow">Now hiring</span>
        <h2>Open Positions</h2>
        <p>Join our team in Ridgefield, NJ. Experienced or ready to learn, there's a place for you here.</p>
      </div>

      <div class="roles">
        <article class="role reveal">
          <div class="role__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 3h15v13H1z"/><path d="M16 8h4l3 3v5h-7z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
          <h3>Driver</h3>
          <div class="role__meta">Operations · Ridgefield, NJ</div>
          <p class="role__desc">Get our trucks and our customers' belongings where they need to go, safely and on time.</p>
          <a class="role__link" href="#apply">Apply <span aria-hidden="true">→</span></a>
        </article>
        <article class="role reveal">
          <div class="role__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8 12 3 3 8v8l9 5 9-5z"/><path d="m3 8 9 5 9-5"/><path d="M12 13v8"/></svg></div>
          <h3>Mover</h3>
          <div class="role__meta">Operations · Ridgefield, NJ</div>
          <p class="role__desc">Pack, protect, load, and carry with care on residential and commercial moves.</p>
          <a class="role__link" href="#apply">Apply <span aria-hidden="true">→</span></a>
        </article>
        <article class="role reveal">
          <div class="role__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="7" r="4"/><path d="M2 21v-2a4 4 0 0 1 4-4h6a4 4 0 0 1 4 4v2"/><path d="M19 8v6M22 11h-6"/></svg></div>
          <h3>Foreman</h3>
          <div class="role__meta">Operations · Ridgefield, NJ</div>
          <p class="role__desc">Lead the crew on the job and make sure every move is done right for the customer.</p>
          <a class="role__link" href="#apply">Apply <span aria-hidden="true">→</span></a>
        </article>
        <article class="role reveal">
          <div class="role__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
          <h3>Field Inspector</h3>
          <div class="role__meta">Operations · New Jersey</div>
          <p class="role__desc">Visit job sites to check our movers' performance and keep our service standards high.</p>
          <a class="role__link" href="#apply">Apply <span aria-hidden="true">→</span></a>
        </article>
      </div>
    </div>
  </section>

  <!-- ===== Apply ===== -->
  <section class="section" id="apply">
    <div class="wrap">
      <div class="section-head reveal">
        <span class="eyebrow">Join the team</span>
        <h2>How to Apply</h2>
        <p>Stop by our office to fill out an application in person, or send us your details online and we'll be in touch.</p>
      </div>

      <div class="apply-grid">
        <div class="visit reveal">
          <h3>Apply in Person</h3>
          <p>Driver and mover applicants can complete an employment application at our office.</p>
          <dl>
            <div>
              <dt>Office</dt>
              <dd>395 Broad Ave<br>Ridgefield, NJ 07657</dd>
            </div>
            <div>
              <dt>Hours</dt>
              <dd>Monday – Friday<br>9:30 am – 5:00 pm</dd>
            </div>
            <div>
              <dt>Questions about open roles</dt>
              <dd><a href="mailto:info@movingofamerica.com">info@movingofamerica.com</a></dd>
            </div>
          </dl>
          <a class="btn btn--ghost" href="https://www.google.com/maps/search/?api=1&amp;query=395+Broad+Ave+Ridgefield+NJ+07657" target="_blank" rel="noopener">Get directions</a>
        </div>

        <div class="form-card reveal">
          <h3>Apply Online</h3>
          <p>Fill out the form below and our hiring team will reach out.</p>
          <?php echo do_shortcode( '[contact-form-7 id="b8a7e08" title="Career"]' ); ?>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== About strip ===== -->
  <section class="section about" style="padding-top: 0;">
    <div class="wrap">
      <div class="about__inner reveal">
        <span class="eyebrow">About Moving of America</span>
        <p>A New Jersey moving company handling residential and commercial, local and long-distance moves, plus packing, crating, and storage.</p>
        <div class="stats">
          <div class="stat"><strong>2007</strong><span>Founded</span></div>
          <div class="stat"><strong>Ridgefield, NJ</strong><span>Headquarters</span></div>
          <div class="stat"><strong>1601312</strong><span>USDOT number</span></div>
        </div>
      </div>
    </div>
  </section>

</main>

<script>
  (function () {
    var items = document.querySelectorAll('.moa-careers .reveal');
    if (!('IntersectionObserver' in window)) {
      items.forEach(function (el) { el.classList.add('is-visible'); });
      return;
    }
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) { entry.target.classList.add('is-visible'); io.unobserve(entry.target); }
      });
    }, { threshold: 0.15 });
    items.forEach(function (el) { io.observe(el); });
  })();
</script>

<?php
get_footer();
