=== Azure Isle ===
Requires at least: 6.0
Tested up to: 6.6
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

An elegant, full-width WordPress theme for island resorts, boutique hotels and villas.

== Installation ==

1. Zip the `azure-isle` folder (or use the provided azure-isle.zip).
2. In WordPress go to Appearance → Themes → Add New → Upload Theme, choose the zip, then Activate.
3. On activation the theme creates four sample Rooms plus an "About the Hotel" page (About Page
   template) and a "Contact" page (Contact Page template), unless pages with those templates exist.
4. Settings → Reading: choose "A static page" and pick any page as the Homepage (the theme's
   front-page.php renders the resort layout either way).
5. Appearance → Customize has four panels:
   - Azure Isle — Site Settings: header phone and button, newsletter band, footer contact details
     and social links.
   - Azure Isle — Front Page: Hero, Welcome, Image Carousel, Video Band, Accommodations,
     Experiences, Guest Reviews, Services.
   - Azure Isle — About Page: Page Header, Introduction, Facts & Figures, Values, Our Story and which
     shared sections (carousel, reviews, services) to show.
   - Azure Isle — Contact Page: Page Header, Contact Details, Contact Form, Map.
6. Appearance → Menus: assign "Main Menu" (header) and "Footer Bottom Menu" (e.g. Privacy, Terms).
   Before a Main Menu is assigned, the header links to Home, Rooms, About and Contact.

== Page templates ==

Any page can use "About Page" or "Contact Page" under Page → Template. The page title is used as the
banner heading; the banner image falls back to the page's Featured Image. Anything typed in the
page editor is shown after the About introduction, or below the Contact form.

== Rooms ==

Rooms → Add New. Title, description, excerpt (shown on the card), Featured Image (card and room
hero), and a "Room Details" box for price, size, guests, beds and view. Use the "Order" field to
sort them. Rooms live at /rooms/ and each has its own page.

== Forms ==

The Contact form emails the address in Customize → Contact Page → Contact Form (or the site admin
email). The newsletter form emails sign-ups to the same address, or posts to your own form action
URL (e.g. Mailchimp) if one is set. Make sure your site can send email (an SMTP plugin is advised).

== Sample content ==

The default headings, text, contact details and guest reviews are sample content. Replace them with
your own before going live. Image slots show labelled placeholder tiles until you add real photos.

== Credits ==

Fonts: Marcellus, Jost and Mrs Saint Delafield via Google Fonts (SIL Open Font License).
