.. include:: ../Includes.txt


Changelog
=========

All changes are documented on `http://forge.typo3.org/projects/extension-powermail <http://forge.typo3.org/projects/extension-powermail>`_


.. t3-field-list-table::
 :header-rows: 1

 - :Version:
      Version
   :Date:
      Release Date
   :Changes:
      Release Description

 - :Version:
      2.12.1
   :Date:
      2015-10-13
   :Changes:

      * Bugfix _`#70496`: https://forge.typo3.org/issues/70496 Make upload folder handling more robust
      * Bugfix _`#70491`: https://forge.typo3.org/issues/70491 plugin.tx_powermail.settings.setup.sender.email does not replace errorinemail@tryagain.com anymore [regression bug]
      * Bugfix _`#70446`: https://forge.typo3.org/issues/70446 Captcha-fields should be marked as required
      * Bugfix _`#70388`: https://forge.typo3.org/issues/70388 Maximum function nesting level reached
      * Bugfix _`#69976`: https://forge.typo3.org/issues/70388 Powermail crash after upgrading

 - :Version:
      2.12.0
   :Date:
      2015-10-05
   :Changes:

      * Task _`#66996`: https://forge.typo3.org/issues/66996 Remove variable $variablesMarkers from \In2code\Powermail\ViewHelpers\Misc\VariablesViewHelper::render()
      * Feature _`#70291`: https://forge.typo3.org/issues/70291 Do not use 'Powermail' as default mail name for "Sender"
      * Bugfix _`#70237`: https://forge.typo3.org/issues/70237 Wrong order for templateRootPaths
      * Bugfix _`#70215`: https://forge.typo3.org/issues/70215 Signal/Slots not working from 2.6.0 and above

 - :Version:
      2.11.2
   :Date:
      2015-09-22
   :Changes:

      * Bugfix _`#70075`: https://forge.typo3.org/issues/70075 saveSession Error
      * Bugfix _`#70048`: https://forge.typo3.org/issues/70048 Unique validator doesn't respect plugin settings
      * Bugfix _`#69998`: https://forge.typo3.org/issues/69998 Multiple Double Opt-In on the same page
      * Bugfix _`#69806`: https://forge.typo3.org/issues/69806 Remove head tag from HTML mail template

 - :Version:
      2.11.1
   :Date:
      2015-09-22
   :Changes:

      * Bugfix _`#70022`: https://forge.typo3.org/issues/70022 User gets ask about his location - even without location field in powermail 2.11.0

 - :Version:
      2.11.0
   :Date:
      2015-09-21
   :Changes:

      * Task _`#69992`: https://forge.typo3.org/issues/69992 Using of templateRootPaths (+ Partial + Layout) per default
      * Task _`#69873`: https://forge.typo3.org/issues/69873 Update parsley.js to 2.1.3
      * Feature _`#69870`: https://forge.typo3.org/issues/69870 Backend List: Select lines and delete, hide, unhide
      * Bugfix _`#69950`: https://forge.typo3.org/issues/69950 $ instead of jQuery in form.js
      * Bugfix _`#69911`: https://forge.typo3.org/issues/69911 $ Links in Plaintext Mails are broken

 - :Version:
      2.10.1
   :Date:
      2015-09-15
   :Changes:

      * Task _`#69582`: https://forge.typo3.org/issues/69582
      * Bugfix _`#69803`: https://forge.typo3.org/issues/69803
      * Bugfix _`#69783`: https://forge.typo3.org/issues/69783

 - :Version:
      2.10.0
   :Date:
      2015-09-05
   :Changes:

      * Feature #69494
      * Bugfix #69492, #69469

      See http://forge.typo3.org for Details

 - :Version:
      2.9.0
   :Date:
      2015-09-01
   :Changes:

      * Feature #69424, #69338
      * Bugfix #69425, #69366, #69323, #69146

      See http://forge.typo3.org for Details

 - :Version:
      2.8.0
   :Date:
      2015-08-25
   :Changes:

      * Feature #68999
      * Bugfix #69189

      See http://forge.typo3.org for Details

 - :Version:
      2.7.1
   :Date:
      2015-08-18
   :Changes:
      Fix: Changelog in manual could not be parsed from TER

 - :Version:
      2.7.0
   :Date:
      2015-08-18
   :Changes:
      Bugfix #69016, #69029, #69066, #69127

      See http://forge.typo3.org for Details

      Note: Changed Template/Partial-files:

      * New Partial: EXT:powermail/Resources/Private/Partials/Output/EditHidden.html
      * Changed Partial: EXT:powermail/Resources/Private/Partials/Form/Captcha.html
      * Changed Template: EXT:powermail/Resources/Private/Templates/Output/Edit.html

 - :Version:
      2.6.3
   :Date:
      2015-08-12
   :Changes:
      Bugfix #68977, #68842, #68716

      See http://forge.typo3.org for Details

 - :Version:
      2.6.2
   :Date:
      2015-08-06
   :Changes:
      Bugfix #68794 - Fix for TYPO3 7.4

      See http://forge.typo3.org for Details

 - :Version:
      2.6.1
   :Date:
      2015-08-04
   :Changes:
      Bugfix #68710

      See http://forge.typo3.org for Details

 - :Version:
      2.6.0
   :Date:
      2015-08-03
   :Changes:
      Bugfix #68696, #68647, #68587, #68583, #68576

      Feature #68695

      See http://forge.typo3.org for Details


      Note: Changes in Partial-files:

      * EXT:powermail/Resources/Private/Partials/Form/Check.html
      * EXT:powermail/Resources/Private/Partials/Form/Radio.html

 - :Version:
      2.5.2
   :Date:
      2015-07-24
   :Changes:
      Bugfix #68490, #68414, #68375

      See http://forge.typo3.org for Details

 - :Version:
      2.5.1
   :Date:
      2015-07-16
   :Changes:
      Bugfix #39218, #68044

      Task #68236, #68237

      See http://forge.typo3.org for Details

 - :Version:
      2.5.0
   :Date:
      2015-07-05
   :Changes:
      Bugfix #67872, #67660

      Feature #67392

      Task #67796

      See http://forge.typo3.org for Details

 - :Version:
      2.4.4
   :Date:
      2015-06-22
   :Changes:
      Bugfix #67448, #67548, #67555, #67623

      See http://forge.typo3.org for Details

 - :Version:
      2.4.3
   :Date:
      2015-06-07
   :Changes:
      Bugfix #67157, #67167, #67194, #67255

      See http://forge.typo3.org for Details

 - :Version:
      2.4.2
   :Date:
      2015-05-24
   :Changes:
      Bugfix #67112, #67108, #67102, #67039, #67035

      See http://forge.typo3.org for Details

 - :Version:
      2.4.1
   :Date:
      2015-05-18
   :Changes:
      Bugfix #67003

      See http://forge.typo3.org for Details

 - :Version:
      2.4.0
   :Date:
      2015-05-17
   :Changes:
      Bugfix #66914, #65366

      Features #65716, #65226

      See http://forge.typo3.org for Details

 - :Version:
      2.3.3
   :Date:
      2015-05-08
   :Changes:
      Bugfix #66634, #66732

      See http://forge.typo3.org for Details

 - :Version:
      2.3.2
   :Date:
      2015-04-27
   :Changes:
      Bugfix #66571, #66562, #65481

      See http://forge.typo3.org for Details

 - :Version:
      2.3.1
   :Date:
      2015-04-19
   :Changes:
      Bugfix #66462, #66469, #66470, #66471

      See http://forge.typo3.org for Details

 - :Version:
      2.3.0
   :Date:
      2015-04-17
   :Changes:
      Bugfix #65716, #65635, #65942, #66026

      Feature #66359

      Task #65993

      See http://forge.typo3.org for Details

 - :Version:
      2.2.0
   :Date:
      2015-02-27
   :Changes:
      Updated powermail for TYPO3 6.2, 7.0 and 7.1

 - :Version:
      2.1.17
   :Date:
      2015-02-27
   :Changes:
      Bugfix #65222, #65258, #65263

      See http://forge.typo3.org for Details

 - :Version:
      2.1.16
   :Date:
      2015-02-21
   :Changes:
      Bugfix #65201, #65174, #65173, #64992

      See http://forge.typo3.org for Details

 - :Version:
      2.1.15
   :Date:
      2015-02-09
   :Changes:
      Bugfix #64779, #64937

      See http://forge.typo3.org for Details

 - :Version:
      2.1.14
   :Date:
      2015-02-01
   :Changes:
      Bugfix #64685, #64625, #64564, #64545, #64426, #64424, #64412

      Feature #64594, #64533

      See http://forge.typo3.org for Details

 - :Version:
      2.1.13
   :Date:
      2015-01-19
   :Changes:
      Bugfix #64236, #64250, #64352

      Feature #64279

      See http://forge.typo3.org for Details

 - :Version:
      2.1.12
   :Date:
      2015-01-11
   :Changes:
      Bugfix #64220, #64111

      Feature #64212, #64195

      See http://forge.typo3.org for Details

 - :Version:
      2.1.11
   :Date:
      2014-12-23
   :Changes:
      Bugfix update #63972, #63933, #63797, #63796, #63766, #43502

      Task #64019 Remove Google Image Charts

      See http://forge.typo3.org for Details

 - :Version:
      2.1.10
   :Date:
      2014-12-11
   :Changes:
      Bugfix update #63765, #63724

      Feature #63707, #63404, #63397, #63365, #63149

      See http://forge.typo3.org for Details

 - :Version:
      2.1.9
   :Date:
      2014-11-26
   :Changes:
      Bugfix update #63329, #63152, #63118, #63046, #63028, #63020, #62920

      Feature #63322, #63317, #63302, #63297

      See http://forge.typo3.org for Details

 - :Version:
      2.1.8
   :Date:
      2014-11-13
   :Changes:
      Bugfix update #62761, #62146, #62919

      Feature #62728, #62653

      See http://forge.typo3.org for Details

 - :Version:
      2.1.7
   :Date:
      2014-10-31
   :Changes:
      Bugfix update #62583

      Task #62584

      See http://forge.typo3.org for Details

 - :Version:
      2.1.6
   :Date:
      2014-10-30
   :Changes:
      Bugfix updates #54306, #62485, #62531

      Feature updates #62262, #62433, #62434, #62469, #62535

      See http://forge.typo3.org for Details

 - :Version:
      2.1.5
   :Date:
      2014-10-18
   :Changes:
      Bugfix updates #62058, #62097, #62135

      Feature updates #62262, #60504 (Templa Voila with Form Converter)

      See http://forge.typo3.org for Details

 - :Version:
      2.1.4
   :Date:
      2014-10-06
   :Changes:
      Bugfix update #62048

      See http://forge.typo3.org for Details

 - :Version:
      2.1.3
   :Date:
      2014-10-05
   :Changes:
      Bugfix updates #61987, #61803, #61681, #61118, #61956

      See http://forge.typo3.org for Details

 - :Version:
      2.1.2
   :Date:
      2014-09-17
   :Changes:
      Bugfix updates #61657, #61658

      See http://forge.typo3.org for Details

 - :Version:
      2.1.1
   :Date:
      2014-09-15
   :Changes:
      Bugfix updates #61530, #61533, #61536, #61537, #61551

      Feature updates #61532, #61553, #61583

      See http://forge.typo3.org for Details

 - :Version:
      2.1.0
   :Date:
      2014-09-10
   :Changes:
      Refactored Powermail 2 extension with a lot of usability improvements, a powermail 1.x formconverter and a lot of new cool stuff. See forge.typo3.org for details. We're looking forward for your feedback. Thank to the universities, who sponsored this version!

      See http://forge.typo3.org for Details

 - :Version:
      2.0.18
   :Date:
      2014-09-17
   :Changes:
      Small Bugfix updates

      See http://forge.typo3.org for Details

 - :Version:
      2.0.17
   :Date:
      2014-09-05
   :Changes:
      Small Bugfix updates

      See http://forge.typo3.org for Details

 - :Version:
      2.0.16
   :Date:
      2014-06-26
   :Changes:
      Bugfix updates #59902, #54648, #53786

      Feature updates #59395

      See http://forge.typo3.org for Details

 - :Version:
      2.0.15
   :Date:
      2014-05-26
   :Changes:
      Bugfix updates #58389, #58114, #57963, #56273, #56117

      See http://forge.typo3.org for Details

 - :Version:
      2.0.14
   :Date:
      2014-05-22
   :Changes:
      Security fix. Please update!

      See TYPO3-EXT-SA-2014-007

 - :Version:
      2.0.13
   :Date:
      2014-04-12
   :Changes:
      Bugfix updates #57858, #56198, #54896

      Feature updates #56049

      See http://forge.typo3.org for Details

 - :Version:
      2.0.12
   :Date:
      2014-04-11
   :Changes:
      TYPO3 6.2 update

      Bugfix updates #57804, #57480, ##57337, #56273

      See http://forge.typo3.org for Details

 - :Version:
      2.0.11
   :Date:
      2014-04-10
   :Changes:
      Security fix. Please update!

      See TYPO3-EXT-SA-2014-006

 - :Version:
      2.0.10
   :Date:
      2013-10-11
   :Changes:
      Bugfix update (small)

      - 5 Features

      - 9 Bugfixes

      **Breaking changes** in

      - Resources/Private/Partials/PowermailAll/Mail.html

      - Breaking Change in Resources/Private/Partials/PowermailAll/Web.html

      - Breaking Change in Resources/Private/Templates/Forms/PowermailAll.html

      See http://forge.typo3.org for Details

 - :Version:
      2.0.9
   :Date:
      2013-07-06
   :Changes:
      1 Task

      3 Bugfix updates

      See http://forge.typo3.org for Details

 - :Version:
      2.0.8
   :Date:
      2013-07-04
   :Changes:
      15 New Features

      7 Bugfix updates

      See http://forge.typo3.org for Details

 - :Version:
      2.0.7
   :Date:
      2013-06-03
   :Changes:
      Security fix. Please update!

      See TYPO3-EXT-SA-2013-006

 - :Version:
      2.0.6
   :Date:
      2013-04-01
   :Changes:
      1 New Feature

      5 Bugfix updates

      See http://forge.typo3.org for Details

 - :Version:
      2.0.5
   :Date:
      2012-12-08
   :Changes:
      4 New Feature

      11 Bugfix updates

      See http://forge.typo3.org for Details

 - :Version:
      2.0.4
   :Date:
      2012-10-29
   :Changes:
      2 New Feature

      4 Bugfix updates

      See http://forge.typo3.org for Details

 - :Version:
      2.0.3
   :Date:
      2012-10-17
   :Changes:
      7 New Feature

      10 Bugfix updates

      See http://forge.typo3.org for Details

 - :Version:
      2.0.2
   :Date:
      2012-08-19
   :Changes:
      5 New Feature

      17 Bugfix updates

      See http://forge.typo3.org for Details

 - :Version:
      2.0.1
   :Date:
      2012-08-08
   :Changes:
      Different Security Fixes

 - :Version:
      2.0.0
   :Date:
      2012-05-21
   :Changes:
      Initial upload

      - Complete Redesign of the old powermail 1.x
      - Redesign with Extbase and Fluid
      - Focus on Marketing and Spam-Prevention
      - Keep Flexibility
