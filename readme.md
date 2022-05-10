# feature-localized-strings

This module builds on WordPress and Modularity.

Create localized template strings for easy multilingual development. 

---

Version: 1.0.3

Author: Matze https://modularity.group

License: MIT

---

Adds ability to add translated (localized) strings in admin dashboard.
- use php-function `__ls('some string in your template')` in your theme
- add the string `some string in your template` below `Modules > Localized Strings` and add translations to provide translated version for that string
- use respective locale (f.e. de_DE for german) to define the translations language
- php output of `__ls()` function uses actual locale for string output (should be compatible with every multilang-plugin that sets the current locale after lang-switch)
- if needed you can also overide the locale when calling the function `__ls('some string in your template','en_GB')`
- if no translation for actual locale is found, the string itself is printed

---

**Changelog**

1.0.3
- fix PHP-notice when string has no localizations 

1.0.2
- fix PHP-notice when string has no localizations 

1.0.1
- improve fallback output

**Roadmap**
- ability to create string groups
- export/import group translations with json per group
