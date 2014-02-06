=== Facebook Photo Album ===
Contributors: ram108
Donate link: http://www.ram108.ru/donate
Tags: facebook, photo, album, slider, images, gallery, picasa, flickr, widget, shortcode, ram108, lightbox, colorbox, fancybox, thickbox
Requires at least: 3.3.3
Tested up to: 3.7.1
Stable tag: 0.4.8
License: GPLv2 or later

The plugin brings Facebook Photo Albums to your WordPress site. Now with Facebook slider!

== Description ==

**Easy way to add Facebook photos to your site**. Includes widget, shortcode and Facebook slider. Made with SEO in mind.

= NEW update with version 0.4 =
* Facebook slider
* Facebook Like button
* Translation ready

= Plugin features =
* Display Facebook photos in album or slider style
* Use widget, shortcode or easy plugin button for albums installation
* Choose from different thumbnail shapes and sizes
* Get random images from Facebook Timeline or any album
* Realtime updates from Facebook for installed albums
* Fast data communication with APC cache and cURL
* SEO optimized, responsive layout
* Fancybox included

[LIVE DEMO](http://www.ram108.ru/plugins/ram108-fbalbum) — visit plugin home page.

= Usage =

Read FAQ for detailed explanation on plugin usage.

= Limitations = 

Facebook allow to access to public albums only. The plugin will not show private photos even if you able to see it.

= Translations =

English, Русский. You can help with plugin translation into your language.

= Thanks =

Do you like the plugin? **Rate it** in Wordpress plugin directory or **write a review** on your blog.

== Installation ==

1. Install and activate the plugin through builtin WordPress plugin interface
1. Make sure you pass plugin requirements in plugin settings page
1. Use easy plugin button in Wordpress editor to install Facebook albums
1. [Read FAQ](../faq) to know more

== Frequently Asked Questions ==

= How to find Album URL =

Navigate to any public Facebook page. Open 'Photos' tab → Choose 'Albums' → Click an album you'd like to show on your site (if available). Copy an album URL from the browser navigation bar. 

The correct URL should looks like https://www.facebook.com/media/set/?set=a.671492806205398.1073741831.198871113467572&type=3 with `?set` word in the center and 3 long numbers at the end.

To get latest photos of Page Timeline, choose 'Timeline Photos' in 'Albums' tab.

= Easy plugin button in Wordpress editor =

Use Facebook Photo Album plugin button in Wordpress editor to install albums into your posts.

= Widget =

Open Wordpress widgets page. From the available widgets choose `[ram108] Facebook Photo Album` and drag and drop it to widget area. 

Add a title, album URL, number of images to display. Choose 'Random pick' if you want to get random photos. 'Add hidden images' will get more images from Facebook that will be visible in popup of FancyBox only. Select 'Slider style' in widget options to get a slider.

= Shortcode =

 Get all photos from the album:
`[fbalbum url=https://www.facebook.com/media/set/?set=a.671492806205398.1073741831.198871113467572&type=3]`

Choose how many photos to display:
`[fbalbum url=... limit=30]` 

Post album title and description from Facebook:
`[fbalbum url=... desc=1]`

Display random photos from the album:
`[fbalbum url=... limit=10 random=1]`

Specify thumbnail size:
`[fbalbum url=... size=160]`

Specify thumbnail shape (0=Rectangular, 1=Square, 2=Circle):
`[fbalbum url=... shape=1]`

= Slider options =

Display album is slider style:
`[fbalbum url=... limit=15 slider=1]`

Start slideshow on page load (0=manual, 1=auto):
`[fbalbum url=... slider=1 slider_start=1]`

= Use Facebook to manage your photos =

[Create new](https://www.facebook.com/pages/create/) public Facebook page. Add your photo albums there. Use Facebook Photo Album plugin to share your photos to Wordpress site. 

= Plugin requirements =

[APC cache](https://www.google.com/search?q=install+apc+cache) and [cURL extension](https://www.google.com/search?q=how+to+enable+curl+extension) should be installed on your server for faster data communications with Facebook. The plugin refresh posted albums every one hour.

= Troubleshooting =

***Double image appearing*** or ***Image not appearing*** on click. Disable builtin Fancybox in Facebook Photo Album settings page or deactivate installed lightbox, colorbox or prettyPhoto plugin in Wordpress plugins page.

***Facebook error responce: (#4) Application request limit reached***. Open Facebook Photo Album settings page and make sure you have APC cache installed in Requirements check.

= Thanks =

Thank you for using Facebook Photo Album plugin. If you have any questions, suggestions or need a plugin assistance feel free to contact author at mail@ram108.ru

== Screenshots ==

1. Facebook Photo Album widget
2. Editor with plugin button and shortcode
3. Plugin button dialog box
4. Settings page in Wordpress Dashboard
5. Example with different types of Facebook albums installed

== Changelog ==

= 0.4.8 =
* Remove short_open_tag for compatibility support

= 0.4.7 = 
* Update Fancybox script
* Remove Facebook #tags from image description
* Minor fixes

= 0.4.6 =
* Slider CSS fix

= 0.4.5 = 
* Translation ready
* English & Russain translations
* Hide wp_remote_get error message if not admin
* HTML makeup change to stop double image appearing

= 0.4 =
* Facebook slider
* Facebook like button
* Set user-agent in wp_remote_get
* Many minor fixes

= 0.3.1 =
* Enable builtin Fancybox by default
* Remove lightbox, colorbox & etc classes from HTML if Fancybox is enabled

= 0.3 =
* Plugin button in Wordpress editor
* Remove Facebook meta data in album description
* Use wp_remote_get instead of direct cURL request

= 0.2.3 =
* Drop APC cache on thumbnail size change

= 0.2.2 =
* Downgrade Fancybox to v.1 (v.2 is GPL incompatible)
* Fancybox options in settings page
* Hidden image fix
* Data transfer function fix

= 0.2.1 =
* Overall speed and memory usage improvements
* Fancybox fix
* External extensions fix

= 0.2 =
* Plugin settings page
* Different thumbnail sizes
* Rectangular, square, circle thumbnails
* Include of Fancybox script
* Improve image quality

= 0.1 =
* Initial release
