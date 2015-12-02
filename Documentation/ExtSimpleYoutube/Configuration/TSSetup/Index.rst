.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
:class:  typoscript
.. role::   php(code)


TypoScript Setup
^^^^^^^^^^^^^^^^
Manually change TypoScript Setup for this extension in this special case, only:

| Since version 0.5.0 jh_simple_youtube uses a secure connection to youtube via https:// request.
| If you want to use an unencrypted connection add this setup:


.. code-block:: typoscript

    plugin.tx_jhsimpleyoutube.settings.youtubeUrl = http://www.youtube.com/embed/
    [globalString = ENV:HTTPS=on]
        plugin.tx_jhsimpleyoutube.settings.youtubeUrl = https://www.youtube.com/embed/
    [global]

