/**
 * jquery Tocify - v1.9.0 - 2013-10-01
 * http://www.gregfranko.com/jquery.tocify.js/
 * Copyright (c) 2013 Greg Franko;
 * Copyright (c) ppy Pty Ltd <contact@ppy.sh>;
 * Licensed MIT */
import 'jquery-ui/ui/widget';

/* globals $, document, window */
var tocClassName = 'tocify';
var tocFocusClassName = 'tocify-focus';
var tocHoverClassName = 'tocify-hover';
var hideTocClassName = 'tocify-hide';
var headerClassName = 'tocify-header';
var headerClass = '.' + headerClassName;
var subheaderClassName = 'tocify-subheader';
var subheaderClass = '.' + subheaderClassName;
var itemClassName = 'tocify-item';
var itemClass = '.' + itemClassName;
var extendPageClassName = 'tocify-extend-page';
var extendPageClass = '.' + extendPageClassName;

// Calling the jQueryUI Widget Factory Method
$.widget('toc.tocify', {
  // _addCSSClasses
  // --------------
  //      Adds CSS classes to the newly generated table of contents HTML
  _addCSSClasses() {
    if (this.options.theme === 'jqueryui') {
      // If the user wants a jqueryUI theme
      this.focusClass = 'ui-state-default';
      this.hoverClass = 'ui-state-hover';
      // Adds the default styling to the dropdown list
      this.element.addClass('ui-widget').find('.toc-title').addClass('ui-widget-header').end().find('li').addClass('ui-widget-content');
    } else if (this.options.theme === 'bootstrap') {
      // If the user wants a twitterBootstrap theme
      this.element.find(headerClass + ',' + subheaderClass).addClass('nav nav-list');
      this.focusClass = 'active';
      // If a user does not want a prebuilt theme
    } else {
      // Adds more neutral classes (instead of jqueryui)
      this.focusClass = tocFocusClassName;
      this.hoverClass = tocHoverClassName;
    }

    // Maintains chainability
    return this;
  },

  // _appendSubheaders
  // ---------------
  //      Helps create the table of contents list by appending subheader elements
  _appendSubheaders(self, ul) {
    // The current element index
    var index = $(this).index(self.options.selectors);
    // Finds the previous header DOM element
    var previousHeader = $(self.options.selectors).eq(index - 1);
    var currentTagName = +$(this).prop('tagName').charAt(1);
    var previousTagName = +previousHeader.prop('tagName').charAt(1);

    if (currentTagName < previousTagName) {
      // If the current header DOM element is smaller than the previous header DOM element or the first subheader
      // Selects the last unordered list HTML found within the HTML element calling the plugin
      self.element.find(subheaderClass + '[data-tag=' + currentTagName + ']').last().append(self._nestElements($(this), index));
    } else if (currentTagName === previousTagName) {
      // If the current header DOM element is the same type of header(eg. h4) as the previous header DOM element
      ul.find(itemClass).last().after(self._nestElements($(this), index));
    } else {
      // Selects the last unordered list HTML found within the HTML element calling the plugin
      ul.find(itemClass).last().
        // Appends an unorderedList HTML element to the dynamic `unorderedList` variable and sets a common class name
        after($('<ul/>', {
          class: subheaderClassName,
          'data-tag': currentTagName,
        })).next(subheaderClass).
        // Appends a list item HTML element to the last unordered list HTML element found within the HTML element calling the plugin
        append(self._nestElements($(this), index));
    }
  },

  // _Create
  // -------
  //      Constructs the plugin.  Only called once.
  _create() {
    var self = this;
    self.extendPageScroll = true;
    // Internal array that keeps track of all TOC items (Helps to recognize if there are duplicate TOC item strings)
    self.items = [];
    // Generates the HTML for the dynamic table of contents
    self._generateToc();
    // Adds CSS classes to the newly generated table of contents HTML
    self._addCSSClasses();
    self.webkit = (function() {
      for (var prop in window) {
        if (prop) {
          if (prop.toLowerCase().indexOf('webkit') !== -1) {
            return true;
          }
        }
      }

      return false;
    }());

    // Adds jQuery event handlers to the newly generated table of contents
    self._setEventHandlers();

    // Binding to the Window load event to make sure the correct scrollTop is calculated
    $(window).on('load', function() {
      // Sets the active TOC item
      self._setActiveElement(true);
      // Once all animations on the page are complete, this callback function will be called
      $('html, body').promise().done(function() {
        setTimeout(function() {
          self.extendPageScroll = false;
        }, 0);
      });
    });
  },

  // _generateHashValue
  // ------------------
  //      Generates the hash value that will be used to refer to each item.
  _generateHashValue(arr, self, index) {
    var hashValue = '';
    var hashGeneratorOption = this.options.hashGenerator;

    if (hashGeneratorOption === 'pretty') {
      // prettify the text
      hashValue = self.text().toLowerCase().replace(/\s/g, '-');
      // fix double hyphens
      while (hashValue.indexOf('--') > -1) {
        hashValue = hashValue.replace(/--/g, '-');
      }
      // fix colon-space instances
      while (hashValue.indexOf(':-') > -1) {
        hashValue = hashValue.replace(/:-/g, '-');
      }
    } else if (typeof hashGeneratorOption === 'function') {
      // call the function
      hashValue = hashGeneratorOption(self.text(), self);
    } else {
      // compact - the default
      hashValue = self.text().replace(/\s/g, '');
    }

    // add the index if we need to
    if (arr.length) {
      hashValue += '' + index;
    }

    // return the value
    return hashValue;
  },

  // _generateToc
  // ------------
  //      Generates the HTML for the dynamic table of contents
  _generateToc() {
    // Stores the plugin context in the self variable
    var self = this;
    // All of the HTML tags found within the context provided (i.e. body) that match the top level jQuery selector above
    var $firstElems;
    // Instantiated variable that will store the top level newly created unordered list DOM element
    var ul;
    var ignoreSelector = self.options.ignoreSelector;
    // If the selectors option has a comma within the string
    if (this.options.selectors.indexOf(',') !== -1) {
      // Grabs the first selector from the string
      $firstElems = $(this.options.context).find(this.options.selectors.replace(/ /g, '').substr(0, this.options.selectors.indexOf(',')));
    } else {
      // If the selectors option does not have a comma within the string
      // Grabs the first selector from the string and makes sure there are no spaces
      $firstElems = $(this.options.context).find(this.options.selectors.replace(/ /g, ''));
    }

    if (!$firstElems.length) {
      self.element.addClass(hideTocClassName);
      return;
    }

    self.element.addClass(tocClassName);

    // Loops through each top level selector
    $firstElems.each(function(index, firstElem) {
      const $firstElem = $(firstElem);

      // If the element matches the ignoreSelector then we skip it
      if ($firstElem.is(ignoreSelector)) {
        return;
      }

      // Creates an unordered list HTML element and adds a dynamic ID and standard class name
      ul = $('<ul/>', {
        class: headerClassName,
        id: headerClassName + index,
      }).
        // Appends a top level list item HTML element to the previously created HTML header
        append(self._nestElements($firstElem, index));

      // Add the created unordered list element to the HTML element calling the plugin
      self.element.append(ul);

      // Finds all of the HTML tags between the header and subheader elements
      $firstElem.nextUntil(firstElem.nodeName.toLowerCase()).each(function(_idx, el) {
        const $el = $(el);
        // If there are no nested subheader elemements
        if ($el.find(self.options.selectors).length === 0) {
          // Loops through all of the subheader elements
          $el.filter(self.options.selectors).each(function(__idx, subheader) {
            // If the element matches the ignoreSelector then we skip it
            if ($(subheader).is(ignoreSelector)) {
              return;
            }

            self._appendSubheaders.call(subheader, self, ul);
          });
        } else {
          // If there are nested subheader elements
          // Loops through all of the subheader elements
          $el.find(self.options.selectors).each(function(__idx, subheader) {
            // If the element matches the ignoreSelector then we skip it
            if ($(subheader).is(ignoreSelector)) {
              return;
            }

            self._appendSubheaders.call(subheader, self, ul);
          });
        }
      });
    });
  },

  // _nestElements
  // -------------
  //      Helps create the table of contents list by appending nested list items
  _nestElements(self, index) {
    var arr; var item; var hashValue;

    arr = $.grep(this.items, function(i) {
      return i === self.text();
    });

    if (arr.length) {
      // If there is already a duplicate TOC item
      // Adds the current TOC item text and index (for slight randomization) to the internal array
      this.items.push(self.text() + index);
    } else {
      // If there not a duplicate TOC item
      // Adds the current TOC item text to the internal array
      this.items.push(self.text());
    }

    hashValue = this._generateHashValue(arr, self, index);

    // Appends a list item HTML element to the last unordered list HTML element found within the HTML element calling the plugin
    item = $('<li/>', {
      // Sets a common class name to the list item
      class: itemClassName,
      'data-unique': hashValue,
    }).append($('<a/>', {
      text: self.text(),
    }));

    // Adds an HTML anchor tag before the currently traversed HTML element
    self.before($('<div/>', {
      'data-unique': hashValue,
      // Sets a name attribute on the anchor tag to the text of the currently traversed HTML element (also making sure that all whitespace is replaced with an underscore)
      name: hashValue,
    }));

    return item;
  },

  // _scrollTo
  // ---------
  //      Scrolls to a specific element
  _scrollTo(elem) {
    var self = this;
    var duration = self.options.smoothScroll || 0;
    var scrollTo = self.options.scrollTo;
    var currentDiv = $('div[data-unique="' + elem.attr('data-unique') + '"]');

    if (!currentDiv.length) {
      return self;
    }

    // Once all animations on the page are complete, this callback function will be called
    $('html, body').promise().done(function() {
      // Animates the html and body element scrolltops
      $('html, body').animate({
        // Sets the jQuery `scrollTop` to the top offset of the HTML div tag that matches the current list item's `data-unique` tag
        scrollTop: currentDiv.offset().top - ($.isFunction(scrollTo) ? scrollTo.call() : scrollTo) + 'px',
      }, {
        // Sets the smoothScroll animation time duration to the smoothScrollSpeed option
        duration,
      });
    });

    // Maintains chainability
    return self;
  },

  _setActiveElement(pageload) {
    var self = this;
    var hash = window.location.hash.substring(1);
    var elem = self.element.find('li[data-unique="' + hash + '"]');

    if (hash.length) {
      // Removes highlighting from all of the list item's
      self.element.find('.' + self.focusClass).removeClass(self.focusClass);
      // Highlights the current list item that was clicked
      elem.addClass(self.focusClass);

      if (self.options.showAndHide) {
        // If the showAndHide option is true
        // Triggers the click event on the currently focused TOC item
        elem.click();
      }
    } else {
      // Removes highlighting from all of the list item's
      self.element.find('.' + self.focusClass).removeClass(self.focusClass);

      if (!hash.length && pageload && self.options.highlightDefault) {
        // Highlights the first TOC item if no other items are highlighted
        self.element.find(itemClass).first().addClass(self.focusClass);
      }
    }

    return self;
  },

  // _setEventHandlers
  // ----------------
  //      Adds jQuery event handlers to the newly generated table of contents
  _setEventHandlers() {
    // Stores the plugin context in the self variable
    var self = this;

    // Event delegation that looks for any clicks on list item elements inside of the HTML element calling the plugin
    this.element.on('click.tocify', 'li', function(event) {
      const $target = $(event.currentTarget);

      if (self.options.history) {
        window.location.hash = $target.attr('data-unique');
      }

      // Removes highlighting from all of the list item's
      self.element.find('.' + self.focusClass).removeClass(self.focusClass);

      // Highlights the current list item that was clicked
      $target.addClass(self.focusClass);

      // If the showAndHide option is true
      if (self.options.showAndHide) {
        var elem = $('li[data-unique="' + $target.attr('data-unique') + '"]');
        self._triggerShow(elem);
      }
      self._scrollTo($target);
    });

    // Mouseenter and Mouseleave event handlers for the list item's within the HTML element calling the plugin
    this.element.find('li').on({
      // Mouseenter event handler
      'mouseenter.tocify'() {
        // Adds a hover CSS class to the current list item
        $(this).addClass(self.hoverClass);

        // Makes sure the cursor is set to the pointer icon
        $(this).css('cursor', 'pointer');
      },

      // Mouseleave event handler
      'mouseleave.tocify'() {
        if (self.options.theme !== 'bootstrap') {
          // Removes the hover CSS class from the current list item
          $(this).removeClass(self.hoverClass);
        }
      },
    });

    // only attach handler if needed (expensive in IE)
    if (self.options.extendPage || self.options.highlightOnScroll || self.options.scrollHistory || self.options.showAndHideOnScroll) {
      // Window scroll event handler
      $(window).on('scroll.tocify', function() {
        // Once all animations on the page are complete, this callback function will be called
        $('html, body').promise().done(function() {
          // Stores how far the user has scrolled
          var winScrollTop = $(window).scrollTop();
          // Stores the height of the window
          var winHeight = $(window).height();
          // Stores the height of the document
          var docHeight = $(document).height();
          var scrollHeight = $('body')[0].scrollHeight;
          // Instantiates a variable that will be used to hold a selected HTML element
          var elem;
          var lastElem;
          var lastElemOffset;
          var currentElem;

          if (self.options.extendPage) {

            // If the user has scrolled to the bottom of the page and the last toc item is not focused
            if ((self.webkit && winScrollTop >= scrollHeight - winHeight - self.options.extendPageOffset) || (!self.webkit && winHeight + winScrollTop > docHeight - self.options.extendPageOffset)) {
              if (!$(extendPageClass).length) {
                lastElem = $('div[data-unique="' + $(itemClass).last().attr('data-unique') + '"]');

                if (!lastElem.length) return;

                // Gets the top offset of the page header that is linked to the last toc item
                lastElemOffset = lastElem.offset().top;

                // Appends a div to the bottom of the page and sets the height to the difference of the window scrollTop and the last element's position top offset
                $(self.options.context).append($('<div />', {
                  class: extendPageClassName,
                  'data-unique': extendPageClassName,
                  height: Math.abs(lastElemOffset - winScrollTop) + 'px',
                }));

                if (self.extendPageScroll) {
                  currentElem = self.element.find('li.active');
                  self._scrollTo($('div[data-unique="' + currentElem.attr('data-unique') + '"]'));
                }
              }
            }
          }

          // The zero timeout ensures the following code is run after the scroll events
          setTimeout(function() {
            // Stores the distance to the closest anchor
            var closestAnchorDistance = null;
            // Stores the index of the closest anchor
            var closestAnchorIdx = null;
            // Keeps a reference to all anchors
            var anchors = $(self.options.context).find('div[data-unique]');
            var anchorText;

            // Determines the index of the closest anchor
            anchors.each(function(idx, el) {
              const $el = $(el);
              var distance = Math.abs(($el.next().length ? $el.next() : $el).offset().top - winScrollTop - self.options.highlightOffset);
              if (closestAnchorDistance == null || distance < closestAnchorDistance) {
                closestAnchorDistance = distance;
                closestAnchorIdx = idx;
              } else {
                return false;
              }
            });

            anchorText = $(anchors[closestAnchorIdx]).attr('data-unique');

            // Stores the list item HTML element that corresponds to the currently traversed anchor tag
            elem = $('li[data-unique="' + anchorText + '"]');

            // If the `highlightOnScroll` option is true and a next element is found
            if (self.options.highlightOnScroll && elem.length) {
              // Removes highlighting from all of the list item's
              self.element.find('.' + self.focusClass).removeClass(self.focusClass);

              // Highlights the corresponding list item
              elem.addClass(self.focusClass);
            }

            if (self.options.scrollHistory) {
              if (window.location.hash !== '#' + anchorText) {
                window.history.replaceState(null, '', '#' + anchorText);
              }
            }

            // If the `showAndHideOnScroll` option is true
            if (self.options.showAndHideOnScroll && self.options.showAndHide) {
              self._triggerShow(elem, true);
            }
          }, 0);
        });
      });
    }
  },

  // _triggerShow
  // ------------
  //      Determines what elements get shown on scroll and click
  _triggerShow(elem, scroll) {
    var self = this;

    if (elem.parent().is(headerClass) || elem.next().is(subheaderClass)) {
      // If the current element's parent is a header element or the next element is a nested subheader element
      // Shows the next sub-header element
      self.show(elem.next(subheaderClass), scroll);
    } else if (elem.parent().is(subheaderClass)) {
      // If the current element's parent is a subheader element
      // Shows the parent sub-header element
      self.show(elem.parent(), scroll);
    }

    // Maintains chainability
    return self;
  },

  // Hide
  // ----
  //      Closes the current sub-header
  hide(elem) {
    // Stores the plugin context in the `self` variable
    var self = this;

    // Determines what jQuery effect to use
    switch (self.options.hideEffect) {
      // Uses `no effect`
      case 'none':
        elem.hide();
        break;
      // Uses the jQuery `hide` special effect
      case 'hide':
        elem.hide(self.options.hideEffectSpeed);
        break;
      // Uses the jQuery `slideUp` special effect
      case 'slideUp':
        elem.slideUp(self.options.hideEffectSpeed);
        break;
      // Uses the jQuery `fadeOut` special effect
      case 'fadeOut':
        elem.fadeOut(self.options.hideEffectSpeed);
        break;
      // If none of the above options were passed, then a `jqueryUI hide effect` is expected
      default:
        elem.hide();
        break;
    }

    // Maintains chainablity
    return self;
  },

  // These options will be used as defaults
  options: {

    // **context**: Accepts String: Any jQuery selector
    // The container element that holds all of the elements used to generate the table of contents
    context: 'body',

    // **extendPage**: Accepts a boolean: true or false
    // If a user scrolls to the bottom of the page and the page is not tall enough to scroll to the last table of contents item, then the page height is increased
    extendPage: true,

    // **extendPageOffset**: Accepts a number: pixels
    // How close to the bottom of the page a user must scroll before the page is extended
    extendPageOffset: 100,

    // **hashGenerator**: How the hash value (the anchor segment of the URL, following the
    // # character) will be generated.
    //
    // "compact" (default) - #CompressesEverythingTogether
    // "pretty" - #looks-like-a-nice-url-and-is-easily-readable
    // function(text, element){} - Your own hash generation function that accepts the text as an
    // argument, and returns the hash value.
    hashGenerator: 'compact',

    // **hideEffect**: Accepts String: "none", "fadeOut", "hide", or "slideUp"
    // Used to hide any of the table of contents nested items
    hideEffect: 'slideUp',

    // **hideEffectSpeed**: Accepts Number (milliseconds) or String: "slow", "medium", or "fast"
    // The time duration of the hide animation
    hideEffectSpeed: 'medium',

    // **highlightDefault**: Accepts a boolean: true or false
    // Set's the first TOC item as active if no other TOC item is active.
    highlightDefault: true,

    // **highlightOffset**: Accepts a number
    // The offset distance in pixels to trigger the next active table of contents item
    highlightOffset: 40,

    // **highlightOnScroll**: Accepts a boolean: true or false
    // Determines if table of contents nested items should be highlighted (set to a different color) while scrolling
    highlightOnScroll: true,

    // **history**: Accepts a boolean: true or false
    // Adds a hash to the page url to maintain history
    history: true,

    // **ignoreSelector**: Accepts String: Any jQuery selector
    // A selector to any element that would be matched by selectors that you wish to be ignored
    ignoreSelector: null,

    // **scrollHistory**: Accepts a boolean: true or false
    // Adds a hash to the page url, to maintain history, when scrolling to a TOC item
    scrollHistory: false,

    // **scrollTo**: Accepts Number (pixels)
    // The amount of space between the top of page and the selected table of contents item after the page has been scrolled
    scrollTo: 0,

    // **selectors**: Accepts an Array of Strings: Any jQuery selectors
    // The element's used to generate the table of contents.  The order is very important since it will determine the table of content's nesting structure
    selectors: 'h1, h2, h3',

    // **showAndHide**: Accepts a boolean: true or false
    // Used to determine if elements should be shown and hidden
    showAndHide: true,

    // **showAndHideOnScroll**: Accepts a boolean: true or false
    // Determines if table of contents nested items should be shown and hidden while scrolling
    showAndHideOnScroll: true,

    // **showEffect**: Accepts String: "none", "fadeIn", "show", or "slideDown"
    // Used to display any of the table of contents nested items
    showEffect: 'slideDown',

    // **showEffectSpeed**: Accepts Number (milliseconds) or String: "slow", "medium", or "fast"
    // The time duration of the show animation
    showEffectSpeed: 'medium',

    // **smoothScroll**: Accepts a boolean: true or false
    // Determines if a jQuery animation should be used to scroll to specific table of contents items on the page
    smoothScroll: true,

    // **smoothScrollSpeed**: Accepts Number (milliseconds) or String: "slow", "medium", or "fast"
    // The time duration of the smoothScroll animation
    smoothScrollSpeed: 'medium',

    // **theme**: Accepts a string: "bootstrap", "jqueryui", or "none"
    // Determines if Twitter Bootstrap, jQueryUI, or Tocify classes should be added to the table of contents
    theme: 'bootstrap',
  },

  // setOption
  // ---------
  //      Sets a single Tocify option after the plugin is invoked
  setOption() {
    // Calls the jQueryUI Widget Factory setOption method
    $.Widget.prototype._setOption.apply(this, arguments);
  },

  // setOptions
  // ----------
  //      Sets a single or multiple Tocify options after the plugin is invoked
  setOptions() {
    // Calls the jQueryUI Widget Factory setOptions method
    $.Widget.prototype._setOptions.apply(this, arguments);
  },

  // Show
  // ----
  //      Opens the current sub-header
  show(elem) {
    // Stores the plugin context in the `self` variable
    var self = this;

    // If the sub-header is not already visible
    if (!elem.is(':visible')) {

      if (!elem.find(subheaderClass).length && !elem.parent().is(headerClass) && !elem.parent().is(':visible')) {
        // If the current element does not have any nested subheaders, is not a header, and its parent is not visible
        // Sets the current element to all of the subheaders within the current header
        elem = elem.parents(subheaderClass).add(elem);
      } else if (!elem.children(subheaderClass).length && !elem.parent().is(headerClass)) {
        // If the current element does not have any nested subheaders and is not a header
        // Sets the current element to the closest subheader
        elem = elem.closest(subheaderClass);
      }

      // Determines what jQuery effect to use
      switch (self.options.showEffect) {
        // Uses `no effect`
        case 'none':
          elem.show();
          break;
        // Uses the jQuery `show` special effect
        case 'show':
          elem.show(self.options.showEffectSpeed);
          break;
        // Uses the jQuery `slideDown` special effect
        case 'slideDown':
          elem.slideDown(self.options.showEffectSpeed);
          break;
        // Uses the jQuery `fadeIn` special effect
        case 'fadeIn':
          elem.fadeIn(self.options.showEffectSpeed);
          break;
        // If none of the above options were passed, then a `jQueryUI show effect` is expected
        default:
          elem.show();
          break;
      }

    }

    if (elem.parent().is(headerClass)) {
      // If the current subheader parent element is a header
      // Hides all non-active sub-headers
      self.hide($(subheaderClass).not(elem));
    } else {
      // If the current subheader parent element is not a header
      // Hides all non-active sub-headers
      self.hide($(subheaderClass).not(elem.closest(headerClass).find(subheaderClass).not(elem.siblings())));
    }

    // Maintains chainablity
    return self;
  },

  // Plugin version
  version: '1.9.0',
});
