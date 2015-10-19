

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


Users manual
------------

To add a youtube-video create a new content-element, select “General
Plugin” in “Plugin”-Section.

Go to tab “Plugin” and select “Simple Youtube”.

Now you need to enter some information to embed the right video.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Property
         VIDEO\_ID

   Data type
         string

   Description
         The youtube video-id could be found within the url.

         For example: http://www.youtube.com/watch?v=Jhia3G35vJg

         Jhia3G35vJg is the video-id

   Default
         \


.. container:: table-row

   Property
         Video width

   Data type
         int+

   Description
         The width of the embedded video.

   Default
         560 (by Typoscript)


.. container:: table-row

   Property
         Video height

   Data type
         int+

   Description
         The height if the embedded video.

         To keep the aspect of a video, open the youtube-link of the video, go
         to “share”->”embed” and select “usedefinde size” for videosize.

         Entering the width will provide the right height.

   Default
         315 (by Typoscript)


.. container:: table-row

   Property
         Use html5 to embed video

   Data type
         int

   Description
         Select the way the video is embedded to your website.(Selecting
         “Defined in TypoScript” and setting the constant “html5” to 1 is
         recommanded)

   Default
         “Defined in TypoScript”


.. container:: table-row

   Property
         Show suggested videos when the video finishes

   Data type
         boolean

   Description
         Show suggested videos when the video finishes.

   Default
         false


.. container:: table-row

   Property
         Allow fullscreen

   Data type
         boolean

   Description
         Allow fullscreen.

   Default
         true


.. container:: table-row

   Property
         Custom video parameters

   Data type
         string

   Description
         Add your own video parameters starting with '&'. (The parameters 'fs',
         'rel' and 'html5' are already set by the extension.)

         Guideline for parameters:
         `https://developers.google.com/youtube/player\_parameters#Parameters
         <https://developers.google.com/youtube/player_parameters#Parameters>`_

         Example (autoplay from second 60):

         &autoplay=1&start=60

   Default
         \


.. ###### END~OF~TABLE ######


