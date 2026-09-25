# Trail Notes — WordPress Theme

A custom, editorial WordPress theme for a personal Himalayan trekking journal: real trek stories combined with practical route, cost, packing and planning information. No page builder, no ACF, no forms plugin — everything is a plain WordPress custom post type, taxonomies and post meta, so the theme is self-contained and easy to hand off.

## Requirements

- WordPress 6.0+
- PHP 7.4+

## Install

1. Zip this theme folder (or copy it) into `wp-content/themes/trail-notes/`.
2. In **Appearance → Themes**, activate **Trail Notes**.
3. On activation the theme automatically:
   - Registers the **Trek** custom post type and its four taxonomies (Region, Difficulty, Duration, Experience Level) and seeds their starting terms (Uttarakhand / Himachal Pradesh, Easy / Moderate / Challenging, Weekend / 3-4 Days / 5-7 Days, Beginner / Intermediate / Experienced).
   - Creates the four treks named in the brief (Chopta–Tungnath–Chandrashila, Chakrata–Moila Top, Yulla Kanda, Raghupur Fort–Sillasar Lake) with their region and short description already filled in, and the one real "My Experience" paragraph on the Chopta trek. Every other fact (difficulty, cost, itinerary, etc.) is left as an on-page "[Add …]" placeholder — nothing is invented.
   - Creates the **About Me**, **Travel Tips** and **Plan a Trek** pages so their custom templates have somewhere to live.
4. Go to **Settings → Site Title** and set it to your brand name (defaults to whatever your WordPress install already has — the theme doesn't hardcode "Trail Notes" anywhere in templates, only in this README and the stylesheet header).
5. Go to **Appearance → Menus** and assign a menu to **Primary Navigation** (optional — the header falls back to Home / My Treks / Travel Tips / About Me automatically if you skip this).
6. Go to **Appearance → Customize → Trail Notes — Social & Contact** and add your Instagram URL, YouTube URL and contact email. These feed the footer, the homepage Instagram section and the About page.
7. Set a **Featured Image** on each Trek and Page for the hero photos — until you do, the theme shows a clearly-labelled placeholder tile instead of a broken image, so the site never looks unfinished or broken.

## Adding or editing a trek

Go to **Treks → Add New**. There's no repeater-field UI — every repeating section (route, itinerary, cost, packing, seasons, wish-i-knew, photo groups) is a plain textarea where **each line is one row**, and columns within a row are separated by `|`. This keeps the theme free of extra plugin dependencies while still being fully data-driven — add a new trek and it automatically appears in the homepage showcase, the `/treks/` archive and the Trek Finder filters with zero template changes.

| Box | Format | Example |
|---|---|---|
| Route steps | `Place \| What happens here` | `Delhi \| Overnight bus to Rishikesh, ~7-8 hrs` |
| Route notes | one tip per line | `Shared cabs fill up early — start by 7 AM` |
| Itinerary | `Title \| Distance \| Walking Duration \| Elevation Gain \| Difficulty \| Highlights \| Personal Notes` | `Base to Camp 1 \| 6 km \| 4–5 hrs \| +800 m \| Moderate \| Oak forest, first ridge view \| [Add your notes]` |
| Cost items | `Category \| Amount` | `Delhi → Base Village \| ₹1,200` |
| Packing | `Category: item one, item two` | `Footwear: Trekking shoes, extra socks` |
| Seasons | `Season \| Conditions \| Trail Condition \| Visibility \| Snow Possibility \| What to Carry` | one line per season, up to 5 |
| Wish I Knew | `Title \| Description` | `Network \| Disappears after the base village` |
| Photo groups | `Label \| number of placeholder tiles` | `Summit Day \| 6` |

- **Main content editor** = the "My Experience" section, written in first person. Tick **"This trek has a real, personally-written experience"** in the Quick Info box to show it — otherwise the page shows an editable placeholder instead of pretending everyone's experience is the same.
- **Region / Difficulty / Duration / Experience Level** are set in the taxonomy boxes on the right-hand side of the editor (like Categories). Add new terms there any time — the Trek Finder filters update automatically.
- **Excerpt** = the short one/two-line description shown on trek cards and in the hero.
- **Featured Image** = the large hero photo.

## Adding real photos later

Every image on the site is a placeholder tile (a labelled gradient box) until a real photo is attached, so nothing ever looks broken. To replace one:

- **Hero / card images**: set the post's Featured Image.
- **Photo Journal galleries**: currently rendered as placeholder counts (`template-parts/photo-gallery.php`). Swap in real photos by editing that file to loop over an actual gallery/attachment list instead of a placeholder count once photos are ready — the group structure (Day 1, Summit Day, etc.) stays the same.

## Island Resort page

`page-resort.php` is a standalone, full-width luxury resort landing page (its own transparent header, overlay menu and dark footer), styled by `assets/css/resort.css` and `assets/js/resort.js`, with Cormorant Garamond + Jost fonts. These load only on this template (`inc/resort.php`).

1. **Pages → Add New**, pick **Template: Island Resort**, publish.
2. Set the page's **Featured Image** for the full-screen hero.
3. Edit the arrays at the top of `page-resort.php` (rooms, experiences, dining/spa, reviews, gallery) to change the copy. The prices and reviews there are sample content, so replace them with real ones.
4. The availability bar is front-end only. Point its `action` at your booking plugin or engine to take real reservations.

## Plan a Trek form

`page-plan-a-trek.php` posts to `admin-post.php` (handled in `inc/plan-a-trek-form.php`) and emails the WordPress admin address via `wp_mail()` — no forms plugin or external service required. Make sure your WordPress host can actually send mail (many local/dev environments can't without an SMTP plugin).

## Structure

```
style.css              Theme header + the entire design system (colors, type, components)
functions.php          Theme bootstrap: setup, enqueue, includes
inc/custom-post-types.php   Trek CPT + 4 taxonomies + default term seeding
inc/meta-boxes.php     All trek custom fields (admin UI + save)
inc/template-tags.php  Parsing helpers, placeholder-image renderer, icons, breadcrumbs
inc/seo.php            Meta description, canonical, Open Graph output
inc/customizer.php     Social link + contact email settings
inc/plan-a-trek-form.php   Contact form handler
inc/seed-content.php   One-time demo content (the 4 treks + 3 pages)
header.php / footer.php    Sticky nav, mobile menu, footer
front-page.php         Homepage
archive-trek.php       /treks/ — listing + Trek Finder
single-trek.php         Full trek detail page
page-about.php / page-travel-tips.php / page-plan-a-trek.php   Template Name pages
page-resort.php        Island Resort landing page (+ inc/resort.php, assets/css/resort.css, assets/js/resort.js)
page.php / index.php / single.php / 404.php   Fallback templates
template-parts/*.php   Reusable, data-driven components
assets/js/main.js      Sticky header, mobile menu, scroll reveal, Trek Finder filtering
```

## Notes on content accuracy

Per the brief, the theme never invents trek facts. Every quick-info field, itinerary day, cost line, season and packing item that hasn't been filled in shows a bracketed `[Add …]` placeholder rather than a guessed number — fill these in from real experience as you go.
