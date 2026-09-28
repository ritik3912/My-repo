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
3. On activation the theme creates the Kenedy Retreat apartments (One-Bedroom Suite, Efficiency
   Suite, Two-Bedroom, Two-Bath Apartment) plus an "Amenities" page (About Page template) and a
   "Contact Us" page (Contact Page template) and a "Gallery" page (Gallery Page template), unless
   pages with those templates exist. The Kenedy
   Retreat photos bundled in assets/images/kenedy/ are imported into the Media Library and placed
   in every image slot and as the apartments' Featured Images.
4. Settings → Reading: choose "A static page" and pick any page as the Homepage (the theme's
   front-page.php renders the resort layout either way).
5. Appearance → Customize has four panels:
   - Azure Isle — Site Settings: header phone and button, call to action band, footer contact details
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

== Gallery ==

The Gallery page shows the photos in its page editor as a grid; clicking one opens a full-screen
viewer with previous/next arrows (keyboard arrows and Esc work too). To add, remove or reorder
photos, edit the [gallery] shortcode (or replace it with a Gallery block, linked to the media
file). Captions come from each image's Caption in the Media Library.

== Rooms ==

Rooms → Add New. Title, description, excerpt (shown on the card), Featured Image (card and room
hero), and a "Room Details" box for price, size, guests, beds and view. Use the "Order" field to
sort them. Rooms live at /rooms/ and each has its own page.

== Forms ==

The Contact form emails the address in Customize → Contact Page → Contact Form (or the site admin
email). Make sure your site can send email (an SMTP plugin is advised).

== Sample content ==

The default headings and text are the Kenedy Retreat content. Before going live, add in the Customizer:
- Phone and email (Site Settings → Header, and Footer & Contact Details).
- Guest reviews (Front Page → Guest Reviews); the section stays hidden until a quote is filled in.
- Your logo (Site Identity → Logo); until then the header shows the site name.
Images can be swapped in the Customizer at any time.

== Credits ==

Fonts: Marcellus, Jost and Mrs Saint Delafield via Google Fonts (SIL Open Font License).
