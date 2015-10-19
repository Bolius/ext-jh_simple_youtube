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


Reference
^^^^^^^^^

.. ### BEGIN~OF~TABLE ###

.. t3-field-list-table::
 :header-rows: 1

 - :Property:
         Property

   :Data type:
         Data type

   :Description:
         Description

   :Default:
         Default


 - :Property:
         width

   :Data type:
         int+

   :Description:
         The width of the embedded video in px.

   :Default:
         560


 - :Property:
         height

   :Data type:
         int+

   :Description:
         The height if the embedded video in px.

         To keep the aspect of a video, open the youtube-link of the video, go
         to “share”->”embed” and select “usedefinde size” for videosize.

         Entering the width will provide the right height.

   :Default:
         315


 - :Property:
         html5

   :Data type:
         boolean

   :Description:
         Embed videos as html5(True (1) is recommanded to support as many
         modern devices as possible)

   :Default:
         1


 - :Property:
         cssFile

   :Data type:
         file

   :Description:
         Path to css file

   :Default:
         EXT:jh_simple_youtube/Resources/Public/css/tx_jhsimpleyoutube.css


 - :Property:
         defaultPlayerParameters.iv_load_policy

   :Data type:
         options[0,3]

   :Description:
         IV load policy: Setting to 1 will cause video annotations to be shown by default, whereas setting to 3 will cause video annotations to not be shown by default.

   :Default:
         1


 - :Property:
         defaultPlayerParameters.showinfo

   :Data type:
         options[0,1]

   :Description:
         Show info:Values: 0 or 1. The parameter's default value is 1. If you set the parameter value to 0, then the player will not display information like the video title and uploader before the video starts playing.

   :Default:
         1


 - :Property:
         defaultPlayerParameters.controls

   :Data type:
         options[0,1,2]

   :Description:
         Controls: Values: 0, 1, or 2. Default is 1. This parameter indicates whether the video player controls will display

   :Default:
         1


 - :Property:
         defaultPlayerParameters.modestbranding

   :Data type:
         options[0,1]

   :Description:
         Modest branding: This parameter lets you use a YouTube player that does not show a YouTube logo. Set the parameter value to 1 to prevent the YouTube logo from displaying in the control bar.

   :Default:
         0


 - :Property:
         defaultPlayerParameters.color

   :Data type:
         options[red,white]

   :Description:
         Color: Valid parameter values are red and white.

   :Default:
         red


.. ###### END~OF~TABLE ######

[tsref:plugin.tx\_jhsimpleyoutube.settings]


For more information about the defaultPlayerParameters please visit https://developers.google.com/youtube/player_parameters#Parameters

.. tip::

	To use another value than the default one set by Constant Editor, just add the parameter with the new value to the custom parameters of the content element.