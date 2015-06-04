<!--
    This file is part of the "GratisOnlineAlert" Thelia 2 module.

    Copyright (c) OpenStudio
    email : dev@thelia.net
    web : http://www.thelia.net

    For the full copyright and license information, please view the LICENSE.txt
    file that was distributed with this source code.
-->
GratisOnlineAlert module v1.0
===

Author : [Romain Ducher](mailto://rducher@openstudio.fr)

1. Usage
---

This module warns you if online products are currently free. Products concerned by this warning are:

* Products with free sale elements which are not currently in promo.
* Products with sale elements currently in promo and whose promo price is 0.

To be warned by the module you just have to activate it. If you want to turn off the warning, deactivate the module.

The warning is displayed on Thelia's administration console's homepage. 

2. Options
---

To select options you have to go in configuration module page.

There are 2 options :

* Stop propagation event for creation and update. ( A product can't be free with this option )
* Receive a mail when an product is free.

3. Installation
---

Install it as a Thelia module by downloading the zip archive and extracting it in ```thelia/local/modules``` or by uploading it with the backoffice (at ```/admin/modules```),
or by requiring it with Composer:

```json

"require": {
    "thelia/gratisonlinealert-module": "~1.0"
}
```
