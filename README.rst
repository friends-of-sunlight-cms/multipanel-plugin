MultiPanel
##########

Extended and expandable user menu. Basically includes an upgraded user menu with avatar, transparent background.

.. contents::

Requirements
************

- SunLight CMS 8

Usage
*****

General definition for MultiPanel

::

  [hcm]multipanel,multimode,id_module[/hcm]


 - multimode - panel expansion mode
   - true - expanding multiple items simultaneously
   - false - expand only one item at a time
 - id_modulu - identifier of the module to be loaded


Shorthand for HCM MemberPanel (usermenu with avatar)

::
  [hcm]multipanel,true,"memberpanel"[/hcm]
  [hcm]memberpanel[/hcm]


Installation
************

::

    Copy the folder 'plugins' and its contents to the root directory

or

::

    Installation via administration: 'Administration > Plugins > Upload new plugins'
