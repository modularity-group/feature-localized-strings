# feature-localized-strings

This module builds on WordPress and Modularity.

Create localized template strings for easy multilingual development. 

---

Version: 1.0.0

Author: Matze https://modularity.group

License: MIT

---

Adds ability to add translated (localized) strings in admin dashboard.
- use php-function `__ls('some string in your template')` in your theme
- add `some string in your template` here and add translations to provide translated version for that string
- use respective locale (f.e. de_DE for german) to define the translations language
- php output of `__ls()` function uses actual locale for string output (should be compatible with every multilang-plugin that sets the current locale after lang-switch)
- if needed you can also overide the locale when calling the function `__ls('some string in your template','en_GB')`

---

**ROADMAP**
- ability to create string groups and export/import group translations with json
