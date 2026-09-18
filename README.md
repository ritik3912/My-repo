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

Go to **Treks → Add New**. Every repeating section (route, itinerary, cost, packing, seasons, wish-i-knew) is an editable **table** — click **+ Add row** to add a row, click **✕** to remove one. There's still no page-builder/ACF dependency: under the hood each table is backed by a plain post-meta field, kept in sync as you type by `assets/js/admin-repeater.js`. If you ever prefer typing raw text (e.g. pasting several rows at once), click **Edit as plain text** on any table to switch to the old one-line-per-row view — either way works, and switching back re-reads whatever you typed.

| Box | Columns | Example row |
|---|---|---|
| Route steps | Place, What happens here | `Delhi` / `Overnight bus to Rishikesh, ~7-8 hrs` |
| Route notes | Tip | `Shared cabs fill up early — start by 7 AM` |
| Itinerary | Title, Distance, Walking Duration, Elevation Gain, Difficulty, Highlights, Personal Notes | `Base to Camp 1` / `6 km` / `4–5 hrs` / `+800 m` / `Moderate` / `Oak forest, first ridge view` / `[your notes]` |
| Cost items | Category, Amount | `Delhi → Base Village` / `₹1,200` |
| Packing | Category, Items (comma-separated) | `Footwear` / `Trekking shoes, extra socks` |
| Seasons | Season, Conditions, Trail Condition, Visibility, Snow Possibility, What to Carry | up to 5 rows |
| Wish I Knew | Title, Description | `Network` / `Disappears after the base village` |

- **Main content editor** = the "My Experience" section, written in first person. Tick **"This trek has a real, personally-written experience"** in the Quick Info box to show it — otherwise the page shows an editable placeholder instead of pretending everyone's experience is the same.
- **Region / Difficulty / Duration / Experience Level** are set in the taxonomy boxes on the right-hand side of the editor (like Categories). Add new terms there any time — the Trek Finder filters update automatically.
- **Excerpt** = the short one/two-line description shown on trek cards and in the hero.
- **Featured Image** = the large hero photo.

## Adding photos and videos

- **Hero / card images**: set the post's Featured Image.
- **Photo Journal**: the **Photo Journal** meta box uploads real photos straight from the WordPress Media Library. Click **+ Add photo group** (e.g. "Day 1", "Summit Day"), then **Add Photos** on that group to open the media picker — multi-select works. Remove a photo with the **✕** on its thumbnail, or a whole group with **Remove group**. Photos render as a real masonry gallery on the trek page and open full-size in a lightbox on click.
- **Trek Videos**: the **Trek Videos** meta box (below Photo Journal) takes either a YouTube/Vimeo link or a video file uploaded from the Media Library. Click **+ Add video**, choose the type, then paste the URL or click **Choose video file**. Videos render as a responsive embed/player on the trek page under "Trail Videos".

Every image and video field only appears once you've added a real photo or trek — until then the site shows a clearly-labelled placeholder tile instead of a broken image.

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
page.php / index.php / single.php / 404.php   Fallback templates
template-parts/*.php   Reusable, data-driven components (includes photo-gallery.php + video-gallery.php)
assets/js/main.js            Sticky header, mobile menu, scroll reveal, Trek Finder filtering, photo lightbox
assets/js/admin-repeater.js  Turns the Trek meta boxes' pipe/line fields into editable tables
assets/js/admin-media.js     Media Library uploader for Photo Journal groups + Trek Videos
assets/css/admin-trek.css    Styling for the two admin scripts above (Trek edit screen only)
```

## Notes on content accuracy

Per the brief, the theme never invents trek facts. Every quick-info field, itinerary day, cost line, season and packing item that hasn't been filled in shows a bracketed `[Add …]` placeholder rather than a guessed number — fill these in from real experience as you go.
