// Xsolla Paybar Widget
if (typeof(XPBWidget) == 'undefined')
{
    var xpbMessages =
    {
        paystation: {ru: 'PayStation', en: 'PayStation'},
        show_more: {ru: 'Показать еще', en: 'Show more'},
        previous: {ru: '&larr;', en: '&larr;'},
        next: {ru: '&rarr;', en: '&rarr;'}
    };

    var XPBWidget =
    {
        __defaultHost: 'https://secure.xsolla.com',
        __pluginDir: '/paybar/jswidget/',
        __pluginUrl: false,
        __apiScript: '/paybar/api/api.php',
        __apiUrl: false,
        __apiParams: ['project', 'v0', 'v1', 'v2', 'v3', 'out', 'currency', 'email', 'phone', 'icon_set', 'local', 'country', 'marketplace', 'mobile', 'hidden'],
        __options: {element_id: 'paybar', type: {id: 'lightbox'}, css: 'default.css', messages: {}, template: { id: 'inline' },
                    project: null, v0: null, v1: null, v2: null, v3: null, out: null, currency: null, email: null, phone: null, icon_set: 1, local: null, country: null, marketplace: 16, mobile: null, hidden: null,
                    icon_count: null, other: null, other_count: null, // Deprecated
                    errorCallback: null, doneCallback: null,
                    itemTemplate: '<span><a href="%HREF%" target="_blank"><img src="%ICON_SRC%" />%NAME%</a></span>'},
        __initialized: false,
        __loaded: false,
        __element: false,
        __templateParams: null,
        __controller: null,
        __jqXHR: null,

        init: function(options)
        {
            var self = this;
            for(index in this.__options) if(typeof(options[index]) != 'undefined' && options[index] !== null) this.__options[index] = options[index];

            if(typeof(options.scripthost) != 'undefined' && options.scripthost)
            {
                this.__pluginUrl = options.scripthost + this.__pluginDir;
                this.__apiUrl = options.scripthost + this.__apiScript;
            }
            else
            {
                this.__pluginUrl = this.__defaultHost + this.__pluginDir;
                this.__apiUrl = this.__defaultHost + this.__apiScript;
            }

            if(this.__initialized)
            {
                if(this.__jqXHR) this.__jqXHR.abort();

                if(this.__loaded) self.initWidget();
                else self.loadRequired();
            }
            else
            {
                DOMReady.add(function()
                {
                    self.loadRequired();
                });

                this.__initialized = true;
            }
            return this;
        },

        loadRequired: function()
        {
            var self = this;
            var scripts = [];
            var isJqueryRequired = false;
            if(!window.jQuery) { scripts[scripts.length] = this.__pluginUrl + 'js/jquery-1.7.2.min.js'; isJqueryRequired = true; }

            var loader = new XLoader();

            loader.requireScript
            (scripts, function()
            {
                if(isJqueryRequired) jQuery.noConflict();
                self.loadRequired2();
            });
        },

        loadRequired2: function()
        {
            var self = this;
            var loader = new XLoader();

            loader.loadStyle
            ([
                this.__pluginUrl + 'css/fancybox/jquery.fancybox-1.3.4.css',
                this.__pluginUrl + 'css/' + this.__options['css']
            ]);

            loader.requireScript
            ([
                this.__pluginUrl + 'js/jquery.mousewheel-3.0.4.pack.js',
                // this.__pluginUrl + 'js/jquery.fancybox-1.3.4.pack.js'
            ], function()
            {
                self.initWidget();
            });
        },

        initWidget: function()
        {
            this.__loaded = true;

            this.__element = typeof(this.__options['element_id']) == 'string' ? jQuery('#' + this.__options['element_id']) : jQuery(this.__options['element_id']);
            if(!this.__element.length) return;

            this.__element.addClass('xpb-widget').find('.xpb-payment-option, .xpb-container').remove();

            var options = this.__options['template'];
            switch(this.__options['template'].id)
            {
                default:
                case 'inline':
                {
                    this.__controller = new XPBInlineContoller();
                    if(this.__options['icon_count'] !== null) options['icon_count'] = this.__options['icon_count'];
                    if(this.__options['other'] !== null) options['other'] = this.__options['other'];
                } break;
                case 'show_more':
                {
                    this.__controller = new XPBShowMoreContoller();
                    if(this.__options['icon_count'] !== null) options['icon_count'] = this.__options['icon_count'];
                    if(this.__options['other_count'] !== null) options['other_count'] = this.__options['other_count'];
                } break;
                case 'slide':
                {
                    this.__controller = new XPBSlideContoller();
                    if(this.__options['icon_count'] !== null) options['icon_count'] = this.__options['icon_count'];
                } break;
            }
            this.__controller.run(this, options);
        },

        loadList: function(start, count, other, callback)
        {
            var self = this;

            var apiData = {};
            for(var i = 0; i < this.__apiParams.length; i++)
            {
                if(typeof(this.__options[this.__apiParams[i]]) != 'undefined' && this.__options[this.__apiParams[i]] !== null)
                {
                    var val = this.__options[this.__apiParams[i]];
                    if(val === true) val = '1'; else if(val === false) val = '0';
                    apiData[this.__apiParams[i]] = val;
                }
            }

            apiData['other'] = other ? '1' : '0';
            apiData['start'] = start;
            apiData['icon_count'] = count;

            this.__jqXHR = jQuery.ajax
            ({
                url: this.__apiUrl + '?callback=?',
                data: apiData,
                dataType: 'jsonp',
                cache: false
            }).done(function(response)
            {
                if(typeof(response.success) != 'undefined' && response.success && jQuery.isArray(response.data))
                {
                    var list = jQuery();
                    for(var i = 0; i < response.data.length; i++)
                    {
                        var item = response.data[i];
                        var isOther = typeof(item.other) != 'undefined' && item.other;
                        if (item.icon == "//static.xsolla.com/paymentoptions/paystation/theme_33/143x83/24.png") continue;
                        list = list.add(self.getListItem(item.name, isOther ? null : item.icon, item.href, { other: isOther } ));
                    }
                    var remaining = response.showMore;
                    callback(list, remaining);
                }
                else if(typeof(response.error) != 'undefined' && response.error)
                {
                    self.showFailOption();
                    self.errorHandler(response.error, 'api');
                }
            }).fail(function(jqXHR, textStatus)
            {
                self.showFailOption();
                self.errorHandler(textStatus, 'ajax');
            });
        },

        getListItem: function(name, icon, href, options)
        {
            var self = this;
            if(typeof(options) == 'undefined') options = {};
            options = jQuery.extend({
                id: null,
                className: null,
                other: false,
                blank: false,
                loading: false,
                fail: false,
                more: false
            }, options);

            var tpl = self.__options['itemTemplate'];
            tpl = tpl.replace('%NAME%', name ? name : '');
            tpl = tpl.replace('%ICON_SRC%', icon ? icon : this.__pluginUrl + 'img/blank.png');
            tpl = tpl.replace('%HREF%', href ? href : '#link');

            var option = jQuery(tpl);
            if(option.length > 1 || option.is('a')) option = jQuery('<span />').append(option);

            option.addClass('xpb-payment-option');
            if(options.other) { option.addClass('xpb-other-option'); }
            if(options.blank) { option.find('[href="#link"]').removeAttr('href'); option.addClass('xpb-blank-option'); }
            if(options.loading) { option.addClass('xpb-loading-option'); }
            if(options.fail) { option.addClass('xpb-fail-option'); }
            if(options.more) { option.addClass('xpb-more-option'); }
            if(options.id !== null) option.attr('id', options.id);
            if(options.className !== null) option.addClass(options.className);

            if(!jQuery.isPlainObject(self.__options['type'])) self.__options['type'] = {id: self.__options['type']};
            if(typeof(self.__options['type'].id) == 'undefined') self.__options['type'].id = null;

            if(self.__options['type'].id == 'lightbox' && !options.blank && !options.more)
            {
                option.find('a[href]').click(function()
                {
                    jQuery.fancybox
                    ({
                        'type': 'iframe',
                        'showCloseButton' : true,
                        'width': typeof(self.__options['type'].width) != 'undefined' ? self.__options['type'].width : '95%',
                        'height': typeof(self.__options['type'].height) != 'undefined' ? self.__options['type'].height : '95%',
                        'autoDimensions' : false,
                        'autoScale' : false,
                        'href': jQuery(this).attr('href'),
                        'opacity': 0.6,
                        'overlayColor': '#000',
                        'onCancel': function()
                        {
                        },
                        'onClosed': function()
                        {
                        },
                        onComplete: function()
                        {
                            jQuery('#fancybox-frame').load(function()
                            {
                                jQuery.fancybox.hideActivity();
                            });
                        }
                    });

                    jQuery.fancybox.showActivity();

                    return false;
                });
            }

            return option;
        },

        getElement: function()
        {
            return this.__element;
        },

        showFailOption: function()
        {
            this.__element.find('.xpb-payment-option.xpb-loading-option').removeClass('xpb-loading-option');
        },

        getTranslation: function(code)
        {
            var local = this.__options['local'] ? this.__options['local'] : 'en';
            if(typeof(this.__options['messages'][code]) != 'undefined' && typeof(this.__options['messages'][code][local]) != 'undefined') return this.__options['messages'][code][local];
            else return (typeof(xpbMessages[code][local]) != 'undefined' ? xpbMessages[code][local] : xpbMessages[code]['en']);
        },

        errorHandler: function(message, category)
        {
            if(typeof(this.__options['errorCallback']) === 'function') this.__options['errorCallback'](message, category);
            else if(message) console.log('Paybar: ' + message + ' at ' + category);
        },

        doneHandler: function()
        {
            if(typeof(this.__options['doneCallback']) === 'function') this.__options['doneCallback']();
        }
    };

    var XPBInlineContoller = function () {};
    XPBInlineContoller.prototype =
    {
        __widget: null,
        __options: { icon_count: 5, other: true },

        run: function(widget, options)
        {
            this.__widget = widget;
            for(index in this.__options) if(typeof(options[index]) != 'undefined' && options[index] !== null) this.__options[index] = options[index];

            this.__widget.getElement().find('.xpb-more-option').remove();
            for(var i = 0; i < this.__options['icon_count']; i++)
            {
                this.__widget.getElement().append(this.__widget.getListItem(null, null, null, { blank: true, loading: true } ));
            }

            this.__widget.loadList(0, this.__options['icon_count'], this.__options['other'], function(list, remaining)
            {
                widget.getElement().find('.xpb-loading-option').remove();
                widget.getElement().append(list);
                widget.doneHandler();
            });
        }
    };

    var XPBShowMoreContoller = function () {};
    XPBShowMoreContoller.prototype =
    {
        __widget: null,
        __options: { icon_count: 5, other_count: 5 },
        __showMore: null,

        run: function(widget, options)
        {
            this.__widget = widget;
            for(index in this.__options) if(typeof(options[index]) != 'undefined' && options[index] !== null) this.__options[index] = options[index];

            this.loadList();
        },

        loadList: function()
        {
            var self = this;
            var widget = this.__widget;
            var start = this.__widget.getElement().find('.xpb-payment-option:not(.xpb-blank-option):not(.xpb-more-option)').length;
            var count = start ? this.__options['other_count'] : this.__options['icon_count'];

            if(this.__showMore !== null) count = Math.min(this.__showMore, count);

            this.__widget.getElement().find('.xpb-more-option').remove();
            for(var i = 0; i < count; i++)
            {
                this.__widget.getElement().append(this.__widget.getListItem(null, null, null, { blank: true, loading: true } ));
            }

            this.__widget.loadList(start, count, false, function(list, remaining)
            {
                widget.getElement().find('.xpb-loading-option').remove();
                widget.getElement().append(list);
                if(remaining)
                {
                    self.__showMore = remaining;
                    widget.getElement().append(widget.getListItem(widget.getTranslation('show_more'), null, null, { more: true } ))
                                       .find('.xpb-more-option [href="#link"]').click(function(){ self.loadList(); return false; });
                }
                widget.doneHandler();
            });
        }
    };

    var XPBSlideContoller = function () {};
    XPBSlideContoller.prototype =
    {
        __widget: null,
        __options: { icon_count: 5, shift_count: 3, animation_speed: 200 },
        __loaded: 0,
        __listSize: 0,
        __container: null,
        __frame: null,
        __slider: null,
        __element: null,
        __itemWidth: null,

        run: function(widget, options)
        {
            this.__widget = widget;
            for(index in this.__options) if(typeof(options[index]) != 'undefined' && options[index] !== null) this.__options[index] = options[index];

            this.__element = this.__widget.getElement();
            this.__container = jQuery('<div />').addClass('xpb-container').hide().appendTo(this.__element);
            this.__frame = jQuery('<div />').addClass('xpb-frame').appendTo(this.__container);
            this.__slider = jQuery('<div />').addClass('xpb-slider').css({'left': 0, 'position': 'relative'}).appendTo(this.__frame);

            var self = this;

            var updateWidth = null;
            updateWidth = function()
            {
                self.detectWidth();
                //console.log('self.__itemWidth =', self.__itemWidth);
                if(self.__itemWidth > 5) self.arrangeElements();
                else setTimeout(updateWidth, 100);
            };
            updateWidth();
            jQuery(window).load(updateWidth);

            this.loadList();
        },

        arrangeElements: function()
        {
            var self = this;
            var width = self.__itemWidth * self.__options['icon_count'];
            self.__container.show().width(width);
            self.__frame.show().width(width);

            self.__container.append(jQuery('<a />').attr('href', '#prev').html(self.__widget.getTranslation('previous')).addClass('xpb-prev').click(function()
            {
                if(jQuery(this).is('.xpb-disabled')) return false;
                if(self.__slider.is(':animated')) return false;

                var left = parseInt(self.__slider.css('left'));
                var shift = self.__itemWidth * self.__options['shift_count'];
                self.__slider.animate
                (
                    {'left': Math.min(left + shift, 0)},
                    self.__options['animation_speed'],
                    function() { setTimeout(function() { self.updateButtons(); }, 1); }
                );

                self.updateButtons();
                return false;
            }));

            self.__container.append(jQuery('<a />').attr('href', '#next').html(self.__widget.getTranslation('next')).addClass('xpb-next').click(function()
            {
                if(jQuery(this).is('.xpb-disabled')) return false;
                if(self.__slider.is(':animated')) return false;

                var left = parseInt(self.__slider.css('left'));
                var shift = Math.min((self.__listSize - self.__options['icon_count']) * self.__itemWidth + left, self.__itemWidth * self.__options['shift_count']);

                self.__slider.animate
                (
                    {'left': left - shift},
                    self.__options['animation_speed'],
                    function() { setTimeout(function() { self.updateButtons(); }, 1); }
                );

                self.updateButtons();
                self.loadList();
                return false;
            }));

            self.updateButtons();
        },

        updateButtons: function()
        {
            var prev = this.__container.find('.xpb-prev');
            var next = this.__container.find('.xpb-next');

            if(!this.__loaded)
            {
                prev.addClass('xpb-disabled');
                next.addClass('xpb-disabled');
                return;
            }

            var left = parseInt(this.__slider.css('left'));
            //console.log('self.__listSize =', this.__listSize, 'left[items] =', -left / this.__itemWidth, left, (this.__listSize - this.__options['icon_count']) * this.__itemWidth);

            prev.toggleClass('xpb-disabled', left >= 0);
            next.toggleClass('xpb-disabled', left <= - (this.__listSize - this.__options['icon_count']) * this.__itemWidth);
        },

        loadList: function()
        {
            var self = this;
            var widget = this.__widget;
            var start = this.__widget.getElement().find('.xpb-payment-option').length;
            var count = (start ? self.__options['shift_count'] : this.__options['icon_count']) + self.__options['shift_count'];

            if(this.__loaded && (self.__listSize - start <= 0)) return;
            if(this.__loaded) count = Math.min(this.__listSize - start, count);

            var loadingList = jQuery([]);
            for(var i = 0; i < count; i++)
            {
                loadingList = loadingList.add(this.__widget.getListItem(null, null, null, { blank: true, loading: true } ));
            }
            this.__slider.append(loadingList);

            //console.log('loading from ', start, ' to', count, '(', this.__loaded, ')');
            this.__widget.loadList(start, count, false, function(list, remaining)
            {
                loadingList.replaceWith(list);
                self.__loaded += list.length;
                self.__listSize = start + list.length + remaining;

                self.updateButtons();

                widget.doneHandler();
            });
        },

        detectWidth: function()
        {
            var item = this.__widget.getListItem(null, null, null, { blank: true } ).hide().appendTo(this.__element);
            this.__itemWidth = item.width();
            item.remove();
        }
    };

    var XLoader = function () {};
    XLoader.prototype =
    {
        requireScript: function (scripts, callback)
        {
            this.loadCount      = 0;
            this.totalRequired  = scripts.length;
            this.callback       = callback;

            if(!scripts.length) { this.callback.call(); return ; }
            for (var i = 0; i < scripts.length; i++) this.appendScript(scripts[i]);
        },

        scriptLoaded: function (evt)
        {
            this.loadCount++;
            if (this.loadCount == this.totalRequired && typeof this.callback == 'function') this.callback.call();
        },

        appendScript: function (src)
        {
            var self = this;
            var jsEmbededTag = document.createElement('SCRIPT');
            jsEmbededTag.type = "text/javascript";
            jsEmbededTag.async = true;
            jsEmbededTag.src = src;

            if(jsEmbededTag.addEventListener)
            {
                jsEmbededTag.addEventListener('load', function (e) { self.scriptLoaded(e); }, false);
            }
            else if(jsEmbededTag.attachEvent)
            {
                jsEmbededTag.attachEvent ('onreadystatechange', function (e)
                {
                    if(jsEmbededTag.readyState == 'loaded' || jsEmbededTag.readyState == 'complete') self.scriptLoaded(e);
                }, false);
            }
            else
            {
                jsEmbededTag.onreadystatechange = function(e)
                {
                    if(jsEmbededTag.readyState == 'loaded' || jsEmbededTag.readyState == 'complete') self.scriptLoaded(e);
                };
            }

            var head = document.getElementsByTagName('HEAD')[0];
            head.appendChild(jsEmbededTag);
        },

        loadStyle: function (styles)
        {
            var head = document.getElementsByTagName('HEAD')[0];

            for(var i = 0; i < styles.length; i++)
            {
                if(!styles[i]) continue;
                var cssEmbededTag = document.createElement('LINK');
                cssEmbededTag.type = 'text/css';
                cssEmbededTag.rel = 'stylesheet';
                cssEmbededTag.href = styles[i];
                head.appendChild(cssEmbededTag);
            }
        }
    };

    (function (window) {
        window.DOMReady = (function () {
            var fns = [],
                isReady = false,
                errorHandler = null,
                run = function (fn, args) {
                    try {
                        fn.apply(this, args || []);
                    } catch(err) {
                        if (errorHandler)
                            errorHandler.call(this, err);
                    }
                },
                ready = function () {
                    isReady = true;
                    for (var x = 0; x < fns.length; x++)
                        run(fns[x].fn, fns[x].args || []);
                    fns = [];
                };

            this.setOnError = function (fn) {
                errorHandler = fn;
                return this;
            };

            this.add = function (fn, args) {
                if (isReady) {
                    run(fn, args);
                } else {
                    fns[fns.length] = {
                        fn: fn,
                        args: args
                    };
                }

                return this;
            };

            if (window.addEventListener) {
                window.document.addEventListener('DOMContentLoaded', function () { ready(); }, false);
            } else {
                (function(){
                    if (!window.document.uniqueID && window.document.expando)
                        return;
                    var tempNode = window.document.createElement('document:ready');
                    try {
                        tempNode.doScroll('left');
                        ready();
                    } catch (err) {
                        setTimeout(arguments.callee, 0);
                    }
                })();
            }
            return this;
        })();
    })(window);

}

function ucfirst(str)
{
    var f = str.charAt(0).toUpperCase();
    return f + str.toLowerCase().substr(1, str.length-1);
}

function getScriptHost(url)
{
    if(url.indexOf('http://')!=-1 || url.indexOf('https://')!=-1 || url.indexOf('//')==0)
    {
        var host = url.substr(0,url.indexOf('/',url.indexOf('/')+2));
        return host;
    }
    return false;
}

/*var scriptTag = document.getElementById('xsolla-paybar-widget');
var widgetParams = {};

if(scriptTag)
{
    var host = getScriptHost(scriptTag.src);
    if(host) widgetParams['scripthost'] = host;
}

if(scriptTag && scriptTag.src.indexOf('?')!=-1)
{
    scriptParams = scriptTag.src.split('?')[1].split('&');

    for (var i = 0; i < scriptParams.length; i++)
    {
        widgetParams[scriptParams[i].split('=')[0]] = unescape(scriptParams[i].split('=')[1]);
    }
}

XPBWidget.init(widgetParams);*/

